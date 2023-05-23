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

        <?php




        $query = "SELECT DISTINCT `operatore` as operatore FROM hartat";
        $result1 = $crud->getData($query);

        echo "<select name='operatore' type='list' class='form-contol'><option value=''>Zgjidh operatorin</option>";
        foreach ($result1 as $key => $res){

            echo "<option value='$res[operatore]'>$res[operatore]</option>";
        }

        echo "</select>";
        ?>


        <button type="submit" name="kerko"  value="Kerko"><i class="fa fa-search fa-fw"></i> Search</button>
    </form>
    </div>
    <?php
    if(isset($_POST['kerko'])) {
    extract($_POST);
    ?>
    <h2 style="text-align: center; ">Raporti   per <?php echo $operatore?></h2>

    <table class="table " id="testtable" id="thetable">
        <body onload="alternate('thetable')">
        <thead class="thead-light">
        <tr>
            <th>Data_Fine</th>
            <th>Operatore</th>
            <th>Provinca</th>
            <th>Strade</th>
            <th>Civici</th>
            <th>Civici_Operator</th>

        </tr>
        </thead>
        <tbody>
        <?php


            $query="SELECT data_fine, operatore, Communa, GROUP_CONCAT(DISTINCT fushata) as provinca, count(folder) as campagne, sum(civici) as civ, sum(civici_operatore) as civop FROM `hartat` where operatore='$operatore' GROUP BY data_fine, Communa";
            $result5=$crud->getData($query);
            foreach ($result5 as $key=>$res5){
                ?>
                <tr>
                <td><?php echo $res5['data_fine']; ?></td>
                <td><?php echo $res5['operatore']; ?></td>
                <td><?php echo $res5['provinca']; ?></td>
                <td><?php echo $res5['campagne']; ?></td>
                <td><?php echo $res5['civ']; ?></td>
                <td><?php echo $res5['civop']; ?></td>
                </tr><?php
            }

        }

        ?>
    </table>
    <div class="input-group  mt-6 justify-content-center">
        <button class="btn" type="button" onclick="tableToExcel('testtable', 'Consegne')" value="Shkarko ne excel2"><i class="fa fa-download"></i> Download </button>
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
