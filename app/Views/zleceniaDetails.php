<?php
include_once("parts/head.php");

use App\Controllers\Klient;
use App\Controllers\Serwisant;
use App\Controllers\Uslugi;
use App\Controllers\Zlecenia;
use CodeIgniter\Cookie\Cookie;

$zC = new Zlecenia();
$kC = new Klient();
$sC = new Serwisant();
$uC = new Uslugi();
$z = $zC->getZlecenie($id);
?>
<div id="layoutSidenav">

    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Zlecenie <span style="color:gray">#<?php echo $z['id'] ?> </span>- Szczegóły <span style="color:gray">[<?php echo $z['nazwa'] ?>]</span></h1>
                <ol class="breadcrumb mb-4">
                    <?php //echo $zC->getBreadcrumbs(); ?>
                </ol>
                <div class="card mb-4">

                    <div class="card-body">
                        <?php 
                        
                        ?>
                        <input type="hidden" id="zlecenieId" value="<?php echo $id?>">
                        <div class="row justify-content-between">
                            <div class="table-responsive col-5">
                            <table class="table">
                            <tbody>
                                <tr>
                                    <th>Klient:</th>
                                    <td><?php echo $kC->getKlientVCard($z['id_klient']); ?></td>
                                </tr>
                                <tr>
                                    <th>Numer seryjny:</th>
                                    <td><?php echo $z['serial']; ?></td>
                                </tr>
                                <tr>
                                    <th>Uwagi:</th>
                                    <td><?php echo $z['uwagi']; ?></td>
                                </tr>
                                <tr>
                                    <th >Opis usterki:</th>
                                    <td><?php echo $z['opis_usterki']; ?></td>
                                </tr>
                                <tr>
                                    <th >Opis naprawy:</th>
                                    <td><?php echo $z['opis_naprawy']; ?></td>
                                </tr>
                            </tbody>
                            </table>
                            </div>
                            <div class="table-responsive col-5">
                                <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Serwisant:</th>
                                        <td><?php echo $sC->getSerwisantVCard($z['id_serwisant']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Data przyjęcia:</th>
                                        <td><?php echo $z['data_przyjecia']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Data naprawy:</th>
                                        <td><?php echo $z['data_naprawy']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Usługi:</th>
                                        <td>
                                            <?php
                                                echo $zC->listUslugi($z['id']);
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Wyposażenie<br>dodatkowe:</th>
                                        <td><?php
                                                echo $zC->listZestaw($z['id']);
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td class=""><?php $zC->getZlecenieStatusBadge($z['id']); ?></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            </div>
                            <div class="row">
                            <br><h5>Wykonane usługi</h5><hr>
                            <div class="table-responsive col-7">
                                <table class="table table-sm uslugi-table">
                                    <thead class="thead">
                                        <tr>
                                        <th scope="col">Lp.</th>
                                        <th scope="col">Nazwa usługi</th>
                                        <th scope="col">Cena jedn.</th>
                                        <th scope="col">Ilość</th>
                                        <th scope="col">Wartość</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $uslugi = $zC->getUslugi($z['id']);
                                            $razem = 0;
                                            $i = 1;
                                            foreach($uslugi as $u)
                                            {
                                                if($u['customPrice'] != NULL)
                                                    $cena = $u['customPrice'];
                                                else
                                                    $cena = $uC->getCenaFromId($u['id_uslugi']);
                                                $wartosc = $cena * $u['ilosc'];
                                                $razem += $wartosc;
                                                echo '
                                                <tr>
                                                    <th scope="row">'. $i .'</th>
                                                    <td>' . $uC->getNameFromId($u['id_uslugi']) . '</td>
                                                    <td>'. number_format($cena, 2, '.', ' ') .' PLN</td>
                                                    <td>'. $u['ilosc'] .'</td>
                                                    <td>'. number_format($wartosc, 2, '.', ' ') .' PLN</td>
                                                    <td>
                                                    <a style="cursor:pointer" onclick="showDeleteUslugaModal('. $u['id'] .')" style="margin-left:5px;" class="" ><i class="fa-solid fa-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                                ';
                                                $i = $i + 1;
                                            }

                                        ?>
                                    </tbody>
                                    <tfoot class="thead">
                                        <tr>
                                            <th colspan='4'>RAZEM: </th><th><?php echo number_format($razem, 2, '.', ' '); ?> PLN</th>
                                        </tr>
                                    </tfoot>
                                    </table>
                            </div>
                            <div class="col-2">
                                <a data-bs-toggle="modal" data-bs-target="#dodajUslugaModal" style="margin-left:5px;" class="btn btn-success" ><i class="fa-solid fa-plus"></i> Dodaj</a>
                            </div>
                            </div>


                    <hr>
                    <?php
                    //oczekuje na naprawę
                    if($z['status'] == 0)
                    {
                        echo '<a onclick="modalShowHandler(0)" style="margin-left:5px;" class="btn btn-primary float-end" ><i class="fa-solid fa-play"></i> Rozpocznij naprawę</a>&nbsp;';
                    }

                    //w naprawie
                    else if($z['status'] == 1)
                    {
                        echo '<a onclick="modalShowHandler(1)" style="margin-left:5px;" class="btn btn-danger float-end" ><i class="fa-solid fa-ban"></i> Zakończ naprawę</a>&nbsp;';
                    }

                    //oczekuje na odbiór
                    else if($z['status'] == 2)
                    {
                        echo '<a onclick="modalShowHandler(2)" style="margin-left:5px;" class="btn btn-success float-end" ><i class="fa-solid fa-check"></i> Potwierdź odbiór sprzętu</a>&nbsp;';
                        echo '<a onclick="modalShowHandler(3)" style="margin-left:5px;" class="btn btn-secondary float-end" ><i class="fa-solid fa-forward-step"></i> Rozpocznij ponowną naprawę</a>&nbsp;';
                        
                    }
                    else if($z['status'] == 3)
                    {
                        echo '<a onclick="modalShowHandler(3)" style="margin-left:5px;" class="btn btn-secondary float-end" ><i class="fa-solid fa-forward-step"></i> Rozpocznij ponowną naprawę</a>&nbsp;';
                        

                    }

                    ?>
                    <button style="margin-left:5px;" class="btn btn-warning float-end" type="submit" value="Submit"><i class="fa-solid fa-pencil"></i> Edytuj</button>&nbsp;
                    
                        </div>
                </div>
            </div>
        </main>

        <!-- Modal Potwierdzenie-->            
        <div id='potwierdzenieModal' class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Potwierdzenie</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="potwierdzenieText"></p>
                </div>
                <div class="modal-footer">
                    <a id="confBtn" href="" type="button" class="btn btn-success">Tak</a>
                    <a type="button" class="btn btn-danger" data-bs-dismiss="modal">Nie</a>
                </div>
                </div>
            </div>
        </div>

        <div id='dodajUslugaModal' class="modal fade" tabindex="-1" role="dialog">
        <form method="POST" action="/Uslugi/Add">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dodaj usługę</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Zamknij">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <input name="id_zlecenia" type="hidden" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label>Usługa</label>
                            <select name="id_uslugi" class="form-control">
                                <option value="-1">--- Wybierz ---</option>
                                <?php 
                                    $allUslugi = $uC->getAll();
                                    foreach($allUslugi as $u)
                                    {
                                        echo "<option value='". $u['id'] ."'>[". $u['cena_brutto'] ." PLN] ". $u['nazwa'] ."</option>";
                                    }
                                ?>
                            </select>
                                </div>
                                <br/>
                            <div class="form-group">
                            <label>Niestandardowa cena</label>    
                                <input id="customPrice" name="customPrice" placeholder="Niestandard. cena" class="form-control" type="number" step="0.01" min="0">
                            </div>
                            <br/>
                            <div class="form-group">   
                            <label>Ilość</label> 
                                <input id="ilosc" name="ilosc" placeholder="Ilość" class="form-control" type="number" step="1" min="0" value="1">
                            </div>
                    
                </div>
                <div class="modal-footer">
                    <button id="editUslugaBtn" type="submit" class="btn btn-success">Dodaj</button>
                    <a type="button" class="btn btn-danger" data-bs-dismiss="modal">Anuluj</a>
                </div>
                </div>
                </form>
            </div>
        </div>

        <div id='deleteUslugaModal' class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Usuń usługę</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Zamknij">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        Czy na pewno usunąć tą usługę?
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="deleteUslugaBtn" onclick="deleteUsluga()" data-id="-1" type="button" class="btn btn-success">Tak</a>
                    <a type="button" class="btn btn-danger" data-bs-dismiss="modal">Nie</a>
                </div>
                </div>
            </div>
        </div>

        <script>
            var desc = [
                "Czy na pewno <span style='color:#0d6efd;font-weight:bold;'> rozpocząć naprawę</span>?",
                "Czy na pewno <span style='color:red;font-weight:bold;'>zakończyć naprawę</span>?",
                "Czy na pewno <span style='color:green;font-weight:bold;'>potwierdzić odbiór sprzętu</span>?",
                "Czy na pewno <span style='color:grey;font-weight:bold;'>rozpocząć ponowną naprawę</span>?"
            ];

            function modalShowHandler(buttonType)
            {
                var link = "";

                $(document).ready(function(){
                    document.getElementById("potwierdzenieText").innerHTML = desc[buttonType];
                $('#potwierdzenieModal').modal('show');
                });

                if(buttonType == 0)//rozpoczęcie naprawy
                    link = '/Zlecenia/Rozpocznij/' + document.getElementById("zlecenieId").value;
                else if(buttonType == 1)//zakończenie naprawy
                    link = '/Zlecenia/Zakoncz/' + document.getElementById("zlecenieId").value;
                else if(buttonType == 2)//potwierdzenie odbioru
                    link = '/Zlecenia/PotwierdzOdbior/' + document.getElementById("zlecenieId").value;
                else if(buttonType == 3)//ponowna naprawa
                    link = '/Zlecenia/PonownieRozpocznij/' + document.getElementById("zlecenieId").value;
                
                $('#confBtn').attr('href',link);
            }
            function showDeleteUslugaModal(id)
            {
                $('#deleteUslugaBtn').data('id', id);
                $('#deleteUslugaModal').modal('show');
            }
            function deleteUsluga()
            {
                location.href = "/Uslugi/Delete/" + $('#deleteUslugaBtn').data('id');
            }
        </script>

        <?php //$zC->PotwierdzOdbior(9); ?>
        <?php include_once("parts/foot.php"); ?>