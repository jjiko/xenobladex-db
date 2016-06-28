<?php

namespace Jiko\XBXDB\Models;

use Illuminate\Database\Eloquent\Model;

class BasicMissions extends Model {
  protected $connection = "xbx";
  protected $table = "missions_basic";

  public $timestamps = false;
}