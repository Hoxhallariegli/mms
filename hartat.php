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
td {
    text-align: center;
}
body {
    background: #222831;
}


</style>
    <title>Modifiko fushatat</title>
    <link rel="stylesheet" type="text/css"  href="css/styles.css"/>
 <!--   <link rel="stylesheet" type="text/css"  href="css/styles.css"/> -->
</head>
 

<body >

<h1 style="text-align: center ; ">Modifiko fushatat</h1>

<?php

if(isset($_POST['edit'])) {
        extract($_POST);
     $Update = $crud->execute("UPDATE `fushatat` SET `fushata`='$emri_f', `statusi`='$statusi' WHERE `fushata_id`='$fushata'");
     
     echo '<div class="alert alert-success col-12" role="alert">Modifikimi u krye me sukses.</div>';
     echo '<script>setTimeout(function(){ window.location = "hartat.php";}, 1500);</script>';
   
   
    }
    ?> 
 
    <table class="table mt-3 ">

    <tr class="thead-light" >
        <th>Fushata</th>
        <th>Foldera</th>
        <th>Ne proces</th>
        <th>Te lira</th>
        <th>Te perfunduara</th>
        <th>?</th>
        <th>Emri</th>
        <th>Statusi</th>
        <th>Ndrysho Status</th>
        <th>Ndrysho</th>


    </tr>
    <?php 
    $query="select fushatat.Communa as Communa, hartat.fushata AS fushata, fushatat.fushata_id as fushata_id, count(folder) as harta, count(CASE WHEN(data_inizio !='' AND data_inizio IS NOT NULL AND data_inizio !='0000-00-00') AND (data_Fine ='' or data_Fine IS NULL or data_Fine ='0000-00-00') THEN 1 END) as neproces, count(CASE WHEN(data_inizio ='' or data_inizio ='0000-00-00' or data_inizio IS NULL) THEN 1 END) as pa_mara, count(CASE WHEN (data_Fine !='' AND data_Fine !='0000-00-00' AND data_Fine IS NOT NULL) THEN 1 END) as perfunduara, fushatat.fushata AS emri, fushatat.statusi as statusi from hartat inner join fushatat on hartat.fushata=fushatat.fushata_id group by hartat.fushata
";
    $result = $crud->getData($query);

        foreach ($result as $key => $res) {   
	?>
        <tr>
        <form class="form-group" method='post' action=''>
            <td><input class='form-control' type='text' name='Communa' value='<?php echo $res['Communa'];?>' readonly></td>
            <td><input class='form-control ' type='text' name='fushata' value='<?php echo $res['fushata'];?>' readonly></td>
        <td><?php echo $res['harta'];?></td>
        <td><?php echo $res['neproces'];?></td>
        <td><?php echo $res['pa_mara'];?></td>
        <td><?php echo $res['perfunduara'];?></td>
         <td><input  class='form-control ' type='text' name='emri_f' value='<?php echo $res['emri'];?>'></td>
            <?php

            if ($res['statusi']== "attivo") {
                echo "<td  style='color: darkgreen'  ><i class='fa fa-check-circle' style='font-size:20px;color:darkgreen'></i>";
                echo $res['statusi'];
                echo "</td>";
                echo "";

            } elseif ($res['statusi']== "inattivo"){
                echo "<td style='color: darkred'><i class='fa fa-ban' style='font-size:20px;color:red'></i>";
                echo $res['statusi'];
                echo "</td>";
            }else{
                echo"<td > <i class='fa fa-plus-circle' style='font-size:30px;color:green'></i> </td> ";
            }
            ?>
<td>
<select name='statusi' type='list' class='form-control '><option value='<?php echo $res['statusi'];?>'>Ndrysho_statusin</option>
                      <option value='attivo'>Aktive</option>
                      <option value='inattivo'>Jo-aktive</option>
                        </select>
                    </td></td>
              <input type='hidden' name='fushata_id' value='<?php $res['fushata_id']?>'
                ><td>
                    <button name='edit' class='form-control '>Edit</button>
                </td>
         
         </tr>
         </form>
   <?php  } 


}
 ?>


</table>

</body>
</html>

    <?php include('includes/footer.php');


?>
