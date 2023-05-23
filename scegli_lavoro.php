<?php 
include('includes/header1.php'); 
include_once('ini.php');
include_once("shto_function.php");

if ($_SESSION["Ferid"]){
$crud = new Crud();
$validation = new Validation();

$employee_id = $_SESSION["Ferid"];
$level = $_SESSION['Access'];

if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}

if (isset($_POST['prendi'])) {
    extract($_POST);

    updateLavoro($crud, $folder, $employee_id,$fushata);
    prenderelogs($crud,$folder,$employee_id,'mer harten');
    //matKohen($crud,$folder,$fushata, $employee_id);

}

if(isset($_POST['mer_false'])) {
    echo "Ideja eshte qe duhet mare e para o ".$employee_id." jo kjo qe zgjodhe ti";
}

if (isset($_POST['hiqe'])) {
    extract($_POST);
    hiqHartenNgaOperatori($crud, $folder,$employee_id,$fushata);
    prenderelogs($crud,$folder,$employee_id,'heq harten');

}

  $statusi_op=perllogaritHartaAktive($crud,$employee_id,$fushata);
?>

<main class="container" >
  <div class="row">
      <!-- MESSAGES -->
      
<?php
if($statusi_op>0){
     header("Location: finisci_lavoro.php?fushatat=$fushata");
      }else{
        ?>
        </tbody>
      </table>
      </div>
    
    <?php

        $fascia_=gjejFascia($crud,$fushata);

        $query2 = "SELECT `folder`, `Fascia` from `hartat` WHERE `priority`='SI' and (`data_inizio`='0000-00-00' or `data_inizio` is null) AND (`operatore` ='' or `operatore` is null)  and `fushata`='$fushata' UNION ALL SELECT `folder`, `Fascia` from `hartat` WHERE `Fascia`='$fascia_' and (`data_inizio`='0000-00-00' or `data_inizio` is null) AND (`operatore` ='' or operatore is null) AND `fushata`='$fushata'
";
        $result2 = $crud->getData($query2);

       ?>

            <table class="table table-striped text-center mt-3 my-3">
                <h4 class="table table-striped text-center mt-3 my-3">
                    Rrugët në pritje për tu punuar
                </h4>
        <thead >
          <tr>
              <th>Nr</th>
            <th>Rruga</th>
            <th>Fasha</th>
            <th>Merr</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
          foreach ($result2 as $key => $res) { 
          ?>
          <tr>
              <td><?php echo $i; ?></td>
            <td><?php echo $res['folder']; ?></td>
             <td><?php echo $res['Fascia']; ?></td>

            <td>

            <form class="form-group" method='post' action=''>
              <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
                    <button name='prendi' class="btn btn-primary btn-sm">Merr</button>
                    </form>


            </td>

          </tr>
          <?php
          $i++;
        } 
      }
        ?>
        </tbody>
      </table>
      

<?php include('includes/footer.php');
} else {

    header("location: ../../index.php");
}
?>
