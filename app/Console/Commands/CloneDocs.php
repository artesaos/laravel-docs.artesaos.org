<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CloneDocs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'docs:clone';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clone laravel-docs repo';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		shell_exec('cd '.base_path('resources/docs')." && git clone git@github.com:artesaos/laravel-docs.git master");
	}

}
