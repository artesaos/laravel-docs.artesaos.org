<?php

namespace Vluzrmos\Disqus;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Factory;
use Illuminate\View\View;

class DisqusServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap the service provider.
	 *
	 * @return void
	 */
	public function boot(){
		$this->loadViewsFrom(__DIR__.'/resources/views', 'disqus');

		$this->publishes([
			__DIR__.'/config/disqus.php' => config_path('disqus.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->afterResolving('view', function(){
			/** @var Factory $factory*/
			$factory = $this->app['view'];

			$factory->composer('disqus::comments', function(View $view){
				$view->with('shortname', config('disqus.shortname'));
			});
		});
	}
}
