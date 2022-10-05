<?php
include_once("parts/head.php");

use App\Controllers\Zlecenia;

$zC = new Zlecenia();
?>
<div id="layoutSidenav">

    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Zlecenia - Wszystkie zlecenia</h1>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Zlecenia
                    </div>
                    <div class="card-body">
                        <a href="/Zlecenia/Dodaj" class="btn btn-success"><i class="fa-solid fa-plus"></i> Dodaj nowe</a>
                        <?php $zC->displayZleceniaTable(); ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once("parts/foot.php"); ?>