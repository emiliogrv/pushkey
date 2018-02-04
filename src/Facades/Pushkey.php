<?php
namespace Emiliogrv\Pushkey\Facades;

use Illuminate\Support\Facades\Facade;

class Pushkey extends Facade
{

  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return 'pushkey';
  }
}
