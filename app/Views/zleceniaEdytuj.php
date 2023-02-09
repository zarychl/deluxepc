<?php
include_once("parts/head.php");

use App\Controllers\Zlecenia;
use App\Controllers\Klient;
use App\Controllers\Serwisant;

if(!isset($id))
    redirect()->to(site_url('/Zlecenia'));

$zC = new Zlecenia();
$kC = new Klient();
$sC = new Serwisant();

$z = $zC->getZlecenie($id);

$serwisant = $sC->getSerwisant($z['id_serwisant']);

$k = $kC->getKlient($z['id_klient']);
?>
<div id="layoutSidenav">
    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
            <h1 class="mt-4">Zlecenie <span style="color:gray">#<?php echo $z['id'] ?> </span>- Edytuj <span style="color:gray">[<?php echo $z['nazwa'] ?>]</span></h1>
                <div class="card mb-4">
                    <div class="card-body">

                    <?= \Config\Services::session()->getFlashdata('msg'); ?>
                    <form class="insert-form" method="post" action="<?= base_url() ?>/Zlecenia/Edytuj">

                    
                    <div class="row">
                        <div class="col-5">
                        <label>Klient:</label>
                            <div class="input-group mb-3">
                                <!-- <input type="text" class="form-control" disabled id="klient" name="klient"> -->

                                <select class="form-control" value="" readonly name="id_klient" id="id_klient">
                                    <option></option>
                                    <?php 
                                            echo '<option disabled selected value="'. $k['id'] .'">' . $kC->getKlientVCard($k['id']) . '</option>';
                                    ?>
                                    
                                </select>


                            </div>
                        </div>

                        <div class="col-4">
                            <label>Serwisant: </label>
                            <input value="<?php echo $serwisant['id']; ?>" class="form-control" hidden id="id_serwisant" name="id_serwisant">
                            <input value="<?php echo $serwisant['nazwisko'] . " " . $serwisant['imie'] . " #" . $serwisant['id']; ?>" class="form-control" disabled id="serwisant" name="serwisant">
                        </div>
                    </div>

                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="id" value="<?php echo $z['id']; ?>">
                            <label>Nazwa</label>
                            <input value="<?php echo $z['nazwa'];?>" name="nazwa" type="text" class="form-control" placeholder="Nazwa">
                            <label>Numer seryjny</label>
                            <input value="<?php echo $z['serial'];?>" name="serial" type="text" class="form-control" placeholder="Numer seryjny">
                            <label>Opis usterki</label>
                            <textarea value="" name="opis_usterki" rows="5" class="form-control" placeholder="Opis usterki..."><?php echo $z['opis_usterki'];?></textarea>
                            <label>Opis naprawy</label>
                            <textarea value="" name="opis_naprawy" rows="5" class="form-control" placeholder="Opis naprawy..."><?php echo $z['opis_naprawy'];?></textarea>
                            </div>
                            <div class="col-3">
                            <label>Data przyjęcia</label>
                            <input type="datetime-local" value="<?php echo $z['data_przyjecia'];?>" class="form-control" placeholder="Data przyjecia">
                            
                            <div class="form-check">
                                <input <?php if($z['czy_kable'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" value="" name="czy_kable" id="czy_kable">
                                <label class="form-check-label" for="czy_kable">
                                Kable
                                </label>
                            </div>

                            <div class="form-check">
                                <input <?php if($z['czy_zasilacz'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" value="" name="czy_zasilacz"  id="czy_zasilacz">
                                <label class="form-check-label" for="czy_zasilacz">
                                Zasilacz
                                </label>
                            </div>

                            <div class="form-check">
                                <input <?php if($z['czy_plyty'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" value="" name="czy_plyty" id="czy_plyty">
                                <label class="form-check-label" for="czy_plyty">
                                Płyty
                                </label>
                            </div>

                            <div class="form-check">
                                <input <?php if($z['czy_opak'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" value="" name="czy_opak" id="czy_opak">
                                <label class="form-check-label" for="czy_opak">
                                Opakowanie
                                </label>
                            </div>

                            <label>Dodatkowe wyposażenie</label>
                            <textarea name="wyp_inne" class="form-control" rows="5" placeholder="Dodatkowe elementy..."><?php echo $z['wyp_inne'];?></textarea>

                            </div>
                            <div class="col-3">
                            <label>Naprawa w ciągu (dni)</label>
                            <input name="dni_naprawy" id="dni_naprawy" type="number" min="1" value="<?php echo $z['dni_naprawy'];?>" class="form-control">

                            <div class="form-check">
                                <input <?php if($z['czy_gwarancja'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" value="" name="czy_gwarancja" id="czy_gwarancja">
                                <label class="form-check-label" for="czy_gwarancja">
                                Gwarancja
                                </label>
                            </div>  
                            
                            <div class="form-check">
                                <input <?php if($z['czy_ekspres'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" name="czy_ekspres" id="czy_ekspres">
                                <label class="form-check-label" for="czy_ekspres">
                                Ekspres
                                </label>
                            </div> 

                            <div class="form-check">
                                <input <?php if($z['czy_zewn'] == 1) echo 'checked'?> class="form-check-input" type="checkbox" name="czy_zew" id="czy_zew">
                                <label class="form-check-label" for="czy_zewn">
                                Serwis zewnętrzny
                                </label>
                            </div> 
                            <br>
                            <label>Uwagi</label>
                            <textarea name="uwagi" class="form-control" rows="5" placeholder="Uwagi"><?php echo $z['uwagi'];?></textarea>

                            </div>

                            <div class="card-footer">
                            <div class="col">
                                <button class="btn btn-warning float-end" type="submit" value="Submit"><i class="fa-solid fa-pencil"></i> Edytuj</button>
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
                <a href="/Klient/Dodaj" style="margin-bottom:8px;" type="button" class="btn btn-success">Dodaj nowego</a><br>
                <table class="display table table-bordered" id="datatablesKlientSelect">
                <thead>
                    <tr>
                    <th>ID</th><th>Nazwa</th><th>Adres</th><th>Telefon</th><th>Mail</th><th></th>
                    </tr>
                </thead>

                <tbody>
                
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
            document.getElementById('id_klient').value = $("#getklient").data("klientid");
            $("#klientModal").modal("hide");
        });
        </script>
        <?php include_once("parts/foot.php"); ?>