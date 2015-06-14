<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GitRepoService;

class GitCloneDocs extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'git:docs:clone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone the git-repos.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(GitRepoService $git)
    {
        $git->cloneRepo();
    }
}
