<?php
namespace Emiliogrv\Pushkey;

use Illuminate\Support\ServiceProvider;

class PushkeyServiceProvider extends ServiceProvider
{
  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton('pushkey', function ($app) {
      return new Pushkey;
    });
  }
}
