<?php
include('includes/header1.php'); 
include_once('ini.php');
include_once("shto_function.php");

if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){

$crud = new Crud();
$validation = new Validation();


$crud = new Crud();
$employee_id = $_SESSION["Ferid"];

$level = $_SESSION['Access'];

if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}

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
    <div class="container" id="dist_nga_header">
    <h1>Administrimi</h1>
   

      <?php
    if($level=='Supervisor' || $level=='Admin' || $level=='Super_Admin'){
        ?>
               

                 <div class="one">
        <a href='pending.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-db" id="butoni_ri0">Të pa marra</button></a>
        <a href='occupato.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-db" id="butoni_ri1">Në proçes</button></a>
        <a href='finitte.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-db" id="butoni_ri2">Të përfunduara</button></a>
        <a href='modifiko_db.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-db" id="butoni_ri3">Database</button></a>
        <a href='fasciat.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-db" id="butoni_ri6">Fasciat</button></a>
        <a href='koha_punes.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-db" id="butoni_ri7">Koha e hartës</button></a>

      </div>
            
      <?php  } ?>






    <div class="container">



    </body>

</html>
        <?php
}else{

    header("location: index.php");
}
        ?>


