<?php
namespace Jiko\XBXDB\Http\Controllers;

use Jiko\XBXDB\Models\BasicMissions;

class BasicMissionsController extends XbxDbController {
  public function show($model)
  {
    $this->page->title = "Basic Missions - Xenoblade Chronicles X";
    $this->setContent('xbx::missions.show', ['r' => $model]);
  }

  public function index()
  {
    $this->page->title = " - Xenoblade Chronicles X Basic Missions";
    $collection = BasicMissions::orderBy('name')->get();
    $this->setContent('xbx::missions.index', ['results' => $collection, 'missions_label' => $collection->first()->label]);
  }
}