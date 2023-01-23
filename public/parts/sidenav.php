<div id="layoutSidenav_nav">
<?php
use App\Controllers\Serwisant;
$sC = new Serwisant;

$currSerwisant = $sC->getCurrent();
if(!empty($currSerwisant['nazwisko']))
    $currSerwisant = $currSerwisant['nazwisko'] . " " . $currSerwisant['imie'];
else $currSerwisant = "";
?>
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="/Zlecenia">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard"></i></div>
                                Zlecenia
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Zalogowano jako:</div>
                        <b><?php echo $currSerwisant; ?></b>
                    </div>
                </nav>
            </div>