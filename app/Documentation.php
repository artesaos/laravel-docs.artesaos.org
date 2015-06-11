<?php namespace App;

use App\Services\GitRepoService;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

class Documentation {

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
	 * Create a new documentation instance.
	 *
	 * @param  Filesystem  $files
	 * @param  Cache  $cache
	 * @return void
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
		return $this->cache->remember('docs.'.$version.'.index', 5, function() use ($version) {
			$path = $this->git->getRepoViewsDir($version).'/documentation.md';

			if ($this->files->exists($path)) {
				return $this->replaceLinks($version, markdown($this->files->get($path)));
			}

			return null;
		});
	}

	/**
	 * Get the given documentation page.
	 *
	 * @param  string  $version
	 * @param  string  $page
	 * @return string
	 */
	public function get($version, $page)
	{
		$content = $this->cache->remember('docs.'.$version.'.'.$page, 5, function() use ($version, $page) {
			$path = $this->git->getRepoViewsDir($version)."/{$page}.md";

			if ($this->files->exists($path)) {
				return $this->replaceLinks($version, markdown($this->files->get($path)));
			}

			return null;
		});

		$title = $content? $this->getDocTitleByContent($content): null;

		return compact('content', 'title');
	}

	/**
	 * Get doc Title by Content
	 * @param  string $content mardown parsed string
	 * @return string
	 */
	public function getDocTitleByContent($content){
		$title = (new Crawler(utf8_decode($content)))->filterXPath('//h1');
		
		return $title ? $title->text() : null;
	}

	/**
	 * Return default version of git repos
	 * @return string by default will return "master"
	 */
	public function defaultVersion(){
		return config('git-repos.default-version', 'master');
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
		return $this->files->exists($this->git->getRepoViewsDir($version)."/{$page}.md");
	}

	/**
	 * Return an array [path => title] of the enabled docs
	 * @return array
	 */
	public function getDocsEnabledVersions(){
		$repos = config('git-repos.repositories', []);
		$enabled = [];

		foreach($repos as $path => $repo){
			if($repo['enabled']){
				$enabled[$path] = $repo['title'];
			}
		}

		return $enabled;
	}



}
