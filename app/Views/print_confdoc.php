<!DOCTYPE html>
<html>
    <?php
    date_default_timezone_set('Europe/Warsaw');
     //print_r($zlecenie); 
     $data_zlecenia = new DateTime($zlecenie['data_przyjecia']);
        $czy_ekspres = "NIE";
        $czy_gwarancja = "NIE";
     if($zlecenie['czy_ekspres'] == 1) $czy_ekspres = "TAK";
     if($zlecenie['czy_gwarancja'] == 1) $czy_gwarancja = "TAK";

     $firstRun = 1;
        $str = array();
        if($zlecenie['czy_kable']) array_push($str, "kable");
        if($zlecenie['czy_opak']) array_push($str, "opakowanie");
        if($zlecenie['czy_zasilacz']) array_push($str, "zasilacz");
        if($zlecenie['czy_plyty']) array_push($str, "płyty");
        
        $ret = '';
        $fR = 1;
        foreach($str as $e)
        {
            if($fR)
            {
                $fR = 0;
                $ret .= ucfirst($e). ", ";
            }
            else
            {
                $ret .= $e . ", ";
            }
        }
        $ret = substr($ret, 0,-2);

        if($zlecenie['wyp_inne'] != "") $ret .= "<br>" . $zlecenie['wyp_inne'];

     ?>
  <head>
    <title>Drukuj potwierdzenie</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/qrcode.js"></script>
  </head>
  <style>
    @font-face {
        font-family: worksans;
        src: url(/fonts/worksans.ttf);
        }
    #qrcode{
        display: inline-block;
        position: absolute;
    top: 10px;
    left: 451px;
    }
    #qrcode2{
        display: inline-block;
        position: absolute;
        top: 402px;
    left: 688px;
    }
    #data-przyjecia
    {
        position: absolute;
        margin-left: 10px;
    }
    .flex-container {
  padding: 0;
  margin: 0;
  list-style: none;
  display: flex;
}

.flex-start { 
  justify-content: space-between; 
}

    body
    {
        margin:0;
        font-size:8pt;
        font-family: worksans;
        width: 210mm;
        height: 297mm;
        padding:15px;
        border: 1px solid black;
        box-sizing: border-box;
    }
    .title
    {
        font-weight: 800;
        font-size: 14pt;
        border-bottom: 1px solid black;
    }
</style>
<input type="hidden" id="id_zlecenia" value="<?php echo $zlecenie['id']; ?>" >
  <body id="toprint">
    <img style="width:170px;vertical-align: top;" src="/logo.png">
    <div style="display:inline-block;">
    <table style="display: inline-block;width: 235px;">
        <tr><td><b>DeluxePC Łukasz Zarych</b></td></tr>
        <tr><td>Południowa 42, 38-422 Krościenko Wyżne</td></tr>
        <tr><td>Tel.: 665171706</td></tr>
        <tr><td>email: serwis_dpc@outlook.com</td></tr>
        <tr><td>godz. pracy: 9:00 - 17:00</td></tr>
    </table>
    <table style="display: inline-block;width: 185px;vertical-align: top;float: right;margin-left: 135px;border-left: 1px solid black;height: 90px;">
        <tr><td style="font-size: 10pt;"><b>Protokół przyjęcia sprzętu<br>do naprawy</b></td></tr>
        <tr><td>Zlecenie nr: <?php echo $zlecenie['id']; ?></td></tr>
        <tr><td>z dnia: <?php echo date_format($data_zlecenia, "d.m.Y"); ?></td></tr>
    </table>
    <div id="qrcode"></div>
    </div>
    <hr>
    <div class="flex-container flex-start">
    <table style="display: inline-block;font-size:10pt;">
        <tr><td class="title"><b>Zleceniodawca</b></td></tr>
        <tr><td><?php echo $klient['nazwa']; ?></td></tr>
        <tr><td><?php echo $klient['ulica']; ?></td></tr>
        <tr><td><?php echo $klient['kod'] . ", " . $klient['miasto']; ?></td></tr>
        <tr><td>tel. <?php echo $klient['tel1']; ?></td></tr>
        <tr><td>e-mail: <?php echo $klient['mail']; ?></td></tr>
    </table>

    <table style="display: inline-block;font-size:10pt;">
        <tr><td class="title"><b>Sprzęt</b></td></tr>
        <tr><td><b>Nazwa: </b><?php echo $zlecenie['nazwa']; ?></td></tr>
        <tr><td><b>SN: </b><?php echo $zlecenie['serial']; ?></td></tr>
        <tr><td><b>Ekspres: </b><?php echo $czy_ekspres; ?></td></tr>
        <tr><td><b>Gwarancja: </b><?php echo $czy_gwarancja; ?></td></tr>
    </table>
    
