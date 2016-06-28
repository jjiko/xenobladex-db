<?php
namespace Jiko\XBXDB\Http\Controllers;
use Jiko\XBXDB\Models\Arts;
class ArtsController extends XbxDbController
{
  public function show($model)
  {
    $this->page->title = "{$model->name} - Xenoblade Chronicle X Arts";
    $this->setContent('xbx::arts.show', ['r' => $model]);
  }

  public function index()
  {
    $this->page->title = "Arts - Xenoblade Chronicles X Database";
    $this->setContent('xbx::arts.index', ['results' => Arts::orderBy('class_rank')->get()]);
  }
}