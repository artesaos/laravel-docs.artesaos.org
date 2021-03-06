<?php

namespace App;

use App\Services\GitRepoService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

class Documentation
{
    /**
     * The filesystem implementation.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * The cache implementation.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * Git Repository
     * @var \App\Services\GitRepoService
     */
    protected $git;

    /**
     * File of the index menu
     * @var string
     */
    protected $indexFile = "documentation";

    /**
     * Default cache time in minutes
     * @var int
     */
    protected $cacheTime = 5;

    /**
     * Extension of the files
     * @var string
     */
    protected $filesExt = ".md";

    /**
     * Create a new documentation instance.
     *
     * @param  Filesystem                  $files
     * @param  Cache                       $cache
     * @param \App\Services\GitRepoService $git
     */
    public function __construct(Filesystem $files, Cache $cache, GitRepoService $git)
    {
        $this->files = $files;
        $this->cache = $cache;
        $this->git   = $git;
    }

    /**
     * Get the documentation index page.
     *
     * @param  string  $version
     * @return string
     */
    public function getIndex($version)
    {
        $contents = $this->get($version, $this->indexFile);
        return $contents['content'];
    }

    /**
     * Get the given documentation page.
     *
     * @param  string $version
     * @param  string $page
     *
     * @return string
     */
    public function get($version, $page)
    {
        return $this->cache->remember('docs.'.$version.'.'.$page, $this->cacheTime, function () use ($version, $page) {
            $path = $this->fullPagePath($version, $page);

            if ($this->files->exists($path)) {
                $content = $this->replaceLinks($version, markdown($this->files->get($path)));

                $title = $content? $this->getDocTitleByContent($content): null;

                return compact('content', 'title');
            }

            return null;
        });
    }

    /**
     * Get doc Title by Content
     * @param  string $content mardown parsed string
     * @return string
     */
    public function getDocTitleByContent($content)
    {
        $title = (new Crawler(utf8_decode($content)))->filterXPath('//h1');
        
        return (count($title) ? $title->text() : null);
    }

    /**
     * Return default version of git repos
     * @return string by default will return "master"
     */
    public function defaultVersion()
    {
        return config('git-repos.default-version', 'master');
    }

    /**
     * Get a full qualified path to a given page
     *
     * @param $version
     * @param $page
     *
     * @return string
     */
    protected function fullPagePath($version, $page)
    {
        return $this->git->getRepoViewsDir($version)."/".$page.$this->filesExt;
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $version
     * @param  string  $content
     * @return string
     */
    protected function replaceLinks($version, $content)
    {
        return str_replace('{{version}}', $version, $content);
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $version
     * @param  string  $page
     * @return boolean
     */
    public function sectionExists($version, $page)
    {
        return $this->files->exists($this->fullPagePath($version, $page));
    }

    /**
     * Return an array [path => title] of the enabled docs
     * @return array
     */
    public function getDocsEnabledVersions()
    {
        return $this->git->enabledRepos();
    }
}
