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
               $query = "SELECT DISTINCT fushatat.provinca as provinca FROM fushatat";
                $result = $crud->getData($query);
                $w=0;
                 foreach ($result as $key => $res) { 
                      $provinca=$res['provinca'];
                      if($w<14){
                          ?>
                      <a href='fushatat_arkiva.php?provinca=<?php echo $provinca?>'  class="btn btn-danger" id="butoni_ri<?php echo $w?>"> <?php echo $provinca?></a>
             <?php $w++;}
             else{
               $o=$w-14;
               ?>
                      <a href='fushatat_arkiva.php?provinca=<?php echo $provinca?>'  class="btn btn-danger" id="butoni_ri<?php echo $o?>"> <?php echo $provinca?></a>
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

