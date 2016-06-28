<?php

namespace Jiko\XBXDB\Models;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model {
  protected $connection = "xbx";
  protected $table = "materials";

  public $timestamps = false;

  public function engineering()
  {
    return $this->belongsToMany('Jiko\XBXDB\Models\Engineering', 'engineering_materials');
  }

  public function bestiary()
  {
    return $this->belongsToMany('Jiko\XBXDB\Models\Bestiary', 'bestiary_materials');
  }
}