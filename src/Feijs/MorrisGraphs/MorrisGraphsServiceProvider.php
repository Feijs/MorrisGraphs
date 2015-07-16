<?php namespace Feijs\MorrisGraphs;

use Illuminate\Support\ServiceProvider;

/**
 * Provides Morris Graphs for laravel
 *
 * @package    Feijs/MorrisGraphs
 * @author     Mike Feijs <mfeijs@gmail.com>
 * @copyright  (c) 2015, Mike Feijs
 */
class MorrisGraphsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Boot the package
        $this->package('feijs/morris-graphs');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Bind & dependency inject the timetracker class
        $this->app['morris-graphs'] = $this->app->share(function ($app)
        {
            return $this->app->make('Feijs\MorrisGraphs\Factory');
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('morris-graphs');
	}

}
