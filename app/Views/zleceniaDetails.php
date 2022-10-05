<?php
include_once("parts/head.php");
use App\Controllers\Zlecenia;

$zC = new Zlecenia();
$z = $zC->getZlecenie($id);
?>
<div id="layoutSidenav">

    <?php include_once("parts/sidenav.php"); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Zlecenie <span style="color:gray">#<?php echo $z['id'] ?> </span>- Szczegóły <span style="color:gray">[<?php echo $z['nazwa'] ?>]</span></h1>
                <ol class="breadcrumb mb-4">
                    <?php echo $zC->getBreadcrumbs(); ?>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Zlecenia
                    </div>
                    <div class="card-body">
                        <?php 
                        print_r($z);
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <?php include_once("parts/foot.php"); ?>