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
    if (isset($_POST['shkarko'])) {
        header("Location: shkarko_perfunduara_.php?fushatat=$fushata");
    }
?>

<style>
h4{

    color: 000000;
    font-size: 1.66rem;
    
}
.mertjeter{
   margin: 0;
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
    <div  class = "col-sm-12 mt-4" align = "center">

<form action="" method="POST" class="form-group">
  <td>
     <input type="date" name="dataz" class="datedate" value="<?php echo date('Y-m-d'); ?>" />

      <button type="submit" name="submitdt" value="Shiko" style="margin-left: 30px;"><i class="fa fa-search fa-fw"></i> Search</button>

</td>
    </form>
</div>


<main class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

          <?php
         if (isset($_POST['submitdt'])) {
          extract($_POST);
        $query = "select `FOLDER`, `operatore`, civici, civici_operatore from `hartat` where `data_fine` ='$dataz' AND fushata='$fushata' group by `operatore`, Folder";
        $result = $crud->getData($query);

       $query1 = "select sum(civici) as shcv, sum(civici_operatore) as shcvop from `hartat` where `data_fine` = '$dataz' AND fushata='$fushata';";
       $result1 = $crud->getData($query1);
          ?>
        <h4 style="text-align: center; ">Punët e përfunduara të datës: <?php echo $dataz?></h4>

          
             <table  class="table mt-3" id="testTable" id="thetable">
       <thead class="thead-light" >
          <tr>
            <th>Nr.</th>
            <th>OPERATORI</th>
            <th>Finitte</th>
              <th>Civici</th>
              <th>Civici OP</th>

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
            <td><?php echo $res['operatore']; ?></td>
            <td><?php echo $res['FOLDER']; ?></td>
              <td><?php echo $res['civici']; ?></td>
              <td><?php echo $res['civici_operatore']; ?></td>
          </tr>
          <?php }
          foreach ($result1 as $key => $res) {
              $i++;
              ?>

           <tr>
               <tr>
                  <td><?php echo $i++?></td>
                  <td><?php echo "--"?></td>
                  <td><?php echo "--"?></td>
                  <td><?php echo $res['shcv']; ?></td>
                  <td><?php echo $res['shcvop']; ?></td>
              </tr>
          <?php
          }
          ?>
          <tr></tr>
        </tbody>
      </table>
        <div class="input-group  mt-6 justify-content-center">
        <button class="btn " type="button" onclick="tableToExcel('testTable', 'Consegne')" value="Shkarko ne excel1"><i class="fa fa-download"></i> Download </button>
        </div>
     <?php }else{
       $query = "select `FOLDER`, `operatore`,`civici`, `civici_operatore` from `hartat` where `data_fine` =CURDATE() AND fushata='$fushata' group by `operatore`, Folder";
        $result = $crud->getData($query);

             $query1 = "select sum(civici) as shcv, sum(civici_operatore) as shcvop from `hartat` where `data_fine` = CURDATE() AND fushata='$fushata';";
             $result1 = $crud->getData($query1);
        ?>
             <h4 style="text-align: center; ">Punët e përfunduara të ditës së sotme</h4>

          <table class="table mt-3" id="testtable" id="thetable">
      <body onload="alternate('thetable')">
        <thead class="thead-light" >
          <tr>
            <th>Nr.</th>
            <th>OPERATORI</th>
            <th>Punet e perfunduara</th>
              <th>Civici</th>
              <th>Civici OP</th>
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
            <td><?php echo $res['operatore']; ?></td>
            <td><?php echo $res['FOLDER']; ?></td>
              <td><?php echo $res['civici']; ?></td>
              <td><?php echo $res['civici_operatore']; ?></td>
          </tr>
          <?php }
          foreach ($result1 as $key => $res) {
              $i++;
              ?>

              <tr>

                  <td><?php echo $i++?></td>
                  <td><?php echo "--"?></td>
                  <td><?php echo "--"?></td>
                  <td><?php echo $res['shcv']; ?></td>
                  <td><?php echo $res['shcvop']; ?></td>
              </tr>
              <?php
          }
          ?>
          <tr></tr>
        </tbody>
          </table>
        <div class="input-group  mt-6 justify-content-center">
            <button class="btn" type="button" onclick="tableToExcel('testtable', 'Consegne')" value="Shkarko ne excel2"><i class="fa fa-download"></i> Download </button>
        </div>
          
    <?php } ?>

      </div>
   
    <div class="col-md-8 mt-2">
    

          <?php
        if (isset($_POST['submitdt'])) {
          extract($_POST);
          ?>
          <h4 style="text-align: center; ">Punët e përfunduara të fushates : <?php echo $fushata?></h4>
    <div >
    </div>

        <table class="table" id="testtable" id="thetable">
      <body onload="alternate('thetable')">
        <thead class="thead-light">
          <tr>
            <th>OPERATORI</th>
            <th >Punët e përfunduara</th>
            <th>Lista e FOLDER</th>
              <th>Shuma e civici</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = "select GROUP_CONCAT(FOLDER SEPARATOR ' , ') as TePerfunduara, IFNULL(operatore, 'mbyllur nga adm') as operatore, count(`folder`) as Total,sum(civici_operatore) as shuma_operatorit from `hartat` where `data_fine` ='$dataz' AND fushata='$fushata' group by `operatore`";
        $result = $crud->getData($query);

          foreach ($result as $key => $res) { 
          ?>
          <tr>
            <td><?php echo $res['operatore']; ?></td>
            <td><?php echo $res['Total']; ?></td>
            <td><?php echo $res['TePerfunduara']; ?></td>
            <td><?php echo $res['shuma_operatorit']; ?></td>
          </tr>
           <?php
          } 
        
          $query2 = "select count(`folder`) as Total2, GROUP_CONCAT(FOLDER SEPARATOR ', ') as hartat, sum(civici_operatore) as shuma_totale from `hartat`  where `data_fine`='$dataz'  AND fushata='$fushata'";
        $result2 = $crud->getData($query2);
          foreach ($result2 as $key => $res) { 
          ?>
          <tr>
            <td>Totali</td>
          <td><?php echo $res['Total2']; ?></td>
          <td><?php echo $res['hartat']; ?></td>
              <td><?php echo $res['shuma_totale']; ?></td>
          </tr>
          
          <?php


      }

          ?>

          </table>
              <div class="excel">
                  <form method='post' action=''>
                      <div class="input-group  mt-6 justify-content-center">
                          <button class="btn" type="submit" name="shkarko" class="mybutton1s" class="btn btn-outline-success btn-block" value='Shkarko'><i class="fa fa-download"></i> Download </button>
                      </div>

                  </form>
              </div>
         
          <?php


      }else{
         $query = "select GROUP_CONCAT(FOLDER SEPARATOR ' , ') as TePerfunduara, IFNULL(operatore, 'mbyllur nga adm') as operatore, count(`FOLDER`) as Total, SUM(civici_operatore) as shuma_totale
from `hartat` where `data_fine` = CURDATE() AND fushata='$fushata' group by `operatore`";
         
        $result = $crud->getData($query);
        ?>
          <h4 style="text-align: center; ">Punët e përfunduara të fushates <?php echo $fushata?></h4>
    <div class="data_zgjidh">
    </div>

      <table class="table " id="testtable" id="thetable">
      
        <thead class="thead-light" >
          <tr>
            <th>OPERATORI</th>
            <th>Punët e përfunduara</th>
            <th>Lista e FOLDER</th>
              <th>Shuma totale</th>
          </tr>
        </thead>
        <body onload="alternate('thetable')">
        <tbody>
          
          <?php

          foreach ($result as $key => $res) { 
          ?>
          <tr>
            <td><?php echo $res['operatore']; ?></td>
            <td><?php echo $res['Total']; ?></td>
            <td><?php echo $res['TePerfunduara']; ?></td>
              <td><?php echo $res['shuma_totale']; ?></td>
          </tr>
          <?php 
        }
           $query2 = "select count(`FOLDER`) as Total2,  GROUP_CONCAT(FOLDER SEPARATOR ' , ') as hartat, SUM(civici_operatore) as sh_op from `hartat` where `data_fine` =CURDATE()
AND fushata='$fushata'";
        $result2 = $crud->getData($query2);

          foreach ($result2 as $key => $res) { 
          ?>
          <div class="shumatorja">
          <tr>
            <td>Totali</td>
          <td><?php echo $res['Total2']; ?></td>
          <td><?php echo $res['hartat']; ?></td>
           <td><?php echo $res['sh_op']; ?></td>
          </tr>
            </tbody>
      </table>
        <div class="excel">
            <form method='post' action=''>

                <div class="input-group  mt-6 justify-content-center">
                    <button class="btn" type="submit" name="shkarko" class="mybutton1s" class="btn btn-outline-success btn-block" value='Shkarko'><i class="fa fa-download"></i> Download </button>
        </div>

        </form>
        </div>
        <br>
        <h4 style="text-align: center; ">Pune te bera nga operatori ne harta te paperfunduara</h4>
        <table class="table " id="testtable" id="thetable">
            <thead class="thead-light">
            <tr>
                <th>OPERATORI</th>
                <th>Punët e përfunduara</th>
                <th>Lista e FOLDER</th>
                <th>Shuma totale</th>

            </tr>
            </thead>
            <tbody>
            <?php

            $query="SELECT operatore,count(folder) as sht, CONCAT(folder) as folt,sum(civici_operatore) as ngaOp from hartat where (data_inizio!='' or data_inizio is not null) and (data_fine is null or data_fine='') AND fushata='$fushata'GROUP BY operatore";
            $result = $crud->getData($query);
            foreach ($result as $key => $res) {
                ?>
                <tr>

                    <td><?php echo $res['operatore']; ?></td>
                    <td><?php echo $res['sht']; ?></td>
                    <td><?php echo $res['folt']; ?></td>
                    <td><?php echo $res['ngaOp']; ?></td>
                </tr>
            <?php }


            $query="SELECT count(folder) as sht, CONCAT(folder) as folt,sum(civici_operatore) as ngaOp from hartat where (data_inizio!='' or data_inizio is not null) and (data_fine is null or data_fine='') AND fushata='$fushata'";
            $result = $crud->getData($query);
            foreach ($result as $key => $res) {
                ?>
                <tr>

                    <td>Totali</td>
                    <td><?php echo $res['sht']; ?></td>
                    <td><?php echo $res['folt']; ?></td>
                    <td><?php echo $res['ngaOp']; ?></td>
                </tr>
            <?php }

            ?>
            </tbody>
        </table>
          </div>
          <?php
      }
     } ?>
    </div>

  </div>

</main>

<?php include('includes/footer.php');
} else {

    header("location: ../../index.php");
}
?>