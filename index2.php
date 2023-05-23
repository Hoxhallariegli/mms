<!DOCTYPE html>
<?php
include('includes/header1.php');
include_once('ini.php');
include_once("shto_function.php");
date_default_timezone_set('Asia/Kolkata');


$crud = new Crud();


if(isset($_GET['fushatat'])){
$fushata= $_GET['fushatat'];
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Import Excel To MySQL Database Using PHP </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Import Excel File To MySQL Database Using php">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/bootstrap-custom.css">


</head>
<body>

<!-- Navbar
================================================== -->

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Import Excel To MySQL Database Using PHP</a>

        </div>
    </div>
</div>

<div id="wrap">
    <div class="container">
        <div class="row">
            <div class="span3 hidden-phone"></div>
            <div class="span6" id="form-login">
                <form class="form-horizontal well" action="import.php?fushatat=<?php echo $fushata?>" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Import CSV/Excel file</legend>
                        <div class="control-group">
                            <div class="control-label">
                                <label>CSV/Excel File:</label>
                            </div>
                            <div class="controls">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="span3 hidden-phone"></div>
        </div>
    </div>

</div>

</body>
<?php
}else{



?>
<main class="container p-6" id="dist_nga_header">
    <div class="row">
        <div class="col-md-4">
            <h4>Zgjidh Fushaten</h4>
            <div class="card card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <?php
                        $res_komuna="SELECT DISTINCT Communa from hartat";
                        $result2 = $crud->getData($res_komuna);
                        echo "<select name='Communa' type='list' class='ddl_op'><option value=''>Zgjidh komunen</option>";
                        foreach ($result2 as $key => $res2){

                            echo "<option value='$res2[Communa]'>$res2[Communa]</option>";
                        }
                        echo "<option value='tjeter1'>Tjeter</option>";
                        echo "</select>";
                        ?>
                        <input type="submit" name="zgjidh_komunen" class="btn btn-primary btn-block" value="Zgjidh">
                </form>
            </div>
        </div>
        <?php
        if(isset($_POST['zgjidh_komunen'])){
            extract($_POST);
            if($Communa== 'tjeter1'){
                echo $Communa;
                ?>
        <form action="" method="POST">
            <form class="form-group">
                <p>Shkruani_Komunen_e_re:</p><br>
          <input type='text' id='fname' name='Communa'><br>
          <p>Shkruani_fushaten_e_re:</p><br>
          <input type='text' id='fushata_re' name='fushata'><br>
          <input type="submit" name="procedo" class="btn btn-primary btn-block" value="Procedo">
            </form>
                <?php
            }else{
                echo $Communa;
                ?>
                <form action="" method="POST">
                    <form class="form-group">
                        <?php

                        $res_fushata="SELECT fushata from fushatat where Communa='$Communa'";
                        $resultfushata=$crud->getData($res_fushata);
                     echo "<select name='fushata' type='list' class='ddl_op'><option value=''>Zgjidh fushaten</option>";
                        foreach ($resultfushata as $key => $res9){

                            echo "<option value='$res9[fushata]'>$res9[fushata]</option>";
                        }
                        echo "<option value='tjeter'>Tjeter</option>";
                        echo "</select>";
                        ?>
                        <input type='hidden' name='Communa' value='<?php echo $Communa;?>'>
                        <input type="submit" name="zgjidh_fushaten" class="btn btn-primary btn-block" value="Zgjidh">
                    </form>
                    <?php
                    }
            }

                    if(isset($_POST['zgjidh_fushaten'])){
                        extract($_POST);

                        if($fushata=='tjeter'){
                    ?>
                        <form action="" method="POST">
                            <form class="form-group">
                                <input type='hidden' name='Communa' value='<?php echo $Communa;?>'>
                                <p>Shkruani_fushaten_e_re:</p><br>
                                <input type='text' id='fushata_re' name='fushata'><br>
                                <input type="submit" name="procedo" class="btn btn-primary btn-block" value="Procedo">
                            </form>
                            <?php
                        }else{
                                ?>
                            <form action="" method="POST">
                                <form class="form-group">
                                    <input type='hidden' name='fushata' value='<?php echo $fushata;?>'>
                                    <input type='hidden' name='Communa' value='<?php echo $Communa;?>'>
                                    <input type="submit" name="procedo" class="btn btn-primary btn-block" value="Procedo">
                                </form>
                            <?php
                        }
                    }

        if(isset($_POST['procedo'])){
            extract($_POST);
            echo $Communa;
            echo $fushata;
        }
        ?>
        <body>
        <!-- Navbar
        ================================================== -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Import Excel To MySQL Database Using PHP</a>

                </div>
            </div>
        </div>
        <div id="wrap">
            <div class="container">
                <div class="row">
                    <div class="span3 hidden-phone"></div>
                    <div class="span6" id="form-login">
                        <form class="form-horizontal well" action="import.php?fushatat=<?php echo $fushata?>&Communa=<?php echo $komuna?>" method="post" name="upload_excel" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Import CSV/Excel file</legend>
                                <div class="control-group">
                                    <div class="control-label">
                                        <label>CSV/Excel File:</label>
                                    </div>
                                    <div class="controls">
                                        <input type="file" name="file" id="file" class="input-large">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="span3 hidden-phone"></div>
                </div>
            </div>

        </div>

        <?php


        }

        ?>

        </body>


</html>
