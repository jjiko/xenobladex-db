<?php

namespace Jiko\XBXDB\Models;
use Illuminate\Database\Eloquent\Model;

class FrontierNav extends Model {
  protected $connection = "xbx";
  protected $guarded = ['id'];
  protected $table = "frontiernav";
  public $timestamps = false;
}