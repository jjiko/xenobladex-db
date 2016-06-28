<?php

namespace Jiko\XBXDB\Models;

interface SearchableInterface {
  public function searchDescription();
  public function searchLink();
  public function searchTitle();
}