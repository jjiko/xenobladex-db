<?php

namespace Jiko\XBXDB\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Input;
use Jiko\XBXDB\Models\Engineering;
use Jiko\XBXDB\Models\FrontierNav;
use Jiko\XBXDB\Models\Materials;
use Jiko\XBXDB\Models\SquadTasks;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * This namespace is applied to the controller routes in your routes file.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'Jiko\XBXDB\Http\Controllers';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @param  \Illuminate\Routing\Router $router
   * @return void
   */
  public function boot()
  {
    parent::boot();

    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'xbx');

    Route::model('affinity_mission', 'Jiko\XBXDB\Models\AffinityMissions');
    Route::model('arts', 'Jiko\XBXDB\Models\Arts');
    Route::model('basic_mission', 'Jiko\XBXDB\Models\BasicMissions');
    Route::model('bestiary', 'Jiko\XBXDB\Models\Bestiary');
    Route::bind('engineering_category', function ($value) {
      return Engineering::whereHas('categories', function ($query) use ($value) {
        $query->where('slug', '=', $value);
      })->get();
    });
    Route::bind('engineering', function ($value) {
      return Engineering::where('id', $value)->with('materials')->get();
    });
    Route::bind('frontiernav_map', function ($value) {
      $name = str_replace('-', ' ', $value);
      return FrontierNav::where('map', $name)->get()->groupBy('map');
    });
    Route::bind('materials', function ($value) {
      return Materials::where('id', $value)->with('bestiary')->get();
    });
    Route::model('normal_mission', 'Jiko\XBXDB\Models\NormalMissions');
    Route::model('skills', 'Jiko\XBXDB\Models\Skills');
    Route::bind('squad_task_collection', function ($value) {
      return SquadTasks::where('name', $value)->get();
    });
  }

  /**
   * Define the routes for the application.
   *
   * @param  \Illuminate\Routing\Router $router
   * @return void
   */
  public function map(Router $router)
  {
    $router->group(['namespace' => $this->namespace], function ($router) {
      if (preg_match('/joejiko\.com/i', Input::server('HTTP_HOST'), $matches)) {
        require_once(__DIR__ . '/../Http/routes.php');;
      }
    });
  }
}
