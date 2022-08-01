<?php

namespace App\Controllers;

use App\Models\SerwisantModel;
use App\Models\ZleceniaModel;

class Serwisant extends BaseController
{
    public $serwisant_model;

    public function __construct() {
		$this->serwisant_model = new SerwisantModel();
	}
}