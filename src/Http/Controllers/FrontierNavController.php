<?php
namespace Jiko\XBXDB\Http\Controllers;

use Jiko\XBXDB\Models\FrontierNav;
use Illuminate\Support\Facades\Redis;

class FrontierNavController extends XbxDbController {
  public function all() {
    $this->page->title = "FrontierNav - Xenoblade Chronicles X Database";
    //Redis::set('frontiernav:all', FrontierNav::all()->groupBy('map'));
    $collection = FrontierNav::all()->groupBy('map');
    $this->setContent('xbx::frontiernav.show', ['frontiernav' => $collection]);
  }
  public function show($collection)
  {
    $map_name = ucwords($collection->first()->first()->map);
    $this->page->title = "FrontierNav {$map_name} - Xenoblade Chronicles X Database";
    $this->setContent('xbx::frontiernav.show', ['frontiernav' => $collection]);
  }

  public function index()
  {
    $this->page->title = "FrontierNav - Xenoblade Chronicles X Database";
    $maps = FrontierNav::distinct()->select('map')->get()->groupBy('map')->toArray();
    $this->setContent('xbx::frontiernav.index', ['maps' => $maps]);
  }

}