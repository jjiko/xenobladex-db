<?php

namespace Jiko\XBXDB\Http\Controllers;

use Jiko\Http\Controllers\Controller;
use Jiko\XBXDB\Models\Categories;
use Jiko\XBXDB\Models\FrontierNav;

class XbxDbController extends Controller implements XbxPageControllerInterface
{
    protected $layout = "xbx::layout";

    function __construct()
    {
        parent::__construct();
        view()->share('engineering_categories', Categories::has('engineering')->get());
        view()->share('frontiernav_categories', FrontierNav::distinct()->select('map')->orderBy('map', 'asc')->get());
        $nav = [
          "bestiary" => [
            "items" => ["normal", "tyrants"]
          ],
          "engineering" => [
            "items" => [
              "weapon augments", "armor augments", "skell weapon augments", "skell frame augments", "special devices", "skell weapons"
            ]
          ],
          "materials",
          "missions" => [
            "affinity missions", "basic missions", "normal missions"
          ],
          "arts",
          "skills",
          "squad-tasks"
        ];
        view()->share('nav_items', $nav);
    }

    public function index()
    {
        $this->page->title = "Xenoblade Chronicles X Database";
    }

    public function show($model)
    {
        $this->page->title = "{$model->name} - Xenoblade Chronicles X";
    }
}