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


    if(isset($_GET['fushatat'])){
        $fushata= $_GET['fushatat'];
        $procesi=$_GET['procesi'];
    }
    if (isset($_POST['shkarko'])) {
        header("Location: shkarko_material.php?fushatat=$fushata");
    }
    if (isset($_POST['shkarko_steps'])) {
        header("Location: shkarko_steps.php?fushatat=$fushata");
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
            <td>
                <input type="date" name="data2" class="datedate" value="<?php echo date('Y-m-d'); ?>" />


            </td>
            <?php




            $query = "SELECT DISTINCT `operatore` as operatore FROM hartat";
            $result1 = $crud->getData($query);

            echo "<select name='operatore' type='list' class='form-contol'><option value=''>Zgjidh operatorin</option>";
            foreach ($result1 as $key => $res){

                echo "<option value='$res[operatore]'>$res[operatore]</option>";
            }
            echo "<option value='tegjithe'>Te Gjithe</option>";
            echo "</select>";
            ?>


            <button type="submit" name="kerko"   ><i class="fa fa-search fa-fw"></i> Search</button>
        </form>
    </div>
    <?php
    if(isset($_POST['kerko'])) {
    extract($_POST);
    ?>
    <h2 style="text-align: center; ">Punët e përfunduara nga data <?php echo $data1?> ne daten <?php echo $data2?> per<span class="fw-bold"> <?php echo $operatore?></span></h2>


    <table class="table" id="testtable" id="thetable">
        <body onload="alternate('thetable')">
        <thead class="thead-light">
        <tr>
            <th>OPERATORI</th>
            <th>Communa</th>
            <th>Civici Sistema</th>
            <th>Civici Operatore</th>
            <th>Date Inizio</th>
            <th>Ora_Inizio</th>
            <th>Data_Fine</th>
            <th>Ora_Fine</th>
            <th>Tempistiche</th>

        </tr>
        </thead>
        <tbody>
        <?php
        if($operatore=='tegjithe'){
            $query="SELECT 
hartat.operatore, Communa, sum(civici) as civici_sistema, sum(civici_operatore) as civici_operatore, min(date(fillimi)) as datainizio, min(time(fillimi)) as orainizio, max(date(mbarimi)) as datafine, 
max(time(mbarimi)) as orafine,
SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))) as Ore_Totale
FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where hartat.data_inizio >='$data1' and hartat.data_fine<='$data2' and koha_punes.veprimi_permbylles='perfunduar' group by Communa, operatore";
            $result5=$crud->getData($query);
            foreach ($result5 as $key=>$res5){
                ?>
                <tr>
                <td><?php echo $res5['operatore']; ?></td>
                <td><?php echo $res5['Communa']; ?></td>
                <td><?php echo $res5['civici_sistema']; ?></td>
                <td><?php echo $res5['civici_operatore']; ?></td>
                <td><?php echo $res5['datainizio']; ?></td>
                <td><?php echo $res5['orainizio']; ?></td>
                <td><?php echo $res5['datafine']; ?></td>
                <td><?php echo $res5['orafine']; ?></td>
                <td><?php echo $res5['Ore_Totale']; ?></td>
                </tr><?php
            }
        }else{

            $query="SELECT 
hartat.operatore, Communa, sum(civici) as civici_sistema, sum(civici_operatore) as civici_operatore, min(date(fillimi)) as datainizio, min(time(fillimi)) as orainizio, max(date(mbarimi)) as datafine, 
max(time(mbarimi)) as orafine,
SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))) as Ore_Totale
FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where hartat.data_inizio >='$data1' and hartat.data_fine<='$data2' and (operatore='$operatore') and koha_punes.veprimi_permbylles='perfunduar' group by Communa, operatore";
            $result5=$crud->getData($query);
            foreach ($result5 as $key=>$res5){
                ?>
                <tr>
                <td><?php echo $res5['operatore']; ?></td>
                <td><?php echo $res5['Communa']; ?></td>
                <td><?php echo $res5['civici_sistema']; ?></td>
                <td><?php echo $res5['civici_operatore']; ?></td>
                <td><?php echo $res5['datainizio']; ?></td>
                <td><?php echo $res5['orainizio']; ?></td>
                <td><?php echo $res5['datafine']; ?></td>
                <td><?php echo $res5['orafine']; ?></td>
                <td><?php echo $res5['Ore_Totale']; ?></td>
                </tr><?php
            }
        }
        }

        ?>
    </table>
    <div class="input-group  mt-6 justify-content-center">
        <button class="btn" type="button" onclick="tableToExcel('testtable', 'Consegne')" value="Shkarko ne excel2"><i class="fa fa-download"></i> Download </button>
    </div>
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
