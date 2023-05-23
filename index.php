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


        
          
            if($level=='Supervisor' || $level=='Admin' || $level=='Super_Admin'){?>
              
                      <a href='fushatat.php'  class="btn btn-danger" id="butoni_ri5"> Komunat</a>
                       <a href='amministrazione.php'  class="btn btn-danger" id="butoni_ri6"> Administrimi</a>

<?php        }else if($level=='User'){  ?>
              <?php
                $query = "SELECT hartat.fushata as fushata, count(CASE WHEN(data_inizio ='' or data_inizio ='0000-00-00' or data_inizio IS NULL) THEN 1 END) as pa_mara, fushatat.fushata as emri, count(CASE WHEN(data_inizio !='' AND data_inizio IS NOT NULL AND data_inizio !='0000-00-00') AND (data_Fine ='' or data_Fine IS NULL or data_Fine ='0000-00-00') AND (operatore='$employee_id') THEN 1 END) AS test from hartat inner join fushatat on fushatat.fushata_id=hartat.fushata 
where (fushatat.statusi is null or fushatat.statusi='attivo')
group by hartat.fushata
having ( count(CASE WHEN(data_inizio !='' AND data_inizio IS NOT NULL AND data_inizio !='0000-00-00') AND (data_Fine ='' or data_Fine IS NULL or data_Fine ='0000-00-00') AND (operatore='$employee_id') THEN 1 END) > 0 OR count(CASE WHEN(data_inizio ='' or data_inizio ='0000-00-00' or data_inizio IS NULL) THEN 1 END) > 0 )

";
        $result = $crud->getData($query);
        $k=0;
              foreach ($result as $key => $res) { 
                $fushata=$res['fushata'];
                $emri=$res['emri']
                      ?>
                      <a href='user.php?fushatat=<?php echo $fushata?>'  class="btn btn-db" id="butoni_ri<?php echo $k?>">  <?php echo $emri?></a>
    
             <?php $k++;
             ?>

             <?php
              }
              ?>
                <a href='ex.php'  class="btn btn-db" id="butoni_ri<?php echo $k?>"> Testimi</a>
                <?php }else{ 
                  echo $level;
                  ?> 
                    
                "No access";
            <?php 
            }
          }
?>
</div></div>
<?php
    include('includes/footer.php'); 
?>

    
</html>

<?php



?>

