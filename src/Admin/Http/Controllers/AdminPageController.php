<?php
namespace Jiko\XBXDB\Admin\Http\Controllers;

use Jiko\Admin\Http\Controllers\AdminController;

class AdminPageController extends AdminController {
  public function bestiaryMaterials()
  {
    return $this->setContent('xbx::admin.bestiaryMaterials');
  }
}