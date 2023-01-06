<?php

namespace App\Controllers;

use App\Models\UslugiModel;
use App\Models\ZleceniaUslugiModel;
use App\libraries\Breadcrumb;
use CodeIgniter\Cookie\Cookie;

class Uslugi extends BaseController
{
    public $uslugi_model;
    public $zu;

    public function __construct() {
		$this->uslugi_model = new UslugiModel();
        $this->zu = new ZleceniaUslugiModel();
	}
    public function getNameFromId($id)
    {
        $u = $this->uslugi_model->find($id);
        return $u['nazwa'];
    }
    public function getCenaFromId($id)
    {
        $u = $this->uslugi_model->find($id);
        return $u['cena_brutto'];
    }
    public function getAll()
    {
        $u = $this->uslugi_model->findAll();
        return $u;
    }
    public function Delete($id)
    {
        $this->zu->delete($id);
        return redirect()->back()->withInput(); 
        //redirect(\Config\Services::request()->getUserAgent()->getReferrer());
    }
    public function Add()
    {
        $data = $this->request->getVar();
        $validation = \Config\Services::validation();
        print_r($data);

        if(empty($data['customPrice'])) $data['customPrice'] = NULL;

        $validation->setRules([
            'id_zlecenia' => 'required',
            'id_uslugi' => 'required',
            'ilosc' => 'required',
        ]);
        $this->zu->insert($data);
        return redirect()->back()->withInput(); 
    }

}