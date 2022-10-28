<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SerwisantModel;
use App\Models\ZleceniaModel;
use App\libraries\Breadcrumb;



class Zlecenia extends BaseController
{
    public $zlecenie_model;
    private $statusInfo = [
        ["text-warning", "Oczekuje na naprawę"],
        ["text-danger", "W naprawie"],
        ["text-success", "Oczekuje na odbiór przez klienta"],
        ["text-secondary", "Odebrane przez klienta"]
    ];
    public function index()
    {
        return view('zlecenia');
    }
	public function __construct() {
		$this->zlecenie_model = new ZleceniaModel();
	}

    public function Dodaj()
    {
        $session = \Config\Services::session();
		$data = $this->request->getVar();
        $session->setFlashdata('msg', '');
        if(!empty($data))
        {
        //if($validation->check('nazwa', 'required')) e

		$validation = \Config\Services::validation();

        $validation->setRules([
            'nazwa' => 'required|string',
            'serial' => 'required|string',
            'opis_usterki' => 'required|string',
            'data_przyjecia' => 'required',
            'dni_naprawy' => 'required|integer',
            'id_klient' => 'required|integer',
            'id_serwisant' => 'required|integer',
        ]);
		if($validation->withRequest($this->request)->run()){
            $session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>fdfsdfsdfdsfe!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

         }
         else
         {
			
			try{
				$this->zlecenie_model->insert($data);
                $session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Zlecenie dodane pomyślnie!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

            }
			catch(\Exception $e){
                $session->setFlashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Nie działa :(<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
			}
         }
        }
		echo view('zleceniaDodaj',$data);

    }



    public function Details($id = NULL)
    {
        $uri = current_url(true);
        $data['id'] = $uri->getSegment(4,0);
        if($data['id'] == 0) return  view('zlecenia', $data);
        //$uri->getSegment(3,0);
        return view('zleceniaDetails', $data);
    }

    public function getBreadcrumbs()
    {
        $this->breadcrumb = new Breadcrumb();
        return $this->breadcrumb->buildAuto();
    }

    

    private function getStatus($id)
    {
        /*
        Status:
        0 = Oczekuje na naprawę
        1 = W naprawie
        2 = Oczekuje na odbiór przez klienta (Naprawa zakończona)
        3 = Odebrane przez klienta
        */
        $z = $this->zlecenie_model->find($id);

        if($z == NULL) return "Nieprawidłowe ID";

        switch($z['status'])
        {
            case 0:
                //echo "<span class='text-warning'>Oczekuje na naprawę</span>";
                echo "Oczekuje na naprawę";
            break;
        }
    }
    public function getZlecenie($id)
    {
        $z = $this->zlecenie_model->find($id);
        if($z == NULL) return -1;

        return $z;
    }
    public function displayZleceniaTable()
    {
        $allZlecenia = $this->zlecenie_model->findAll();
        $sM = new SerwisantModel();

        echo '<div class="card-body">
        <table id="datatablesZlecenia" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Nazwa</th>
                    <th>Numer seryjny</th>
                    <th>Data przyjęcia</th>
                    <th>Serwisant</th>
                    <th>Stan</th>
                </tr>
            </thead>
            <!-- <tfoot>
                <tr>
                    <th>Nr</th>
                    <th>Nazwa</th>
                    <th>Numer seryjny</th>
                    <th>Data przyjęcia</th>
                    <th>Serwisant</th>
                    <th>Stan</th>
                </tr>
            </tfoot> -->
            <tbody>';

        foreach($allZlecenia as $r)
        {
            echo '<tr class="clickable-row" data-href="/Zlecenia/Details/'. $r['id'] .'">';
            echo '<td>'. $r['id'] .'</td>';
            echo '<td>'. $r['nazwa'] .'</td>';
            echo '<td>'. $r['serial'] .'</td>';
            echo '<td>'. $r['data_przyjecia'] .'</td>';

            $s = $sM->find($r['id_serwisant']);
            if(!isset($s['nazwisko']))
                echo '<td class="text-danger">Brak!</td>';
            else    
                echo '<td>'. $s['nazwisko'] . " " . $s['imie'] .'</td>';

            echo '<td style="font-weight:bold;" class="'. $this->statusInfo[$r['status']][0] .'">'. $this->statusInfo[$r['status']][1] .'</td>';
            echo '</tr>';
        }

        echo '</tbody>
        </table>';
        //print_r($allZlecenia);
    }
}
