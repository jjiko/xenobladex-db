<?php
namespace Jiko\XBXDB\Http\Controllers;
use Jiko\XBXDB\Models\Materials;

class MaterialsController extends XbxDbController {
  public function show($model)
  {
    $this->page->title = sprintf("%s - Xenoblade Chronicles X", ucfirst($model->first()->name));
    $this->setContent("xbx::materials.show", ['r' => $model]);
  }

  public function index()
  {
    $this->page->title = "Materials list - Xenoblade Chronicles X";
    $collection = Materials::orderBy('name', 'asc')->get();
    $this->setContent('xbx::materials.index', ['results' => $collection]);
  }
}