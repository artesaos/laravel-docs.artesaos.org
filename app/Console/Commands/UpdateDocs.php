<?php namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDocs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'docs:pull';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the master laravel-docs repo';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$dir = base_path('resources/docs/master');

		if(is_dir($dir)){
			shell_exec('cd '.$dir." && git pull origin master");
		}

		else{
			$this->call("docs:clone");
		}
	}
}
