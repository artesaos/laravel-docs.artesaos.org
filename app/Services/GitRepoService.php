<?php namespace App\Services;

class GitRepoService{

	/**
	 * Clone the given repos
	 * @param array|string|null $repos
	 */
	public function cloneRepo($repos = null){
		$repos = $this->parseRepos($repos);

		$docsDir = $this->getDocsDir();

		foreach($repos as $repo){
			$repoConfig = $this->repoConfig($repo);
			$repoDir = $this->getRepoDir($repo);

			shell_exec('rm -rf '.$repoDir);

			shell_exec('cd '.$docsDir." && git clone ".$repoConfig['url']." ".$repo. " && git checkout ".$repoConfig['branch']);
		}
	}

	/**
	 * Pull the given repos
	 * @param array|string|null $repos
	 */
	public function pullRepo($repos = null){
		$repos = $this->parseRepos($repos);

		$docsDir = $this->getDocsDir();

		foreach($repos as $repo){
			$repoConfig = $this->repoConfig($repo);

			$repoDir = $this->getRepoDir($repo);

			if(!is_dir($repoDir)){
				$this->cloneRepo($repo);
			}
			else{
				shell_exec('cd '.$repoDir." && git pull && git checkout ".$repoConfig['branch']);
			}
		}
	}

	/**
	 * Return the base dir for de docs
	 * @return string
	 */
	public function getDocsDir(){
		return realpath(base_path('resources/docs'));
	}

	/**
	 * Return the base dir for de docs
	 *
	 * @param $repo
	 *
	 * @return string
	 */
	public function getRepoDir($repo){
		return $this->getDocsDir()."/".$repo;
	}

	/**
	 * Return the base view dir for de docs
	 *
	 * @param $repo
	 *
	 * @return string
	 */
	public function getRepoViewsDir($repo){
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
	protected function parseRepos($repos = null){
		if(is_null($repos)){
			return $this->enabledRepos();
		}

		if(is_string($repos)){
			$repos = preg_split('/, ?/', $repos);
		}

		return array_intersect($repos, $this->enabledRepos());
	}

	/**
	 * Return the enabled repos
	 *
	 * @return array
	 */
	public function enabledRepos(){
		return config('git-repos.enabled', []);
	}

	/**
	 * Get a repo configurations
	 *
	 * @param string $repo
	 *
	 * @return array
	 */
	public function repoConfig($repo = null){
		$repositories = config('git-repos.repositories', []);

		return $repositories[$repo];
	}
}
