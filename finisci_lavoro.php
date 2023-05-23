<?php
include('includes/header1.php');
include_once('ini.php');
include_once("shto_function.php");
include_once("functions.php");
if ($_SESSION["Ferid"]){
    $crud = new Crud();
    $validation = new Validation();

    $employee_id = $_SESSION["Ferid"];
    $level = $_SESSION['Access'];

    if(isset($_GET['fushatat'])){
        $fushata= $_GET['fushatat'];
    }
    if (isset($_POST['dorezo'])) {
        extract($_POST);
        perfundoPunen($crud, $folder, $employee_id, $fushata,$rruget,$shenimi);
    }

    if (isset($_POST['nderprit'])) {
        extract($_POST);
        nderpritPunen($crud, $folder, $employee_id,$fushata,$shenimi);
    }
    if (isset($_POST['rimerr'])) {
        extract($_POST);
        rimerrPunen($crud, $folder, $employee_id,$fushata);
    }
    if (isset($_POST['punetjeter'])) {
        header("Location: scegli_lavoro.php?fushatat=$fushata");
    }

    if (isset($_POST['perditeso'])) {
        extract($_POST);
        perditesoCivici($crud,$folder,$rruget);
    }
    ?>
    <style>
        .Color_Status_neproces{
            background-color: #d5ffd5  !important;
            font-weight: bold;

        .th{
            font size="35;"
        }
        }
        .Color_Status_nderprere{
            background-color: #ffffd5 !important;

        }

    </style>
    <main class="container-fluid">
    <div class="row">
    <div class="col-md-6">
        <!-- MESSAGES -->

        <div class="card card-body text-center mt-5">
            <table class="table table-striped text-center mt-3 my-3">
                <h4>Rrugët për tu përfunduar </h4>
                <thead>
                <?php
                $query = "SELECT `folder`, `Fascia`, `fushata` from `hartat`  WHERE  `fushata`='$fushata' AND (`data_fine` = '0000-00-00' or `data_fine` is null) AND `operatore`='$employee_id'";
                $result = $crud->getData($query);
                foreach ($result as $key => $res2) {
                    $folder=$res2['folder'];;
                }

                if($result){
                    $gjendjaHartes=statusiHartes($crud,$folder,$employee_id,$fushata);
                }else{
                    $gjendjaHartes='empty';
                }




                if($gjendjaHartes==='neproces'){
                    ?>
                    <tr>
                        <th>Nr.</th>
                        <th>Rruga</th>
                        <th>Operatori</th>
                        <th>Data e fillimit</th>
                        <th>Fasha</th>
                        <th>Civici</th>
                        <th>Shenimi</th>
                        <th>Perfundo</th>
                        <th>Update</th>
                        <th>Nderprit</th>
                    </tr>

                    <?php

                }else if($gjendjaHartes='nderprere'){
                    ?>
                    <th>Nr.</th>
                    <th>Rruga</th>
                    <th>Operatori</th>
                    <th>Data e fillimit</th>
                    <th>Fasha</th>
                    <th>Civici</th>
                    <th>Shenimi</th>
                    <th>Veprimi</th>
                    <?php
                }else{
                    echo "Test";
                }
                ?>


                </thead>
                <tbody>

                <?php

                $query = "SELECT `folder`, `Fascia`, `data_inizio`, `operatore`, `koment`, `fushata` from `hartat`  WHERE  `fushata`='$fushata' AND (`data_fine` = '0000-00-00' or `data_fine` is null) AND `operatore`='$employee_id'";
                $result = $crud->getData($query);
                $i=0;

                foreach ($result as $key => $res) {
                $i++;
                ?>
                </thead>
                <tbody>

                <tr class='form-control<?php echo $res['koment'];?>'></tr>
                <form class="form-group" method='post' action=''>
                <td><?php echo $i?></td>
                <td><?php echo $res['folder']; ?></td>
                <td><?php echo $res['operatore']; ?></td>
                <td><?php echo $res['data_inizio']; ?></td>
                <td><?php echo $res['Fascia']; ?></td>
                <?php
                $folder=$res['folder'];
                $gjendjaHartes=statusiHartes($crud,$folder,$employee_id,$fushata);

                if($gjendjaHartes==='neproces'){
                    ?>




                        <td>
                            <input id="test" type="text" class="form-control" name="rruget" value="" required autofocus>
                        </td>
                    <td>
                        <input id="test" type="text" class="form-control" name="shenimi" value="" required autofocus>
                    </td>

                        <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">

                        <td>
                            <button name='dorezo' class="btn btn-primary" >Përfundo</button>
                        </td>
                        <td>
                            <button name='perditeso' class="btn btn-primary" >Up</button>
                        </td>


                    </td>
                    <?php
                }else{
                    echo "<td></td>";
                }?>
                <?php
                $folder=$res['folder'];

                if($gjendjaHartes==='neproces'){
                    ?>
                    <td>

                            <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
                            <button name='nderprit' class="btn btn-primary" >Ndërprit</button>
                    </td>
                <?php }else{ ?>
                    <td>
                            <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
                            <button name='rimerr' class="btn btn-primary" >Rimerr</button>

                    </td>
                <?php }?>
                </form>
                </tr>
                <?php  } ?>
                </tbody>
            </table>

            <?php
            $statusi_op=perllogaritHartaAktive($crud,$employee_id,$fushata);
            if($statusi_op<1){ ?>
                <table>
                    <tr>
                        <td style='text-align:center;'>
                            <form class="form-group" method='post' action=''>
                                <button name='punetjeter' class="btn btn-primary" >Mer një hartë tjetër</button>
                            </form>
                        </td>
                    </tr>
                </table>
            <?php } ?>


        </div>
    </div>

    <div class="col-md-6">

        <div class="card card-body mt-5 text-center">
            <table class="table table-striped text-center mt-3 my-3">
                <h4>Rrugët që keni përfunduar sot </h4>
                <body onload="alternate('thetable')">
                <thead class="header_tab" >
                <tr>
                    <th>Nr.</th>
                    <th>Rruga</th>
                    <th>Operatori</th>
                    <th>Fasha</th>
                    <th>Civici te shenuara</th>
                    <th>Data e fillimit</th>
                    <th>Data e përfundimit</th>
                    <th>Update Civici</th>
                </tr>
                </thead>
                <tbody>

                <?php


                $query = "SELECT `folder`, `Fascia`, `operatore`, `data_inizio`, `data_fine`, `fushata`, `civici_operatore`  from `hartat`  WHERE `data_fine`= CURDATE() AND `operatore`='$employee_id' AND fushata='$fushata'";
                $result = $crud->getData($query);
                $i=0;
                foreach ($result as $key => $res) {
                    $i++;
                    ?>
                    <form  class="form-group" method='post' action=''>
                        <tr>
                            <td><?php echo $i?>
                            <td><?php echo $res['folder']; ?></td>
                            <td><?php echo $res['operatore']; ?></td>
                            <td><?php echo $res['Fascia']; ?></td>
                            <td>
                                <input type="hidden" name="folder" value="<?php echo $res['folder']; ?>">
                                <input id="test" type="text" class="form-control" name="rruget" value="<?php echo $res['civici_operatore'];?>" required autofocus>
                            </td>
                            <td><?php echo $res['data_inizio']; ?></td>
                            <td><?php echo $res['data_fine']; ?></td>
                            <td>
                                <button name='perditeso' class="btn btn-primary" >Update</button>
                            </td>
                    </form>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>


        </div>
    </div>

    <?php include('includes/footer.php');
}else{
    header("location: index.php");
}
?>