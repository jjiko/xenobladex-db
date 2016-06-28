<?php
namespace Jiko\XBXDB\Http\Controllers;
use Jiko\XBXDB\Models\NormalMissions;

class NormalMissionsController extends XbxDbController {
  public function show($model)
  {
    $this->page->title = "{$model->name} - Xenoblade Chronicles X Normal Mission";
    $this->setContent('xbx::missions.show', ['r' => $model]);
  }

  public function index()
  {
    $this->page->title = "Normal Missions - Xenoblade Chronicles X";
    $collection = NormalMissions::orderBy('name')->get();
    $this->setContent('xbx::missions.index', ['results' => $collection, 'missions_label' => $collection->first()->label]);
  }
}