<?php
//including the database connection file

include_once('ini.php');
include('includes/header1.php'); 
include_once("shto_function.php");

if ($_SESSION["Ferid"]){
$crud = new Crud();
$validation = new Validation();
    $employee_id = $_SESSION['Ferid'];
    $level = $_SESSION['Access'];
$crud = new Crud();
    ?>
<style>
      h1{
        color: black;
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
            if($level=='Supervisor' || $level=='Admin' || $level=='Super_Admin'){?>
                      <a href='fushatat_aktive.php'  class="btn btn-danger" id="butoni_ri5"> Punet aktive</a>
                       <a href='provincat_arkiva.php'  class="btn btn-danger" id="butoni_ri6"> Pune te mbyllura</a>
<?php        }else{ 
                  echo $level;
                  ?> 
                "No access";
            <?php 
            }
          }
?>
</div></div>
    </body>
</html>
<?php
?>

