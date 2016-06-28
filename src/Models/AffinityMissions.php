<?php

namespace Jiko\XBXDB\Models;

use Illuminate\Database\Eloquent\Model;

class AffinityMissions extends Model {
  protected $connection = "xbx";
  protected $table = "missions_affinity";

  public $timestamps = false;
}