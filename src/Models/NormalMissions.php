<?php

namespace Jiko\XBXDB\Models;
use Illuminate\Database\Eloquent\Model;

class NormalMissions extends Model {
  protected $connection = "xbx";
  protected $table = "missions_normal";

  public $timestamps = false;
}