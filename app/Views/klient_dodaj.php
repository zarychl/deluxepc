<?php
include_once("parts/head.php");

use App\Controllers\Klient;

$kC = new Klient();

?>
<div id="layoutSidenav">
    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Klient - Dodaj nowego</h1>
                <div class="card mb-4">
                    <div class="card-body">

                    <?= \Config\Services::session()->getFlashdata('msg'); ?>
                    <form class="insert-form" method="post" action="<?= base_url() ?>/Klient/Dodaj">

                    
                    <div class="row">
                        <div class="col-5">
                            <form class="insert-form" method="post" action="<?= base_url() ?>/Zlecenia/Edytuj">
                                <label for="nazwa">Nazwa klienta</label>
                                <input class="form-control" type="text" id="nazwa" name="nazwa">
                                <label for="nip">NIP</label>
                                <input class="form-control" type="text" id="nip" name="nip">
                                <label for="ulica">Ulica</label>
                                <input class="form-control" type="text" id="ulica" name="ulica">
                                <label for="kod">Kod pocztowy i miejscowość</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" id="kod" name="kod">
                                    <input style="width:50%" class="form-control" type="text" id="miasto" name="miasto">
                                </div>
                                <label for="kod">Telefon</label>
                                <div class="input-group mb-3">
                                    <input placeholder="Telefon 1" class="form-control" type="text" id="tel1" name="tel1">
                                    <input placeholder="Telefon 2"  class="form-control" type="text" id="tel2" name="tel2">
                                </div>
                                <label for="nip">Adres e-Mail</label>
                                <input class="form-control" type="text" id="mail" name="mail">
                                <label for="nip">Uwagi</label>
                                <input class="form-control" type="text" id="uwagi" name="uwagi">
                                <button class="btn btn-success form-control" type="submit">Dodaj nowego</button>
                        </div>
                        
                        </form>
                    </div>

                    <div class="row">
                       
                    </div>

            
                    </form>

                    </div>
                </div>
            </div>
        </main>
        

        
        <?php include_once("parts/foot.php"); ?>