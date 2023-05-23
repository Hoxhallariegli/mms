<?php
include('includes/header1.php'); 
include_once('ini.php');
include_once('shto_function.php');

if ($_SESSION["Ferid"]){

if(isset($_GET['fushatat'])){

  $fushata= $_GET['fushatat'];

}

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
        margin-top: 20px;
      }
      </style>
<main class="container">
   <div class="one">
        <?php
          $statusi_op=perllogaritHartaAktive($crud,$employee_id,$fushata);      
            if($level=='User'){       
                          if($statusi_op<1){
                          ?> 
                          <a href='scegli_lavoro.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-outline-secondary btn-lg">Zgjidh punën</button></a>
                          <a href='finisci_lavoro.php?fushatat=<?php echo $fushata?>'><button type="button" class="btn btn-outline-success btn-lg">Përfundo punën</button></a>
                          <?php
                        } else{
                               header("location: finisci_lavoro.php?fushatat=$fushata");
                        }
                            }else{ ?>   
                "No access";
            <?php 
            }
?>
</div>
    </div>
    </body>
</html>
<?php
}else{

    header("location: index.php");
}
?>