<?php namespace Dberry37388\Honcho;

use Illuminate\Support\ServiceProvider;

class HonchoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('dberry37388/honcho');

		include ( __DIR__ . '/../../start.php');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// include our start file
		include ( __DIR__ . '/../../routes.php');

		$this->app['honcho.settings'] = $this->app->share(function($app)
		{
			return new \Dberry37388\Honcho\Support\Settings();
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}