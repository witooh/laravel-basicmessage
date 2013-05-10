<?php namespace Witooh\BasicMessage;

use Illuminate\Support\ServiceProvider;

class BasicMessageServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['resmsg'] = $this->app->share(
            function () {
                return new ResMsg();
            }
        );

        $this->app['reqmsg'] = $this->app->share(
            function () {
                return new ReqMsg();
            }
        );
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