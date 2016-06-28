<?php
namespace Jiko\XBXDB\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Jiko\XBXDB\Models\Bestiary;

class BestiaryController extends XbxDbController
{
  public function show($model)
  {
    $this->page->title = sprintf("%s - Xenoblade Chronicles X Bestiary", ucfirst($model->name));
    $this->setContent('xbx::bestiary.show', ['r' => $model]);
  }

  public function showTyrant($model, $slug = '')
  {
    $this->page->title = sprintf("%s - Xenoblade Chronicles X Tyrants", ucfirst($model->name));
    $this->setContent('xbx::bestiary.showTyrant', ['r' => $model]);
  }

  public function tyrants()
  {
    \DB::connection('xbx')->enableQueryLog();
    $this->page->title = "Tyrants - Xenoblade Chronicles X";
    $query = Bestiary::tyrants();
    if (Input::has('lv')) {
      $lv = (int) Input::get('lv');
      $lv_range = [
        0 => 20,
        20 => 39,
        40 => 59,
        60 => 99
      ];
      if(is_numeric(Input::get('lv'))) {
        $query->where('lv_string', '>=', $lv)->where('lv_string', '<=', $lv_range[$lv]);
      }
    }
    $collection = $query->orderBy('lv_string', 'asc')->get()->groupBy('continent')->map(function ($item, $key) {
      return $item->groupBy('type');
    });
    //dd(\DB::connection('xbx')->getQueryLog());
    $this->setContent("xbx::bestiary.tyrants", ['results' => $collection]);
  }


  public function index()
  {
    $this->page->title = "Bestiary - Xenoblade Chronicle X";
    $query = Bestiary::normal();
    if (Input::has('lv')) {
      $lv = (int) Input::get('lv');
      $lv_range = [
        0 => 20,
        20 => 39,
        40 => 59,
        60 => 99
      ];
      if(is_numeric(Input::get('lv'))) {
        $query->where('lv', '>=', $lv)->where('lv', '<=', $lv_range[$lv]);
      }
    }
    $collection = $query->get()->groupBy('continent')->map(function ($item, $key) {
      return $item->groupBy('type');
    });
    $this->setContent('xbx::bestiary.index', ['results' => $collection]);
  }
}