</div>
<p style='font-size: 8pt;text-align:justify;'>Sprzęt zostanie zdiagnozowany wyłącznie pod kątem usterki zgłoszonej przez klienta. Serwis zastrzega sobie możliwość odstąpienia od naprawy w przypadku braku wymaganych części zamiennych. Za akcesoria pozostawione w sprzęcie, a nie wpisane w formularz przyjęcia sprzętu serwis nie odpowiada. Na wykonane usługi serwis udziela 3 miesięcznej gwarancji, wyjątkiem jest sprzęt po zalaniu bądź uszkodzeniu ze strony instalacji zasilającej lub wyładowań atmosferycznych. Gwarancja na usługę naprawy takiego sprzętu wynosi wtedy 1 miesiąc. Wymienione elementy objęte są gwarancją ich producenta (sprzedawcy).
</p>
<p style="font-size: 12pt;font-weight: bold;text-decoration: underline;">Niniejszy Protokół jest jedynym dokumentem uprawniającym do odbioru sprzętu.
</p>
<div style="text-align: end;border-bottom: 1px solid black;">odcinek dla klienta</div>
<div id="qrcode2"></div>
<div style="margin-top:10px;text-align: center;font-weight: bold;font-size: 14pt;">KARTA PRZYJĘCIA DO NAPRAWY<br><span style="font-weight:400;font-size:13pt;">Zlecenie nr <?php echo $zlecenie['id']; ?><br>z dnia <?php echo date_format($data_zlecenia, "d.m.Y"); ?><span></div>

<div style="margin-top: 40px;" class="flex-container flex-start">
    <table style="display: inline-block;font-size:10pt;">
        <tr><td class="title"><b>Zleceniodawca</b></td></tr>
        <tr><td><?php echo $klient['nazwa']; ?></td></tr>
        <tr><td><?php echo $klient['ulica']; ?></td></tr>
        <tr><td><?php echo $klient['kod'] . ", " . $klient['miasto']; ?></td></tr>
        <tr><td>tel. <?php echo $klient['tel1']; ?></td></tr>
        <tr><td>e-mail: <?php echo $klient['mail']; ?></td></tr>
    </table>

    <table style="display: inline-block;font-size:10pt;">
        <tr><td class="title"><b>Sprzęt</b></td></tr>
        <tr><td><b>Nazwa: </b><?php echo $zlecenie['nazwa']; ?></td></tr>
        <tr><td><b>SN: </b><?php echo $zlecenie['serial']; ?></td></tr>
        <tr><td><b>Ekspres: </b><?php echo $czy_ekspres; ?></td></tr>
        <tr><td><b>Gwarancja: </b><?php echo $czy_gwarancja; ?></td></tr>
    </table>
    
    <table style="display: inline-block;font-size:10pt;">
        <tr><td class="title"><b>Wyposażenie</b></td></tr>
        <tr><td><?php echo $ret; ?></td></tr>
    </table>

</div>

<div style="margin-top: 0px;" class="flex-container flex-start">
    <table style="display: inline-block;font-size:10pt;">
        <tr><td class="title"><b>Opis uszkodzenia</b></td></tr>
        <tr><td><?php echo $zlecenie['opis_usterki']; ?></td></tr>
    </table>

</div>
<p style='font-size: 8pt;text-align:justify;'>Sprzęt zostanie zdiagnozowany wyłącznie pod kątem usterki zgłoszonej przez klienta. Serwis zastrzega sobie możliwość odstąpienia od naprawy w przypadku braku wymaganych części zamiennych. Za akcesoria pozostawione w sprzęcie, a nie wpisane w formularz przyjęcia sprzętu serwis nie odpowiada. Na wykonane usługi serwis udziela 3 miesięcznej gwarancji, wyjątkiem jest sprzęt po zalaniu bądź uszkodzeniu ze strony instalacji zasilającej lub wyładowań atmosferycznych. Gwarancja na usługę naprawy takiego sprzętu wynosi wtedy 1 miesiąc. Wymienione elementy objęte są gwarancją ich producenta (sprzedawcy).
</p>
<div style="margin-top: 0px;" class="flex-container flex-start">
<div style='display:inline-block;border: 1px solid black;height: 120px;width: 300px;'>
<table style="width: 100%;height:100%;border-collapse:collapse;table-layout:auto;">
    <tr><td style="font-size:9pt;text-align:center;vertical-align: top;"><?php echo date('d.m.Y'); ?></td></tr>
    <tr><td style="font-size:9pt;text-align:center;vertical-align: bottom;"><?php echo $serwisant['nazwisko'] . " " . $serwisant['imie']; ?></td></tr>
</table>
</div>
<div style='display:inline-block;border: 1px solid black;height: 120px;width: 300px;'>
<table style="width: 100%;height:100%;border-collapse:collapse;table-layout:auto;">
    <tr><td style="font-size:9pt;text-align:center;vertical-align: top;"><?php echo date('d.m.Y'); ?></td></tr>
    <tr><td style="font-size:9pt;text-align:center;vertical-align: bottom;">podpis zleceniodawcy</td></tr>
</table>
</div>


</div>

    <span style="position: absolute;top: 1097px;">
        Wydrukowano w programie DeluxePC
    </span>
    <span style="position: absolute;top: 1097px;left: 737px;">
        <?php echo date("H:i:s"); ?>
    </span>


</body>
<script>
    new QRCode(document.getElementById("qrcode"), {
    text: document.getElementById("id_zlecenia").value,
    width: 90,
    height: 90,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
new QRCode(document.getElementById("qrcode2"), {
    text: document.getElementById("id_zlecenia").value,
    width: 90,
    height: 90,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
</script>

</html>