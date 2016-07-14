<?php namespace Jiko\XBXDB\Providers;

use Illuminate\Support\ServiceProvider;

class XbxdbServiceProvider extends ServiceProvider {

  public function register() {


    view()->addNamespace('xbx', __DIR__.'/../XBXDB/src/resources/views');

    $this->app->register('Jiko\XBXDB\Providers\RouteServiceProvider');

  }

}