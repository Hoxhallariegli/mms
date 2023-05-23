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

                <select  name="nr_javes">
                    <?php
                    for ($i=1; $i<=54; $i++){
                        $resultt=dita_par_e_fundit($i-1, 2023);
                        ?>
                        <option class="form-control" value="<?php echo $i;?>"><?php echo "Java".$i." ".$resultt[0]."-".$resultt[1];?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <?php

            $query = "SELECT DISTINCT `Communa` as Communa FROM hartat";
            $result1 = $crud->getData($query);

            echo "<select name='communa' type='list' class='form-contol'><option value=''>Scegli Communa</option>";
            foreach ($result1 as $key => $res){

                echo "<option value='$res[Communa]'>$res[Communa]</option>";
            }
            echo "<option value='tegjithe'>Tutti</option>";
            echo "</select>";
            ?>


            <button type="submit" name="kerko"   ><i class="fa fa-search fa-fw"></i> Cerca</button>
        </form>
    </div>
    <?php
    if(isset($_POST['kerko'])) {
    extract($_POST);
    $week=$nr_javes-1;
    function Start_End_Date_of_a_week($week, $year){
        $time = strtotime("1 January $year", time());
        $day = date('w', $time);
        $time += ((7 * $week) + 1 - $day) * 24 * 3600;
        $dates[0] = date('Y-n-j', $time);
        $time += 6 * 24 * 3600;
        $dates[1] = date('Y-n-j', $time);
        return $dates;
    }

    $year = date("Y");
    $result = Start_End_Date_of_a_week($week, $year);
    $data1=$result[0];
    $data2=$result[1];
    ?>
    <h2 style="text-align: center; ">Lavori finite dal <?php echo $data1?> al <?php echo $data2?> per <span class="fw-bold"> <?php if($communa=='tegjithe'){echo "Tutti";}else{ echo $communa;}?></span></h2>


    <table class="table" id="testtable" id="thetable" style="border: 0.1px solid">
        <body onload="alternate('thetable')">
        <thead class="thead-light">
        <tr>
            <th>Nr.</th>
            <th>OPERATORI</th>
            <th>OreTechnice</th>
            <th>OreLavorative</th>
            <th style="background-color: #ffebcd">Commune</th>
            <th style="background-color: #ffebcd">CiviciTeorici</th>
            <th>CiviciLavorati</th>
            <th style="background-color: #87cefa">CiviciConsegnati</th>
            <th>CiviciResidui</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        if($communa=='tegjithe') {
            $query = "SELECT hartat.operatore,'' as OreTechnice, SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))) as Ore_Lavorative,GROUP_CONCAT(distinct Communa SEPARATOR ', ') as Commune, sum(civici) as CiviciTeorici, sum(civici_operatore) as CiviciLavorati, (sum(civici)-sum(civici_operatore)) as Civici_Residui
FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where hartat.data_inizio >='$data1' and hartat.data_fine<='$data2' and koha_punes.veprimi_permbylles='perfunduar' group by Communa, operatore
UNION ALL
select 'Totale','' as OreTechnice,SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))),'',sum(civici),sum(civici_operatore),(sum(civici)-sum(civici_operatore)) FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where hartat.data_inizio >='$data1' and hartat.data_fine<='$data2' and koha_punes.veprimi_permbylles='perfunduar'";
        }else{
            $query = "SELECT hartat.operatore,'' as OreTechnice, SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))) as Ore_Lavorative,GROUP_CONCAT(distinct Communa SEPARATOR ', ') as Commune, sum(civici) as CiviciTeorici, sum(civici_operatore) as CiviciLavorati, (sum(civici)-sum(civici_operatore)) as Civici_Residui
FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where hartat.data_inizio >='$data1' and hartat.data_fine<='$data2' and koha_punes.veprimi_permbylles='perfunduar' and hartat.Communa='$communa' group by operatore
UNION ALL
select 'Totale','' as OreTechnice,SEC_TO_TIME( SUM(time_to_sec(koha_punes.koha))),'',sum(civici),sum(civici_operatore),(sum(civici)-sum(civici_operatore)) FROM `koha_punes` 
inner join hartat on koha_punes.folder=hartat.folder and hartat.fushata=koha_punes.fushata where hartat.data_inizio >='$data1' and hartat.data_fine<='$data2' and koha_punes.veprimi_permbylles='perfunduar' and hartat.Communa='$communa'";
        }
        $result5=$crud->getData($query);
        foreach ($result5 as $key=>$res5){
            ?>
            <td><?php echo $i?>
            <td><?php echo $res5['operatore']; ?></td>
            <td><?php echo $res5['OreTechnice']; ?></td>
            <td><?php echo $res5['Ore_Lavorative']; ?></td>
            <td style="background-color: #ffebcd"><?php echo $res5['Commune']; ?></td>
            <td style="background-color: #ffebcd"><?php echo $res5['CiviciTeorici']; ?></td>
            <td><?php echo $res5['CiviciLavorati']; ?></td>
            <td style="background-color: #87cefa"><?php echo " "?></td>
            <td><?php echo $res5['Civici_Residui']; ?></td>
            </tr><?php
            $i++;
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
