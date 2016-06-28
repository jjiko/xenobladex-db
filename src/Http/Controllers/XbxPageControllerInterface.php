<?php
namespace Jiko\XBXDB\Http\Controllers;

interface XbxPageControllerInterface {
  public function index();
  public function show($model);
}