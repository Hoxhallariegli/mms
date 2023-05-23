<?php 
include('includes/header1.php'); 
include_once('ini.php');
include_once("shto_function.php");


if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
$crud = new Crud();
$validation = new Validation();



$crud = new Crud();
$validation = new Validation();

$employee_id = $_SESSION["Ferid"];
$level = $_SESSION['Access'];

if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}


if (isset($_POST['prioriteti'])) {
    extract($_POST);
    jepPrioritet($crud,$folder,$fushata);
}


?>


<style>
h4{
  text-align: center;
    color: black;
    font-size: 2.0rem;
    
}
h6{
  text-align: center;
    color: #3d973d;
    font-size: 1.5rem;
    
}

.mertjeter{
   margin: 0;
  position: relative;

  left: 50%;
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>


<main class="container p-6" >
  <div class="row">
    <div class="col-md-4">
      <div class="card card-body mt-3">
    <h6>Kërko hartën per ti dhënë prioritet</h6>
    <div class="formkerkimi">
      <form action="" method="POST">
<br>
                  <input type="text" name="kodi" class="form-control" placeholder="shkruani kodin" required ">

                <input type="submit" name="kerko" class="btn btn-outline-success btn-block mt-3" value="Kërko">
      </form>
    </div>
                <?php
              
            if (isset($_POST['kerko'])) {
          extract($_POST);
          ?>

            <h4 class="mt-3">Jep prioritet</h4>
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th>FOLDER</th>
                  <th>Prioriteti</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $kodi=$crud->escape_string($kodi);
              $query = "SELECT`folder` FROM hartat WHERE (`data_inizio`='0000-00-00' OR `data_inizio` is null) AND (`data_fine`='0000-00-00' or `data_fine` is null) AND FOLDER like '%$kodi%' AND `fushata`='$fushata'";
              $result = $crud->getData($query);

                foreach ($result as $key => $res) { 
                ?>
                <tr>
                  <td><?php echo $res['folder']; ?></td>
                  <td>
                  <form method='post' action=''>
                    <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
                          <button name='prioriteti' class="btn btn-primary btn-sm"> Jep prioritet</button>
                  </form>       
                  </td>
                </tr>
                <?php } ?>

              </tbody>
            </table>
                  

        
          <?php
          }
          ?>
      </div>
    </div>
    <div class="col-md-8 mt-3">
    <h4>Lista e rrugeve të pa marra te fashes aktuale</h4>
      <table class="table mt-3">
              <thead class="thead-light">
                <tr>
                  <th>Rruga</th>
                  <th>Fasha</th>
                    <th>Civici</th>
                </tr>
              </thead>
              <tbody>

                <?php

        
              $fascia_=gjejFascia($crud,$fushata);
             
              $query = "SELECT `folder`, `operatore`, `Fascia`,`civici`  FROM hartat WHERE  (`data_inizio`='0000-00-00' OR `data_inizio` is null) AND (`data_fine`='0000-00-00' or `data_fine` is null) AND `priority`='SI' and fushata='$fushata' UNION ALL SELECT `folder`, `operatore`, `Fascia`, `civici`  FROM hartat WHERE (`data_inizio`='0000-00-00' OR `data_inizio` is null) AND (`data_fine`='0000-00-00' or `data_fine` is null) AND `Fascia`='$fascia_' AND `fushata`='$fushata'";
              $result = $crud->getData($query);

                foreach ($result as $key => $res) { 
                ?>
                <tr>
                  <td><?php echo $res['folder']; ?></td>
                  <td><?php echo $res['Fascia']; ?></td>
                    <td><?php echo $res['civici']; ?></td>
                </tr>
                <?php }
                $query1 = "SELECT count(`folder`) as tot, sum(`civici`) as shc  FROM hartat WHERE (`data_inizio`='0000-00-00' OR `data_inizio` is null) AND (`data_fine`='0000-00-00' or `data_fine` is null) AND `Fascia`='$fascia_' AND `fushata`='$fushata'";
                $result1 = $crud->getData($query1);
                foreach ($result1 as $key =>$res1){
                ?>
                     <tr>
                  <td><?php echo $res1['tot']; ?></td>
                <td><?php echo "--" ?></td>
                <td><?php echo $res1['shc']; ?></td>
                </tr><?php
                }
                ?>
              </tbody>
            </table>
    </div>
  </div>
</div>
<?php include('includes/footer.php');
} else {
    header("location: index.php");
}
?>


