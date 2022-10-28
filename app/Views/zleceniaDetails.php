<?php
include_once("parts/head.php");

use App\Controllers\Klient;
use App\Controllers\Serwisant;
use App\Controllers\Zlecenia;

$zC = new Zlecenia();
$kC = new Klient();
$sC = new Serwisant();
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

                    <hr>
                    <?php
                    //oczekuje na naprawę
                    if($z['status'] == 0)
                    {
                        echo '<a style="margin-left:5px;" class="btn btn-primary float-end" ><i class="fa-solid fa-play"></i> Rozpocznij naprawę</a>&nbsp;';
                    }

                    //w naprawie
                    else if($z['status'] == 1)
                    {
                        echo '<a style="margin-left:5px;" class="btn btn-danger float-end" ><i class="fa-solid fa-ban"></i> Zakończ naprawę</a>&nbsp;';
                    }

                    //oczekuje na odbiór
                    else if($z['status'] == 2)
                    {
                        echo '<a style="margin-left:5px;" class="btn btn-success float-end" ><i class="fa-solid fa-check"></i> Potwierdź odbiór sprzętu</a>&nbsp;';
                        echo '<a style="margin-left:5px;" class="btn btn-secondary float-end" ><i class="fa-solid fa-forward-step"></i> Rozpocznij ponowną naprawę</a>&nbsp;';
                        
                    }
                    else if($z['status'] == 3)
                    {
                        echo '<a style="margin-left:5px;" class="btn btn-secondary float-end" ><i class="fa-solid fa-forward-step"></i> Rozpocznij ponowną naprawę</a>&nbsp;';
                        

                    }

                    ?>
                    <button style="margin-left:5px;" class="btn btn-warning float-end" type="submit" value="Submit"><i class="fa-solid fa-pencil"></i> Edytuj</button>&nbsp;
                    
                        </div>
                </div>
            </div>
        </main>
        <?php $zC->PotwierdzOdbior(9); ?>
        <?php include_once("parts/foot.php"); ?>