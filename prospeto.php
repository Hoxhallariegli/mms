<?php 

include('includes/header1.php'); 
include_once('ini.php');
include('functions.php');

if ($_SESSION["Ferid"]=='Supervisor'){

$crud = new Crud();
$validation = new Validation();
$crud = new Crud();
$validation = new Validation();

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
<style>
h4{

    color: green;
    font-size: 2.0rem;
    
}
.mertjeter{
   margin: 0;
  position: relative;

  left: 50%;

}

</style>

<div class="input-group date">

<form action="" method="POST" class="formafundit">
  <td>
     <input type="month" name="dataz" class="datedate" value="<?php echo date('Y-m'); ?>" />

     <input type="submit" name="submitdt" value="Shiko" style="margin-left: 30px;">

</td>
    </form>
</div>

<main class="container-fluid" id="dist_nga_header">

        <?php
if (isset($_POST['submitdt'])) {
    
    extract($_POST);
    $date = explode('-', $dataz);
        $y = $date[0];
        $m   = $date[1];
    $dom = cal_days_in_month(CAL_GREGORIAN, $m, $y);
     $query = "SELECT distinct(operatore) as op from hartat WHERE operatore !='' order by operatore";
     $result = $crud->getData($query);

     $operatore =array();
     foreach ($result as $key => $res) {
            
            $emri_op=$res['op'];
            $operatore[]=$emri_op;
     }
     $query_="SELECT distinct fushata from hartat";
        $result_=$crud->getData($query_);
        $fushatat=array();
        foreach ($result_ as $key => $res) {
                    
                    $emri_fushates=$res['fushata'];
                    $fushatat[]=$emri_fushates;
            }

     ?>
    <table  id="testTable" id="thetable_1">
       <thead class="header_tab">
    
         <tr>
         <th style="background-color: #c22f15;
    color: white; border: 1px solid white;">Operatore</th>
         <?php
    
     for($dit=1; $dit<=$dom; $dit++){
          $dita=$dit;
            if($dita<10){
                $data=$y."-".$m."-0".$dita;
            }else{
                $data=$y."-".$m."-".$dita;
            }

            $dt1 = strtotime($data);
            $dt2 = date("l", $dt1);
            $dt3 = strtolower($dt2);
            if($dt3 == "sunday"){
               echo "<th style='background-color: black; color: white; border: 1px solid white; text-align: center;
    '> $dit</th>";
            }else if($dt3 == "saturday"){
                echo "<th style='background-color: #7c7c7c; color: white; border: 1px solid white; text-align: center;
    '> $dit</th>";
            }else{
                echo "<th style='background-color: #c22f15;color: white; border: 1px solid white; text-align: center;
    '>$dit</th>";
            }

     
      }
      ?>
     </tr>
     </thead>
     <tr>
         <td>-</td>
     <?php 
    //$row_type=0;

     for($a=0; $a<$dom; $a++){
         echo  "<td>
         
         <table><tr>";
        for($u=0; $u<count($fushatat); $u++){
            
            $gework=checkWork($crud, $fushatat[$u], $a+1,$m,$y);
            if($gework>0){
                  $emri_ne_titull=substr($fushatat[$u],0,3);
                   echo "<td style='background-color: #b8edff; border: 1px solid black; width: 40px;'>$emri_ne_titull</td>";
               }
        }
         echo "</tr></table>";
         
    }
   echo "</tr></table></td>";
    }
                
                
    ?>
       
    </tr>
    <?php
    for($op=0; $op<count($operatore); $op++){
              ?>
               <tr>
              <td style="
    border: 1px solid black;"> <?php echo $operatore[$op]; ?></td>
         <?php 
         $lav_=array();

         
         for($dt=1; $dt<=$dom; $dt++){
         ?>
        </td></tr>
        <?php
        for($i=0; $i<count($fushatat); $i++){
                if($dt<10){
                    $query1="SELECT COUNT(`data_fine`) as total_ FROM hartat WHERE operatore='$operatore[$op]' AND fushata='$fushatat[$i]' AND `data_fine`='2021-$m-0{$dt}'"; 

                    }else{
                $query1="SELECT COUNT(`data_fine`) as total_ FROM hartat WHERE operatore='$operatore[$op]' AND fushata='$fushatat[$i]' AND `data_fine`='2021-$m-{$dt}'";
               

                    }

                    
                $result1=$crud->getData($query1);
                

                if($result1==true){
                    foreach ($result1 as $key =>$res){
                        $lav__h=$res['total_']; 
                        $lav_[]=$lav__h;
                    }
                }

                

            }       
            for($k=0; $k<$dom; $k++){
   echo "</tr></table></td>";

                
    }
        }?>
    </tr>
    }

            </table>
            <input style="width: 50% position: absoulute" type="button" onclick="tableToExcel('testTable', 'Consegne')" value="Shkarko ne excel1">
  </div>
</main>

<?php 

include('includes/footer.php');
}else{

    header("location: ../../index.php");
}
?>