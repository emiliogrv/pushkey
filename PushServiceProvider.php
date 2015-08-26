<?php namespace Emiliogrv\PushKey;

use Illuminate\Support\ServiceProvider;

class PushServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
    {
        $this->app['pushkey'] = $this->app->share(function($app)
        {
            return new PushKey;
        });
    }
}
