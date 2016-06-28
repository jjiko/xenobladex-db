<?php

namespace Jiko\XBXDB\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Input;
use Jiko\XBXDB\Models\Engineering;
use Jiko\XBXDB\Models\FrontierNav;
use Jiko\XBXDB\Models\Materials;
use Jiko\XBXDB\Models\SquadTasks;

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
   * @param  \Illuminate\Routing\Router  $router
   * @return void
   */
  public function boot(Router $router)
  {
    parent::boot($router);

    $this->loadViewsFrom(__DIR__.'/../resources/views', 'xbx');

    $router->model('affinity_mission', 'Jiko\XBXDB\Models\AffinityMissions');
    $router->model('arts', 'Jiko\XBXDB\Models\Arts');
    $router->model('basic_mission', 'Jiko\XBXDB\Models\BasicMissions');
    $router->model('bestiary', 'Jiko\XBXDB\Models\Bestiary');
    $router->bind('engineering_category', function($value){
      return Engineering::whereHas('categories', function($query) use ($value){
        $query->where('slug', '=', $value);
      })->get();
    });
    $router->bind('engineering', function($value){
      return Engineering::where('id', $value)->with('materials')->get();
    });
    $router->bind('frontiernav_map', function($value){
      $name = str_replace('-', ' ', $value);
      return FrontierNav::where('map', $name)->get()->groupBy('map');
    });
    $router->bind('materials', function($value){
      return Materials::where('id', $value)->with('bestiary')->get();
    });
    $router->model('normal_mission', 'Jiko\XBXDB\Models\NormalMissions');
    $router->model('skills', 'Jiko\XBXDB\Models\Skills');
    $router->bind('squad_task_collection', function($value){
      return SquadTasks::where('name', $value)->get();
    });
  }

  /**
   * Define the routes for the application.
   *
   * @param  \Illuminate\Routing\Router  $router
   * @return void
   */
  public function map(Router $router)
  {
    $router->group(['namespace' => $this->namespace], function ($router) {
      if (in_array(Input::server('HTTP_HOST'), ['www.joejiko.com','local.joejiko.com'])) {
        require_once(__DIR__ . '/../Http/routes.php');;
      }
    });
  }
}
