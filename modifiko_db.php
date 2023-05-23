<?php 
include('includes/header1.php'); 
include_once('ini.php');
include_once("shto_function.php");


if ($_SESSION["Ferid"] && ($_SESSION['Access']=='Supervisor' ||  $_SESSION['Access']=='Super_Admin')){
    $crud = new Crud();
    $validation = new Validation();
    $employee_id = $_SESSION['Ferid'];
    $level = $_SESSION['Access'];
    $query = "SELECT DISTINCT `operatore` as operatore FROM hartat";
    $result1 = $crud->getData($query);

    if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}
if (isset($_POST['shkarko'])) {
    header("Location: shkarko_material.php?fushatat=$fushata");
}
?>
<html>
<head>    
<style>
.excel{
   align-content: center;
    margin: 93px;
    bottom: 75%;
    position: relative;
    left: 50%;

}
</style>
    <title>Modifiko db</title>
    <link rel="stylesheet" type="text/css"  href="css/styles.css"/>
 <!--   <link rel="stylesheet" type="text/css"  href="css/styles.css"/> -->
</head>
<div class="container p-3" >
    <div class="row">
            <div class="card card-body mt-3">

<form class="myform1" action="" method="POST">

                  <input type="text" name="kodi" class="form-control" placeholder="Vendosni kodin" required >

    <button type="submit" name="kerko"  class="btn btn-outline-success btn-block" value="Kerko"><i class="fa fa-search fa-fw"></i> Search</button>
      </form>
            </div>
    </div>
</div>
<?php
      if(isset($_POST['kerko'])) {
        extract($_POST);
        $kodi=$crud->escape_string($kodi);
        $kodi1=strlen($kodi);
        $kodiPare = substr($kodi, 0, 2);

        if($kodi1<5){
            echo "Error, vendosni kodin me te sakte/plote";
        }else{

        
        
?>      
<body>

<h1 style="text-align: center; ">Modifiko hartën</h1>
 
    <table class="table" id="thetable" width='80%' border=0>
 
    <tr class="thead-light">
        <th>FAI</th>
        <th>FOLDER</th>
        <th>Data e fillimit</th>
        <th>Data e përfundimit</th>
        <th>Operatori aktual</th>
        <th>Operatori i ri</th>
        <th>Fasha</th>
        <th>Civici</th>
        <th>Civici Op</th>
        <th>Prioriteti</th>
        <th>Statusi</th>
        <th>Edito</th>

        
    </tr>
    <?php 
    $query = "SELECT `f_ai`,`folder`, `data_inizio`, `data_fine`, `operatore`, `Fascia`, `koment`, `priority`, `civici`, `civici_operatore` FROM `hartat` WHERE `folder` like '$kodi%' AND `fushata`='$fushata'";
        $result = $crud->getData($query);
        foreach ($result as $key => $res) {
            $folder= $res['folder'];
            $folder=$crud->escape_string($folder);
            $f_ai= $res['f_ai'];

	?>
        <tr>
        <form class="form-group" method='post' action=''>
        <td><input class='form-control'  type='text' name='f_ai' value='<?php echo $f_ai;?>' readonly></td>
        <td><input class='form-control'  type='text' name='hartakodi' value='<?php echo $folder; ?>' readonly></td>
        <td><input class='form-control'  type='date' name='DATAINIZIO' value='<?php echo $res['data_inizio'];?>'></td>
        <td><input class='form-control'  type='date' name='DATAFINE' value='<?php echo $res['data_fine'];?>'></td>
        <td><input class='form-control'  type='text' readonly name='OPERATORE1' value='<?php echo $res['operatore'];?>'></td>
        
        <td><?php

            echo "<select name='OPERATORE' class='form-control ' type='list'><option value='{$res['operatore']}'>Zgjidh operatorin</option>"; // list box select command
            foreach ($result1 as $key => $res_2){//Array or records stored in $row

                echo "<option value='". $res_2['operatore'] ."'>". $res_2['operatore'] ."</option>";
            }
            echo "</select>";
            ?>
        </td>
        <td><input class='form-control ' type='text' name='Fascia' value='<?php echo $res['Fascia'];?>'></td>
            <td><input class='form-control ' type='text' name='civici' value='<?php echo $res['civici'];?>'></td>
            <td><input class='form-control ' type='text' name='civici_op' value='<?php echo $res['civici_operatore'];?>'></td>
        <td><input class='form-control ' type='text' name='priority' value='<?php echo $res['priority'];?>'></td>
        <td><input class='form-control ' type='text' name='KOMENT' value='<?php echo $res['koment'];?>'></td>
              <input class='form-control ' type='hidden' name='FOLDER' value='<?php $res['folder']?>'>
                <td>
                    <button class='form-control ' name='edit'>Edit</button>
                </td>
         
         </tr>
         </form>
   <?php  } 


}}
 ?>


<?php

if(isset($_POST['edit'])) {
        extract($_POST);
    echo '<div class="alert alert-success col-12" role="alert">Modifikimi u krye me sukses.</div>';
    echo '<script>setTimeout(function(){ window.location = "modifiko_db.php";}, 1500);</script>';
     $Update = $crud->execute("UPDATE `hartat` SET `data_inizio`='$DATAINIZIO', `data_fine`='$DATAFINE', `operatore`='$OPERATORE', `Fascia`='$Fascia', `priority`='$priority', `koment`='$KOMENT', `civici_operatore`='$civici_op' WHERE `f_ai`='$f_ai' AND `fushata`='$fushata'");
        //modifikodb_colture($crud,$hartakodi);
    
    }
    ?> 
</table>

<form class="form-group" method='post' action=''>

    <div class="input-group  mt-6 justify-content-center">
        <button class="btn" type="submit" name="shkarko"  value='Shkarko'><i class="fa fa-download"></i> Download </button>
    </div>
</form>


</body>
</html>

    <?php include('includes/footer.php');

} else {

    header("location: ../../index.php");
}
?>
