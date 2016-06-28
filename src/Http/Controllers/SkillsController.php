<?php
namespace Jiko\XBXDB\Http\Controllers;

use Jiko\XBXDB\Models\Skills;

class SkillsController extends XbxDbController {
  public function show($model)
  {
    $this->page->title = "{$model->name} - Xenoblade Chronicles X Class Skills";
    $this->setContent('xbx::class-skills.show', ['r' => $model]);
  }

  public function index()
  {
    $this->page->title = "Class Skills - Xenoblade Chronicles X";
    $this->setContent('xbx::class-skills.index', ['results' => Skills::orderBy('class_rank')->get()]);
  }
}