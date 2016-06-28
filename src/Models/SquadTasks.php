<?php

namespace Jiko\XBXDB\Models;
use Illuminate\Database\Eloquent\Model;

class SquadTasks extends Model {
  protected $connection = "xbx";
  protected $table = "squad_tasks";

  public $timestamps = false;
}