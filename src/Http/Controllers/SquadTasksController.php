<?php
namespace Jiko\XBXDB\Http\Controllers;
use Jiko\XBXDB\Models\SquadTasks;

class SquadTasksController extends XbxDbController {
  public function show($collection)
  {
    $this->page->title = "{$collection->first()->name} Xenoblade Chronicles X Squad Tasks";
    $this->setContent('xbx::squad-tasks.show', ['r' => $collection]);
  }

  public function index()
  {
    $this->page->title = "Squad Tasks - Xenoblade Chronicles X Database";
    $results = SquadTasks::orderBy('name','asc')->get();
    $collection = collect($results)->groupBy('name');
    $this->setContent('xbx::squad-tasks.index', ['results' => $collection]);
  }
}