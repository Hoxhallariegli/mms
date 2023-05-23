<?php 

include('includes/header1.php'); 
include_once('ini.php');
include_once("shto_function.php");

if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
$crud = new Crud();
$validation = new Validation();
$crud = new Crud();
$validation = new Validation();

$query = "SELECT DISTINCT `operatore` FROM hartat WHERE `operatore`!=''";
$result1 = $crud->getData($query);

if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}

if (isset($_POST['ndrysho'])) {
    extract($_POST);
    ndryshoFasciat1($crud, $fushata, $Fascia, $fascia_re);
}


?>

    <div class="col-md-12">
  <div class="row mt-3">
      <h4 style="text-align: center ; ">Fasciat e <?php echo $fushata?></h4>
      <table class="table" >
      <body onload="alternate('thetable')">
        <thead class="thead-light">
          <tr>
            <th>Nr.</th>
            <th>Fushata</th>
            <th>Folderat</th>
            <th>Te lira</th>
            <th>Fascia</th>
            <th>Fascia_re</th>
            <th>Ndrysho</th>
          </tr>
        </thead>
        <tbody>

<?php           
        $query="select fushata, GROUP_CONCAT(folder SEPARATOR', ') as hartat, Fascia, count(CASE WHEN(data_inizio ='' or data_inizio IS NULL or data_inizio ='0000-00-00') THEN 1 END) as pa_mara from hartat WHERE fushata='$fushata' group by Fascia";
        $result = $crud->getData($query);
        $i=0;
          foreach ($result as $key => $res) { 
          $i++;
          ?>
          <tr>
              <td><?php echo $i?></td>
            <td><?php echo $res['fushata']; ?></td>
            <td><?php echo $res['hartat']; ?></td>
            <td><?php echo $res['pa_mara']; ?></td>
            <td><?php echo $res['Fascia']; ?></td>         
            </td>
           
            <form class="form-group" method='post' action=''>
          <td><input type="text" name="fascia_re" class="form-control" placeholder="Vendosni kodin" required ></td>
              <input type="hidden" name="fushata" value="<?php echo $res['fushata']; ?>">
              <input type="hidden" name="Fascia" value="<?php echo $res['Fascia']; ?>">
           <td> <button name='ndrysho' class="btn btn-warning">Ndysho</button> </td>
            </form>
          
          </tr>
          <?php 
        } ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php include('includes/footer.php');

}else {

    header("location: ../../index.php");
}
?>
