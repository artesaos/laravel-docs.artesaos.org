<?php namespace App\Console\Commands;

use App\Services\GitRepoService;
use Illuminate\Console\Command;

class GitPullDocs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'git:docs:pull';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Pull git-repos.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle(GitRepoService $git)
	{
		$git->pullRepo();
	}
}
