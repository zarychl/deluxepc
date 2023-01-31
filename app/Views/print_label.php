<!DOCTYPE html>
<html>
    <?php //print_r($zlecenie); ?>
  <head>
    <title>Drukuj etykietę</title>
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
    }
    #data-przyjecia
    {
        position: absolute;
        margin-left: 10px;
    }
    body
    {
        margin:0;
        font-family: worksans;
        width: 105mm;
        height: 148mm;
        padding:15px;
        /*border: 1px solid black; */
        box-sizing: border-box;
    }
    .title
    {
        font-weight: 800;
        font-size: 14pt;
        border-bottom: 1px solid black;
    }
</style>
  <body id="toprint">
    <div style="font-family:'Courier New';font-size: 14pt;"><?php echo $zlecenie['id']; ?></div>
    <input type="hidden" id="id_zlecenia" value="<?php echo $zlecenie['id']; ?>">
<div id="qrcode"></div>
<span id="data-przyjecia"><?php echo $zlecenie['data_przyjecia']; ?></span>
<?php
if($zlecenie['czy_ekspres'] == 1)
{
    echo "<span class='title'>EXPRESS!</span>";
}
?>
<br>
<div class="title">Klient</div>
<table>
    <tr><td><?php echo $klient['nazwa']; ?></td></tr>
    <tr><td>tel. <?php echo $klient['tel1']; ?></td></tr>
</table>
<br>
<div class="title">Sprzęt</div>
<table>
    <tr><td><?php echo $zlecenie['nazwa']; ?></td></tr>
    <tr><td><?php echo $zlecenie['serial']; ?></td></tr>
    <tr><td><?php echo $zlecenie['opis_usterki']; ?></td></tr>
</table>
<br>
<div class="title">Uwagi</div>
<table>
    <tr><td><?php echo $zlecenie['uwagi']; ?></td></tr>
</table>
  </body>
<script>
    new QRCode(document.getElementById("qrcode"), {
    text: document.getElementById("id_zlecenia").value,
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
</script>
<script>
window.print();

</script>
</html>