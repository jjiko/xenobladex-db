<?php

namespace Jiko\XBXDB\Models;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model {
  protected $connection = "xbx";
  protected $table = "class_skills";

  public $timestamps = false;
}