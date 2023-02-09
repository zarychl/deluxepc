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
  public function getSerwisantVCard($id){
    $s = $this->serwisant_model->find($id);
    
    return $s['nazwisko'] . " " . $s['imie'] . " #" . $s['id'];
  }
  public function getCurrent()
  {
    $session = session();
    $curr = $this->serwisant_model->find($session->get('loggedUserId'));
    return $curr;
  }
  public function getSerwisant($id)
  {
    $curr = $this->serwisant_model->find($id);
    return $curr;
  }
  public function getAll()
  {
    $all = $this->serwisant_model->findAll();
    return $all;
  }

  public function index()
  {
      return view('serwisanci');
  }

}