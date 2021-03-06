<?php namespace App\Services;

class GitRepoService
{
    /**
     * Clone the given repos
     * @param array|string|null $repos
     */
    public function cloneRepo($repos = null)
    {
        $repos = $this->parseRepos($repos);

        $docsDir = $this->getDocsDir();

        foreach ($repos as $path => $title) {
            $repoConfig = $this->repoConfig($path);
            $repoDir = $this->getRepoDir($path);

            $this->execShellCommand('rm -rf :repo_dir', ["repo_dir" => $repoDir]);

            $this->execShellCommand("cd :docs_dir && git clone --depth 1 --branch :branch :repo_url :path", [
                "docs_dir"    => $docsDir,
                "repo_url"    => $repoConfig['url'],
                "path"        => $path,
                "branch"    => $repoConfig['branch']
            ]);
        }
    }

    /**
     * Pull the given repos
     * @param array|string|null $repos
     */
    public function pullRepo($repos = null)
    {
        $repos = $this->parseRepos($repos);

        foreach ($repos as $path => $title) {
            $repoConfig = $this->repoConfig($path);

            $repoDir = $this->getRepoDir($path);

            if (!is_dir($repoDir)) {
                $this->cloneRepo($path);
            } else {
                $this->execShellCommand("cd :repo_dir && git pull && git checkout :branch", [
                    'repo_dir' => $repoDir,
                    'branch'   => $repoConfig['branch']
                ]);
            }
        }
    }

    /**
     * Execs a shell command
     * @param       $command
     * @param array $bindings
     *
     * @return string
     */
    public function execShellCommand($command, array $bindings = [])
    {
        return shell_exec(str_bind($command, $bindings));
    }

    /**
     * Return the base dir for de docs
     * @return string
     */
    public function getDocsDir()
    {
        return realpath(base_path('resources/docs'));
    }

    /**
     * Return the base dir for de docs
     *
     * @param $repo
     *
     * @return string
     */
    public function getRepoDir($repo)
    {
        return $this->getDocsDir()."/".$repo;
    }

    /**
     * Return the base view dir for de docs
     *
     * @param $repo
     *
     * @return string
     */
    public function getRepoViewsDir($repo)
    {
        $config = $this->repoConfig($repo);

        return rtrim($this->getRepoDir($repo)."/".$config['view-path'], "/");
    }

    /**
     *
     * Return the repositories wich matches with enabled repos
     *
     * @param null $repos array or comma separated string with repositories alias
     *                    configurated on config/git-repos.
     *
     * @return array
     */
    protected function parseRepos($repos = null)
    {
        if (is_null($repos)) {
            return $this->enabledRepos();
        }

        if (is_string($repos)) {
            $repos = preg_split('/, ?/', $repos);
        }

        return array_intersect($repos, $this->enabledRepos());
    }

    /**
     * Return an array of the enabled repos like [path => title, ...]
     *
     * @return array
     */
    public function enabledRepos()
    {
        $repos = config('git-repos.repositories', []);

        $enabled = [];

        foreach ($repos as $path => $repo) {
            if ($repo['enabled']) {
                $enabled[$path] = $repo['title'];
            }
        }

        return $enabled;
    }

    /**
     * Get a repo configurations
     *
     * @param string $repo
     *
     * @return array
     */
    public function repoConfig($repo = null)
    {
        $repositories = config('git-repos.repositories', []);

        return $repositories[$repo];
    }
}
