<?php
namespace Jiko\XBXDB\Models;

interface ResultableInterface {
  public function searchResults($type='json');
}