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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Zlecenia
                    </div>
                    <div class="card-body">
                        <?php $zC->displayZleceniaTable(); ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once("parts/foot.php"); ?>