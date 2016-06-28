<?php

namespace Jiko\XBXDB\Models;

use Illuminate\Database\Eloquent\Model;

class Bestiary extends Model {
  protected $connection = "xbx";
  protected $table = "bestiary";

  public $timestamps = false;

  public function drops()
  {
    return $this->belongsToMany('Jiko\XBXDB\Models\Materials', 'bestiary_materials')->withPivot('drop_rate');
  }

  public function scopeNormal($query)
  {
    return $query->where('tyrant', '=', 0);
  }

  public function scopeTyrants($query)
  {
    return $query->where('tyrant', '=', 1);
  }
}