<?php
include_once("parts/head.php");

use App\Controllers\Zlecenia;
use App\Controllers\Klient;
use App\Controllers\Serwisant;

$zC = new Zlecenia();
$kC = new Klient();
$sC = new Serwisant();

$serwisant = $sC->getCurrent();

$allKlienci = $kC->getAllKlienci();
?>
<div id="layoutSidenav">
    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Zlecenia - Dodaj nowe</h1>
                <div class="card mb-4">
                    <div class="card-body">

                    <?= \Config\Services::session()->getFlashdata('msg'); ?>
                    <form class="insert-form" method="post" action="<?= base_url() ?>/Zlecenia/Dodaj">

                    <input class="form-control" hidden id="klientId" name="klientId">
                    <div class="row">
                        <div class="col-5">
                        <label>Klient:</label>
                            <div class="input-group mb-3">
                                <!-- <input type="text" class="form-control" disabled id="klient" name="klient"> -->

                                <select class="form-control" value="" disabled name="klient" id="klient">
                                    <option></option>
                                    <?php 
                                        foreach($allKlienci as $k)
                                        {
                                            echo '<option value="'. $k['id'] .'">' . $kC->getKlientVCard($k['id']) . '</option>';
                                        }
                                    ?>
                                    
                                </select>

                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" id="klientSelect">Wybierz</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Serwisant: </label>
                            <input value="<?php echo $serwisant['id']; ?>" class="form-control" hidden id="serwisantId" name="serwisantId">
                            <input value="<?php echo $serwisant['nazwisko'] . " " . $serwisant['imie'] . " #" . $serwisant['id']; ?>" class="form-control" disabled id="serwisant" name="serwisant">
                        </div>
                    </div>

                        <div class="row">
                            <div class="col">
                            <label>Nazwa</label>
                            <input name="nazwa" type="text" class="form-control" placeholder="Nazwa">
                            <label>Numer seryjny</label>
                            <input name="serial" type="text" class="form-control" placeholder="Numer seryjny">
                            <label>Opis usterki</label>
                            <textarea name="opis_usterki" rows="5" class="form-control" placeholder="Opis usterki..."></textarea>
                            </div>
                            <div class="col-3">
                            <label>Data przyjęcia</label>
                            <input type="datetime-local" value="<?php echo date("Y-m-d\TH:i"); ?>" class="form-control" placeholder="Data przyjecia">
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_kable" id="czy_kable">
                                <label class="form-check-label" for="czy_kable">
                                Kable
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_zasilacz"  id="czy_zasilacz">
                                <label class="form-check-label" for="czy_zasilacz">
                                Zasilacz
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_plyty" id="czy_plyty">
                                <label class="form-check-label" for="czy_plyty">
                                Płyty
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_opak" id="czy_opak">
                                <label class="form-check-label" for="czy_opak">
                                Opakowanie
                                </label>
                            </div>

                            <label>Dodatkowe wyposażenie</label>
                            <textarea name="wyp_inne" class="form-control" rows="5" placeholder="Dodatkowe elementy..."></textarea>

                            </div>
                            <div class="col-3">
                            <label>Naprawa w ciągu (dni)</label>
                            <input name="dni_naprawy" id="dni_naprawy" type="number" min="1" value="7" class="form-control">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_gwarancja" id="czy_gwarancja">
                                <label class="form-check-label" for="czy_gwarancja">
                                Gwarancja
                                </label>
                            </div>  
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_ekspres" id="czy_ekspres">
                                <label class="form-check-label" for="czy_ekspres">
                                Ekspres
                                </label>
                            </div> 

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="czy_zew" id="czy_zew">
                                <label class="form-check-label" for="czy_zew">
                                Serwis zewnętrzny
                                </label>
                            </div> 
                            <br>
                            <label>Uwagi</label>
                            <textarea name="uwagi" class="form-control" rows="5" placeholder="Uwagi"></textarea>

                            </div>

                            <div class="card-footer">
                            <div class="col">
                                <button class="btn btn-success float-end" type="submit" value="Submit"><i class="fa-solid fa-plus"></i> Dodaj</button>
                                    </div>
                            </div>

                        </div>

            
                    </form>

                    </div>
                </div>
            </div>
        </main>


        <!-- Modal Wybor klienta-->
        <div class="modal fade" id="klientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Wybierz klienta</h5>
                </button>
            </div>
            <div class="modal-body">
                <!-- tabekla -->
                <table class="display table table-bordered" id="datatablesKlientSelect">
                <thead>
                    <tr>
                    <th>ID</th><th>Nazwa</th><th>Adres</th><th>Telefon</th><th>Mail</th><th></th>
                    </tr>
                </thead>

                <tbody>
                <?php 
                    foreach($allKlienci as $k)
                    {
                        echo '<tr><td>'. $k['id'] .'</td>
                            <td>'. $k['nazwa'] .'</td>
                            <td>'. $k['ulica'] . ", " . $k['kod'] . " " . $k['miasto'] .'</td>
                            <td>'. $k['tel1'] . "<br>" . $k['tel2'] .'</td>
                            <td>'. $k['nip'] .'</td>
                            <td><button id="getklient" data-klientid="'. $k['id']  .'" type="button" class="btn btn-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i> Wybierz</button></td></tr>';
                    }
                    
                ?>
                </tbody>
                </table>
           <!-- end tabekla -->
            </div>
            </div>
        </div>
        </div>

        

        <script>
        checkEkspres = document.getElementById('czy_ekspres').addEventListener('click', event => {
            if(event.target.checked) {
                document.getElementById('dni_naprawy').value = 1;
            }
            else
            {
                document.getElementById('dni_naprawy').value= 7;
            }
        });

        $("#klientSelect").click(function (){
            $("#klientModal").modal("show");
        });

        $("#getklient").click(function (){
            document.getElementById('klient').value = $("#getklient").data("klientid");
            $("#klientModal").modal("hide");
        });
        </script>
        <?php include_once("parts/foot.php"); ?>