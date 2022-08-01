<?php

namespace App\Controllers;

use App\Models\SerwisantModel;
use App\Models\ZleceniaModel;

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

    public function Details($id = NULL)
    {
        $data['id'] = $id;
        return view('zleceniaDetails', $data);
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
    public function displayZleceniaTable()
    {
        $allZlecenia = $this->zlecenie_model->findAll();
        $sM = new SerwisantModel();

        echo '<div class="card-body">
        <table id="datatablesZlecenia" class="table table-striped table-bordered dt-responsive nowrap">
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
            echo '<tr>';
            echo '<td>'. $r['id'] .'</td>';
            echo '<td>'. $r['nazwa'] .'</td>';
            echo '<td>'. $r['serial'] .'</td>';
            echo '<td>'. $r['data_przyjecia'] .'</td>';

            $s = $sM->find($r['id_serwisant']);

            echo '<td>'. $s['nazwisko'] . " " . $s['imie'] .'</td>';

            echo '<td style="font-weight:bold;" class="'. $this->statusInfo[$r['status']][0] .'">'. $this->statusInfo[$r['status']][1] .'</td>';
            echo '</tr>';
        }

        echo '</tbody>
        </table>';
        //print_r($allZlecenia);
    }
}
