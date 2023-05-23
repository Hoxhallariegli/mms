<?php 

include('includes/header1.php'); 
include_once('ini.php');
include_once("shto_function.php");

if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
$crud = new Crud();
$validation = new Validation();

    $employee_id = $_SESSION['Ferid'];

    $level = $_SESSION['Access'];

$crud = new Crud();
$validation = new Validation();

$query = "SELECT DISTINCT `operatore` FROM hartat WHERE `operatore`!=''";
$result1 = $crud->getData($query);

if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}

if (isset($_POST['dorezo'])) {
    extract($_POST);
    shtoHartat($crud, $folder, $fushata);
}
if (isset($_POST['kthe'])) {
    extract($_POST);
    $st_h=statusiHartes($crud,$folder,$employee_id,$fushata);
    hiqHartenNgaOperatori($crud,$folder,$operatori_hartes,$fushata,$st_h);

}

?>
<main class=".container-sm">

      

      <table class="table table-sm" >
      <body onload="alternate('thetable')">
        <thead class="thead-light">
        <h4 class="text-center my-4 mt-3">Hartat e mara nga operatorët</h4>
            <th>Nr.</th>
            <th>FOLDER</th>
            <th>OPERATORI</th>
            <th>Data e fillimit</th>
            <th>Data e përfundimit</th>
            <th>Status</th>
            <th>Fasha</th>
              <th>Civici</th>
              <th>Koha</th>
              <th>Punuar</th>
            <th>Perfundo</th>
            <th>Kthe</th>
          </tr>
        </thead>
        <div>

          <?php

           $query ="select `folder`, `operatore`, `Fascia`,`data_inizio`,`data_fine`, `civici`,`koment`,  Total_Lavorato, gko from (SELECT `folder`, `operatore`, `Fascia`,`data_inizio`,`data_fine`,`civici`,`koment`   FROM hartat WHERE fushata='$fushata' AND (`data_inizio`!='0000-00-00' and `data_inizio` is not null) AND (`data_fine`='0000-00-00' or `data_fine` is null)) as firstview
left join
(select folder AS folder1, SEC_TO_TIME( SUM(time_to_sec(TIMEDIFF(IFNULL(`mbarimi`,CURRENT_TIMESTAMP),`fillimi`)))) As Total_Lavorato, GROUP_CONCAT(DISTINCT operatori) as gko from koha_punes WHERE fushata='$fushata' group by folder1) as qk
on  firstview.folder=qk.folder1 ORDER BY koment DESC,operatore";
        $result = $crud->getData($query);
        $i=0;
          foreach ($result as $key => $res) { 
          $i++;
          $op_hartes=$res['operatore'];
          ?>
              <div class="occupato">
            <td><?php echo $i?></td>
            <td><?php echo $res['folder']; ?></td>
            <td><?php echo $op_hartes; ?></td>
            <td><?php echo $res['data_inizio']; ?></td>
            <td><?php echo $res['data_fine']; ?></td>
                  <?php

                  if ($res['koment']=== "neproces") {
                      echo "<td  style='color: darkgreen'  ><i class='fa fa-play-circle' style='font-size:20px;color:darkgreen'></i>";
                      echo $res['koment'];
                      echo "</td>";
                      echo "";

                  } elseif ($res['koment']=== "nderprere"){
                      echo "<td style='color: darkred'><i class='fa fa-stop-circle' style='font-size:20px;color:darkred'></i>";
                      echo $res['koment'];
                      echo "</td>";
                  }
                  ?>
            <td><?php echo $res['Fascia']; ?></td>
                  <td><?php echo $res['civici']; ?></td>

              <td><?php echo $res['Total_Lavorato']; ?></td>
              <td><?php echo $res['gko'];?></td>
                        <td>
            <form method='post' action=''>
              <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
              <input type="hidden" name="operatori_hartes" value="<?php echo $res['operatore']; ?>">
                    <button name='dorezo' class="btn btn-primary" onclick="return confirm('A jeni i/e sigurte?')" >Përfundo</button>
            </form>       
            </td>
            <td>
            <form method='post' action=''>
              <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
              <input type="hidden" name="operatori_hartes" value="<?php echo $res['operatore']; ?>">
                    <button name='kthe' class="btn btn-warning" onclick="return confirm('Are you sure you want to Kthe?')">Kthe</button>
                    </form>
            </td>
          </tr>
          <?php } ?>
        </div>
        </tbody>
      </table>

    </div>
  </div>

</main>

<?php include('includes/footer.php');


} else {
    header("location: index.php");
}
?>
