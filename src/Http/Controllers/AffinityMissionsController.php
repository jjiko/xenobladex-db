<?php
namespace Jiko\XBXDB\Http\Controllers;

use Jiko\XBXDB\Models\AffinityMissions;

class AffinityMissionsController extends XbxDbController {
  public function show($model)
  {
    $this->page->title = "{$model->name} - Xenoblade Chronicles X Affinity Mission";
    $this->setContent('xbx::affinity-missions.show', ['r' => $model]);
  }

  public function index()
  {
    $this->page->title = "Affinity Missions - Xenoblade Chronicles X";
    $collection = AffinityMissions::orderBy('client')->get();
    $results = collect($collection)->groupBy('client');
    $this->setContent('xbx::affinity-missions.index', ['results' => $results]);
  }
}