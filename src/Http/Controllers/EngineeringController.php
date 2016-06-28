<?php
namespace Jiko\XBXDB\Http\Controllers;
use Jiko\XBXDB\Models\Categories;

class EngineeringController extends XbxDbController {
  public function show($model)
  {
    $this->page->title = sprintf("%s - Xenoblade Chronicles X Engineering", $model->first()->name);
    $this->setContent('xbx::engineering.show', ['r' => $model]);
  }

  public function category($collection)
  {
    $category_name = $collection->first()->categories->first()->name;
    $this->page->title = "{$category_name} - Xenoblade Chronicles X Engineering";
    $this->setContent('xbx::engineering.category', [
      'categories' => Categories::has('engineering')->get(),
      'category_name' => $category_name,
      'results' => $collection->sortBy('name')
    ]);
  }

  public function index()
  {
    $this->page->title = "Engineering - Xenoblade Chronicles X Database";
    $collection = Categories::has('engineering')->get();
    $this->setContent('xbx::engineering.index', ['results' => $collection]);
  }
}