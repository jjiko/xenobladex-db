<?php

namespace Jiko\XBXDB\Models;

use Illuminate\Database\Eloquent\Model;

class Arts extends Model implements SearchableInterface {
  protected $connection = "xbx";
  protected $table = "arts";

  public $timestamps = false;

  public function searchDescription()
  {
    // TODO: Implement searchDescription() method.
  }

  public function searchLink()
  {
    // TODO: Implement searchLink() method.
  }

  public function searchResults()
  {
    // TODO: Implement searchResults() method.
  }

  public function searchTitle()
  {
    return $this->title;
  }
}