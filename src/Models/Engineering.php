<?php

namespace Jiko\XBXDB\Models;
use Illuminate\Database\Eloquent\Model;

class Engineering extends Model {
  protected $connection = "xbx";
  protected $table = "engineering";

  public $timestamps = false;

  public function materials()
  {
    return $this->belongsToMany('Jiko\XBXDB\Models\Materials', 'engineering_materials')->withPivot('count');
  }

  public function categories()
  {
    return $this->belongsToMany('Jiko\XBXDB\Models\Categories', 'categories_engineering');
  }
}