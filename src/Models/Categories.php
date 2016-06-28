<?php

namespace Jiko\XBXDB\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {
  protected $connection = "xbx";
  protected $table = "categories";

  public $timestamps = false;

  public function engineering()
  {
    return $this->belongsToMany('Jiko\XBXDB\Models\Engineering', 'categories_engineering');
  }
}