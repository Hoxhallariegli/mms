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
            <th>Operatori</th>
            <th>Imaggini</th>
            <th>Numero Civico</th>
            <th>Categoria Civico</th>
            <th>Tipo di edifficio</th>
            <th>Unita residenziali</th>
            <th>Unita Business</th>
            <th>Note</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query="SELECT t1.operatori as `operatori`, t1.imazhi as `IMMAGINI`, t2.pergjigjia as `numerocivico`, t3.pergjigjia as `categoriacivico`, t4.pergjigjia as `tipodiedificio`, t5.pergjigjia as `unitaresidenziali`, t6.pergjigjia as `unitabusiness`, t7.pergjigjia as `note`
FROM `testimi` t1
LEFT JOIN `testimi` t2 ON t1.id_testimit = t2.id_testimit and t2.pyetja='Numero civico?'
LEFT JOIN `testimi` t3 ON t1.id_testimit = t3.id_testimit and t3.pyetja='Categoria civico?'
LEFT JOIN `testimi` t4 ON t1.id_testimit = t4.id_testimit and t4.pyetja='Tipo di edificio?'
LEFT JOIN `testimi` t5 ON t1.id_testimit = t5.id_testimit and t5.pyetja='Unita residenziali?'
LEFT JOIN `testimi` t6 ON t1.id_testimit = t6.id_testimit and t6.pyetja='Unita Business?'
LEFT JOIN `testimi` t7 ON t1.id_testimit = t7.id_testimit and t7.pyetja='Nota?'
WHERE DATE(t1.koha_inserimit)='$data1'
group by t1.operatori, t1.imazhi";
        $result5=$crud->getData($query);
        foreach ($result5 as $key=>$res5){
            ?>
            <tr>

            <td><?php echo $res5['operatori']; ?></td>
            <td><?php echo $res5['IMMAGINI']; ?></td>
            <td><?php echo $res5['numerocivico']; ?></td>
            <td><?php echo $res5['categoriacivico']; ?></td>
            <td><?php echo $res5['tipodiedificio']; ?></td>
            <td><?php echo $res5['unitaresidenziali']; ?></td>
            <td><?php echo $res5['unitabusiness']; ?></td>
            <td><?php echo $res5['note']; ?></td>
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
