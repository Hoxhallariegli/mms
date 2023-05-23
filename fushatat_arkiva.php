<?php
//including the database connection file

include_once('ini.php');
include('includes/header1.php'); 
include_once("shto_function.php");

if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
$crud = new Crud();
$validation = new Validation();
    $employee_id = $_SESSION['Ferid'];
    $level = $_SESSION['Access'];
    if(isset($_GET['provinca'])){
  $provinca= $_GET['provinca'];
}
$crud = new Crud();
    ?>
<style>
      h1{
        color: green;
        text-align: center;
      }
      div.one{
        margin-top: 40px;
        text-align: center;
      }
      button{
        margin-top: 10px;
      }
      </style>
<main class="container" id="dist_nga_header">
   <div class="one">
        <?php
        //  $statusi_op=perllogaritHartaAktive($crud,$employee_id);
            if($level=='Supervisor' || $level=='Admin' || $level=='Super_Admin'){
               $query = "SELECT DISTINCT hartat.fushata as fushatat, fushatat.fushata as emri from hartat inner join fushatat on hartat.fushata=fushatat.fushata_id WHERE (fushatat.statusi ='inattivo' or fushatat.statusi is null) AND provinca='$provinca'";
                $result = $crud->getData($query);
                $w=0;
                 foreach ($result as $key => $res) { 
                      $fushata=$res['fushatat'];
                      $emri=$res['emri'];
                      if($w<14){
                          ?>
                      <a href='gestione.php?fushatat=<?php echo $fushata?>'  class="btn btn-danger" id="butoni_ri<?php echo $w?>"> <?php echo $emri?></a>
             <?php $w++;}
             else{
               $o=$w-14;
               ?>
                      <a href='gestione.php?fushatat=<?php echo $fushata?>'  class="btn btn-danger" id="butoni_ri<?php echo $o?>"> <?php echo $emri?></a>
             <?php $w++;
             }
                      }
                       ?>
                            <?php }else{ 
                  echo $level;
                  ?>   
                "No access";
            <?php 
            }}
?>
</div></div>
    </body>
</html>
<?php
?>

