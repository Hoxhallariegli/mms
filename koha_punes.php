<?php

include('includes/header1.php');
include_once('ini.php');
include_once("functions.php");

if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){

$crud = new Crud();
$validation = new Validation();
$crud = new Crud();
$validation = new Validation();
if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}

    $employee_id = $_SESSION['Ferid'];

    $level = $_SESSION['Access'];

?>


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
<div  class = "col-sm-12 mt-4" align = "center">

<form action="" method="POST" class="form-group">
  <td>
     <input type="date"  name="dataz" class="datedate1" value="<?php echo date('Y-m-d'); ?>" />

     <button type="submit"  name="submitdt" value="Shiko" "/><i class="fa fa-search fa-fw"></i> Search</button>

</td>
    </form>
</div>


<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-8 align-content-center">
          <?php
         if (isset($_POST['submitdt'])) {
          extract($_POST);
        $query = "select * from hartat inner join (select * from (
select folder, operatori, GROUP_CONCAT(veprimi_permbylles) as statusi, SEC_TO_TIME( SUM(time_to_sec(`koha_punes`.`koha`))) As Total_Lavorato, mbarimi from koha_punes  where fushata='$fushata'
group by folder ) as Q1 where statusi like '%perfunduar%') as Q11 on hartat.folder=Q11.folder WHERE data_fine='$dataz'";
        $result = $crud->getData($query);
          ?>
           <h4 style="text-align: center; ">Punët e përfunduara të datës: <?php echo $dataz ?> </h4>
             <table class="table mt-3 " id="testTable" id="thetable">
       <thead >
          <tr>
            <th>Nr.</th>
            <th>OPERATORI</th>
              <th>FOLDER</th>
            <th>Koha</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          foreach ($result as $key => $res) {
            $i++;
          ?>
          <tr>
          <td><?php echo $i?></td>
            <td><?php echo $res['operatori']; ?></td>
            <td><?php echo $res['folder']; ?></td>
              <td><?php echo $res['Total_Lavorato']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
             <div class="input-group  mt-6 justify-content-center">
                 <button class="btn" type="button" onclick="tableToExcel('testTable', 'Consegne')" ><i class="fa fa-download"></i> Download sipas dates</button>
             </div>

     <?php }else{
             $query = "select * from hartat inner join (select * from (
select folder, operatori, GROUP_CONCAT(veprimi_permbylles) as statusi, SEC_TO_TIME( SUM(time_to_sec(`koha_punes`.`koha`))) As Total_Lavorato, mbarimi from koha_punes where fushata='$fushata' 
group by folder ) as Q1 where statusi like '%perfunduar%') as Q11 on hartat.folder=Q11.folder WHERE data_fine=CURDATE()";
        $result = $crud->getData($query);
        ?>
           <h4 style="text-align: center; ">Punët e përfunduara të ditës së sotme</h4>
             <table class="table mt-3 " id="testtable" id="thetable">
      <body onload="alternate('thetable')">
        <thead class="header_tab">
          <tr>
              <th>Nr.</th>
              <th>OPERATORI</th>
              <th>FOLDER</th>
              <th>Koha</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          foreach ($result as $key => $res) {
            $i++;
          ?>
          <tr>
          <td><?php echo $i?></td>
              <td><?php echo $res['operatori']; ?></td>
              <td><?php echo $res['folder']; ?></td>
              <td><?php echo $res['Total_Lavorato']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </body>
      </table>
                <div class="input-group  mt-6 justify-content-center">
                <button class="btn" onclick="tableToExcel('testtable', 'Consegne')" ><i class="fa fa-download"></i> Download </button>
                </div>
    <?php } ?>

      </div>



    </div>
    </div>
</main>

<?php include('includes/footer.php');
} else {

    header("location: ../../index.php");
}
?>
