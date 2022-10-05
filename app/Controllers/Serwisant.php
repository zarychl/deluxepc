<?php

namespace App\Controllers;

use App\Models\SerwisantModel;
use App\Models\ZleceniaModel;
use App\libraries\Breadcrumb;

class Serwisant extends BaseController
{
    public $serwisant_model;

    public function __construct() {
		$this->serwisant_model = new SerwisantModel();
	}
  
  public function getBreadcrumbs()
  {
      $this->breadcrumb = new Breadcrumb();
      return $this->breadcrumb->buildAuto();
  }

  public function index()
  {
      return view('serwisanci');
  }

}