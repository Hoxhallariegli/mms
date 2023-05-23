<?php
include('includes/header1.php');
include_once('ini.php');
include_once("shto_function.php");


if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
    $crud = new Crud();
    $validation = new Validation();
    $employee_id = $_SESSION['Ferid'];
    $level = $_SESSION['Access'];
    $crud = new Crud();
    $query = "SELECT DISTINCT `operatore` as operatore FROM hartat";
    $result1 = $crud->getData($query);

    if(isset($_GET['fushatat'])){
        $fushata= $_GET['fushatat'];
        $procesi=$_GET['procesi'];
    }
    if (isset($_POST['shkarko'])) {
        header("Location: shkarko_material.php?fushatat=$fushata");
    }
    if (isset($_POST['shkarko_raport_ditor'])) {
        header("Location: shkarko_raport_ditor.php");
    }
    ?>
    <html>
    <head>
        <style>
            .excel{
                align-content: center;
                margin: 93px;
                bottom: 75%;
                position: relative;
                left: 50%;

            }
        </style>
        <script type="text/javascript">
            var tableToExcel = (function() {
                var uri = 'data:application/vnd.ms-excel;base64,'
                    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
                    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
                    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
                return function(table, name) {
                    if (!table.nodeType) table = document.getElementById(table)
                    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                    window.location.href = uri + base64(format(template, ctx))
                }
            })()
        </script>
        <title>Modifiko db</title>
        <link rel="stylesheet" type="text/css"  href="css/styles.css"/>
        <!--   <link rel="stylesheet" type="text/css"  href="css/styles.css"/> -->
    </head>

    <div  class = "col-sm-12 mt-4" align = "center">
    <form class="form-group" action="" method="POST">

        <td>
            <input type="date" name="data1" class="datedate" value="<?php echo date('Y-m-d'); ?>" />


        </td>

        <input type="submit" name="kerko" class="mybutton1s" class="btn btn-outline-success btn-block" value="Cerca">
    </form>
    </div>
    <?php
    if(isset($_POST['kerko'])) {
    extract($_POST);

    ?>
    <h3 style="text-align: center; ">Punët e përfunduara ne daten <?php echo $data1?></h3>


    <table class="table " id="testtable" id="thetable">
        <body onload="alternate('thetable')">
        <thead class="thead-light mt-3">
        <tr>
            <th>Communa</th>
            <th>Campagne</th>
            <th>Operatore</th>
            <th>Date Inizio</th>
            <th>Ora_Inizio</th>
            <th>Data_Fine</th>
            <th>Ora_Fine</th>
            <th>Strade</th>
            <th>Civici Sistema</th>
            <th>Civici OP</th>
            <th>Tempistice</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $query="SELECT Communa, GROUP_CONCAT(DISTINCT hartat.fushata) as campagne, count(hartat.folder), hartat.operatore, min(date(fillimi)) as datainizio, min(time(fillimi)) as orainizio, max(date(mbarimi)) as datafine, 
max(time(mbarimi)) as orafine, count(hartat.folder) as strade, sum(civici) as civici_sistema, sum(civici_operatore) as civici_operatore, 
SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))) as somma
FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where date(koha_punes.mbarimi) ='$data1' and date(data_fine)='$data1' and (operatore is not null and operatore !='') and koha_punes.veprimi_permbylles='perfunduar' group by Communa, operatore";
        $result5=$crud->getData($query);
        foreach ($result5 as $key=>$res5){
            ?>
            <tr>

            <td><?php echo $res5['Communa']; ?></td>
            <td><?php echo $res5['campagne']; ?></td>
            <td><?php echo $res5['operatore']; ?></td>
            <td><?php echo $res5['datainizio']; ?></td>
            <td><?php echo $res5['orainizio']; ?></td>
            <td><?php echo $res5['datafine']; ?></td>
            <td><?php echo $res5['orafine']; ?></td>
            <td><?php echo $res5['strade']; ?></td>
            <td><?php echo $res5['civici_sistema']; ?></td>
            <td><?php echo $res5['civici_operatore']; ?></td>

            <td><?php echo $res5['somma']; ?></td>
            </tr><?php

        }
        }

        ?>
    </table>
    <div class="input-group  mt-6 justify-content-center">
    <button type="button" onclick="tableToExcel('testtable', 'Consegne')" value="Shkarko ne excel2"><i class="fa fa-download"></i> Scarica </button>
    </div>

    </div>
    </div>
    </body>
    </html>

    <?php include('includes/footer.php');

} else {

    header("location: ../../index.php");
}
?>
