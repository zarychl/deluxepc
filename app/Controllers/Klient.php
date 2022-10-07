<?php

namespace App\Controllers;

//use App\Models\SerwisantModel;
use App\libraries\Breadcrumb;
use App\Models\KlientModel;

class Klient extends BaseController
{
    public $klient_model;

    public function __construct() {
		$this->klient_model = new KlientModel();
	}
  
  public function getBreadcrumbs()
  {
      $this->breadcrumb = new Breadcrumb();
      return $this->breadcrumb->buildAuto();
  }

  public function getAllKlienci()
  {
    $allKlienci = $this->klient_model->findAll();

    return $allKlienci;
  }

  public function getKlientVCard($id)
  {
    $k = $this->klient_model->find($id);

    $name = $k['nazwa'];
    $addr = $k['ulica'] . ", " . $k['kod'] . " " . $k['miasto'] ;
    if($k["nip"] == "")
    {
      $last = "tel. " . $k['tel1'];
    }
    else
    {
      $last = "NIP: " . $k['nip'];
    }
    return "$name<br> $addr [$last]";
  }

  public function index()
  {
      //return view('klienci');
      return 0;
  }

}