<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SerwisantModel;
use App\Models\ZleceniaModel;
use App\Models\ZleceniaUslugiModel;
use App\Controllers\Login;
use App\libraries\Breadcrumb;
use App\Models\UslugiModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Zlecenia extends BaseController
{
    public $zlecenie_model;
    private $statusInfo = [
        ["text-danger", "Oczekuje na naprawę"],
        ["text-warning", "W naprawie"],
        ["text-success", "Oczekuje na odbiór przez klienta"],
        ["text-secondary", "Odebrane przez klienta"]
    ];
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $lC = new Login();
        if($lC->getLoggedUserId() == 0)
                return $this->response->redirect(site_url('Login'));
    }

    public function index()
    {
        return view('zlecenia');
    }
	public function __construct() {
        helper('url');
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
            'id_klient' => 'required',
            'id_serwisant' => 'required|integer',
            'czy_zasilacz' => 'required',
            'czy_plyty' => 'required',
            'czy_opak' => 'required',
            'czy_kable' => 'required',
            'czy_ekspres' => 'required',
            'czy_zewn' => 'required',
            'czy_gwarancja' => 'required'
        ]);
		if($validation->withRequest($this->request)->run()){
            $session->setFlashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>fdfsdfsdfdsfe!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

         }
         else
         {
			
			try{
				$this->zlecenie_model->insert($data);
                return $this->response->redirect(site_url('Zlecenia/Details/' . $this->zlecenie_model->getInsertID()));
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
    public function Zakoncz($id, $opis_naprawy = "")
    {

        $date = date("Y-m-d h:i:s");
        $zM = new ZleceniaModel();
        $data = [
            'id' => $id,
            'opis_naprawy' => $opis_naprawy,
            'data_naprawy' => $date,
            'status' => 2
        ];
        
        $zM->save($data);

        return redirect()->to(site_url('/Zlecenia/Details/' . $id)); 
    }
    public function getUslugi($id_zlecenia)
    {
        $zM = new ZleceniaModel();
        $zU = new ZleceniaUslugiModel();
        $uM = new UslugiModel();

        //$uC = new Uslugi();

        $uslugi = $zU->where('id_zlecenia', $id_zlecenia)->findAll();

        return $uslugi;

    }
    public function Edytuj($id = NULL)
    {
        
        $zM = new ZleceniaModel();
        $session = \Config\Services::session();
		$data = $this->request->getVar();
        if(!empty($data))
        {
            $zM->save($data);
            return redirect()->to(site_url('/Zlecenia/Details/' . $data['id'])); 
        }
        if(!isset($id))
            return redirect()->to(site_url('/Zlecenia')); 
        $data['id'] = $id;
        return view('zleceniaEdytuj', $data);
    }
    public function Rozpocznij($id)
    {
        $zM = new ZleceniaModel();
        $data = [
            'id' => $id,
            'status' => 1
        ];
        
        $zM->save($data);

        return redirect()->to(site_url('/Zlecenia/Details/' . $id)); 
    }
    public function PotwierdzOdbior($id)
    {
        $date = date("Y-m-d h:i:s");
        $zM = new ZleceniaModel();
        $data = [
            'id' => $id,
            'status' => 3,
            'data_odbioru' => $date
        ];
        
        $zM->save($data);

        return redirect()->to(site_url('/Zlecenia/Details/' . $id)); 
    }
    public function PonownieRozpocznij($id)
    {
        $zM = new ZleceniaModel();
        $data = [
            'id' => $id,
            'status' => 1,
            'data_naprawy' => NULL,
            'data_odbioru' => NULL
        ];
        
        $zM->save($data);

        return redirect()->to(site_url('/Zlecenia/Details/' . $id)); 
    }
    public function listUslugi($id)
    {
        $z = $this->zlecenie_model->find($id);
        $firstRun = 1;
        $str = array();
        if($z['czy_gwarancja']) array_push($str, "gwarancja");
        if($z['czy_ekspres']) array_push($str, "ekspres");
        if($z['czy_zewn']) array_push($str, "serwis zewnętrzny");
        
        $ret = '';
        $fR = 1;
        foreach($str as $e)
        {
            if($fR)
            {
                $fR = 0;
                $ret .= ucfirst($e). ", ";
            }
            else
            {
                $ret .= $e . ", ";
            }
        }
        $ret = substr($ret, 0,-2);

        return $ret;
    }
    public function listZestaw($id)
    {
        $z = $this->zlecenie_model->find($id);
        $firstRun = 1;
        $str = array();
        if($z['czy_kable']) array_push($str, "kable");
        if($z['czy_opak']) array_push($str, "opakowanie");
        if($z['czy_zasilacz']) array_push($str, "zasilacz");
        if($z['czy_plyty']) array_push($str, "płyty");
        
        $ret = '';
        $fR = 1;
        foreach($str as $e)
        {
            if($fR)
            {
                $fR = 0;
                $ret .= ucfirst($e). ", ";
            }
            else
            {
                $ret .= $e . ", ";
            }
        }
        $ret = substr($ret, 0,-2);

        if($z['wyp_inne'] != "") $ret .= "<br>" . $z['wyp_inne'];

        return $ret;
    }
    public function getZlecenieStatusBadge($id)
    {
        $z = $this->zlecenie_model->find($id);
        switch($z['status'])
        {
            case 0:
                echo '<span class="badge bg-danger fs-6 text-wrap">Oczekuje na naprawę</span>';
            break;
            case 1:
                echo '<span class="badge bg-warning fs-6 text-wrap">W naprawie</span>';
            break;
            case 2:
                echo '<span class="badge bg-success fs-6 text-wrap">Gotowe do odbioru</span>';
            break;
            case 3:
                echo '<span class="badge bg-secondary fs-6 text-wrap">Odebrane przez klienta</span>';
            break;
        }
    }

    public function displayZleceniaTable()
    {
        $allZlecenia = $this->zlecenie_model->findAll();
        $sM = new SerwisantModel();
        $express = '';
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
            if($r['czy_ekspres'] == 1) $express = " <i title='Ekspres' class='fa-solid fa-truck-fast'>Ekspres</i>";
            else $express = '';

            echo '<tr class="clickable-row" data-href="/Zlecenia/Details/'. $r['id'] .'">';
            echo '<td>'. $r['id'] .'</td>';
            echo '<td>'. $r['nazwa'] .'</td>';
            echo '<td>'. $r['serial'] .'</td>';
            echo '<td>'. $r['data_przyjecia'] . $express .'</td>';

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
