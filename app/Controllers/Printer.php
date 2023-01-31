<?php

namespace App\Controllers;

use App\Models\ZleceniaUslugiModel;
use App\Models\ZleceniaModel;
use App\Models\KlientModel;
use App\Models\SerwisantModel;
use App\libraries\Breadcrumb;

class Printer extends BaseController
{
    public $serwisant_model;

    public function label($id)
    {
        $zM = new ZleceniaModel();
        $kM = new KlientModel();
        $zlecenie = $zM->find($id);
        $klient = $kM->find($zlecenie['id_klient']);
        $data['zlecenie'] = $zlecenie;
        $data['klient'] = $klient;
        return view('print_label', $data);
    }
    public function confdoc($id)
    {
        $zM = new ZleceniaModel();
        $kM = new KlientModel();
        $sM = new SerwisantModel();
        $zlecenie = $zM->find($id);
        $klient = $kM->find($zlecenie['id_klient']);
        $serwisant = $sM->find($zlecenie['id_serwisant']);
        $data['zlecenie'] = $zlecenie;
        $data['klient'] = $klient;
        $data['serwisant'] = $serwisant;
        return view('print_confdoc', $data);
    }

  public function index()
  {
    //redirect back
  }

}