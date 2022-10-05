<?php
include_once("parts/head.php");

use App\Controllers\Serwisant;

$sC = new Serwisant();
?>
<div id="layoutSidenav">

    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Serwisanci</h1>
                <ol class="breadcrumb mb-4">
                <?php echo $sC->getBreadcrumbs(); ?>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Serwisanci
                    </div>
                    <div class="card-body">
                        <?php ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once("parts/foot.php"); ?>