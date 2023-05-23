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
<body class="container-contact100">

<!-- Navbar
================================================== -->


            <?php

            $SQLSELECT = "SELECT * FROM hartat where fushata='$fushata'";
            $result =  $crud->getData($SQLSELECT);
            foreach ($result as $key => $res) {
                ?>

                <tr>
                    <td><?php echo $res['folder']; ?></td>
                    <td><?php echo $res['fushata']; ?></td>
                    <td><?php echo $res['Fascia']; ?></td>


                </tr>
                <?php
            }
            ?>
        </table>
    </div>

</div>

</body>
<?php
}else{



?>
<main class="container-contact100">
    <div class="wrap-contact100">
        <div class="span6" style="float: none; margin: 0 auto;">

        <?php
        if(isset($_POST['Communa'])){
        extract($_POST);
        if($Communa== 'tjeter1'){
        echo "<div class='card card-body text-center'>{$Communa}</div>";
        ?>
            <div class="card card-body my-3 ">
            <form  class="form-group" action="" method="POST">
                <input class='form-control mt-3 text-center' type='text' id='fname' name='Communa' placeholder='Shkruani Komunen e re'>
                <input class='form-control mt-3 text-center' type='text' id='fushata_re' name='fushata' placeholder='Shkruani fushaten e re:' >
            </div>
                <input type="submit"  name="procedo" class="btn btn-primary btn-block" value="Procedo" >
            </form>



            <?php
            }else{
            ?>
            <?php


            ?>

            <div class="card card-body">
            <form class="form-group" action="" method="POST">
                    <?php

                    $res_fushata="SELECT fushata from fushatat where Communa='$Communa'";
                    $resultfushata=$crud->getData($res_fushata);
                    echo "<select name='Communa' type='list' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example' readonly=''><option value='{$Communa}'>{$Communa}</option></select>";
                    echo "<select name='fushata' type='list' onchange='this.form.submit()' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'><option value=''>Zgjidh fushaten</option>";
                    foreach ($resultfushata as $key => $res9){

                        echo "<option value='$res9[fushata]'>$res9[fushata]</option>";
                    }
                    echo "<option value='tjeter'>Tjeter</option>";
                    echo "</select>";
                    ?>

                </form>
            </div>

                <?php
                }
                }else{
            ?>
            <h4>Zgjidh Komunen dhe Aktivitetin</h4>
            <div class="card card-body">
                <form class="form-group" action="" method="POST">
                    <div >
                        <?php
                        $res_komuna="SELECT DISTINCT Communa from hartat";
                        $result2 = $crud->getData($res_komuna);
                        echo "<select name='Communa' onchange='this.form.submit()' type='list' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'><option value=''>Zgjidh komunen</option>";
                        foreach ($result2 as $key => $res2){

                            echo "<option value='$res2[Communa]'>$res2[Communa]</option>";
                        }
                        echo "<option value='tjeter1'>Tjeter</option>";
                        echo "</select>";
                        ?>

                </form>
            </div>
            </form>

        <?php
            }

                if(isset($_POST['fushata'])){
                extract($_POST);

                if($fushata=='tjeter'){
                ?>
                <form class="form-group mt-2" action="" method="POST">
                        <input type='hidden' name='Communa' value='<?php echo $Communa;?>'>
                        <input class='form-control' type='text' id='fushata_re' name='fushata' placeholder=' Shkruani_fushaten_e_re'><br>
                        <input type="submit" name="procedo" class="btn btn-primary btn-block" value="Procedo">
                    </form>

                    <?php
                }else{
                    ?>

                        <input type='hidden' name='fushata' value='<?php echo $fushata.$Communa;?>'>

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
                                        <form class="form-horizontal well" action="import.php?fushatat=<?php echo $fushata?>&Communa=<?php echo $Communa?>" method="post" name="upload_excel" enctype="multipart/form-data">
                                            <fieldset>
                                                <legend>Import CSV/Excel file</legend>
                                                <div class="control-group">
                                                    <div class="control-label">
                                                        <label>CSV/Excel File:</label>
                                                    </div>
                                                    <div class="controls">
                                                        <input type="file" name="file" id="file" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="control-group mt-3">
                                                    <div class="controls text-center">
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


                        <?php
                        }

                        ?>

        <body>
        <!-- Navbar
        ================================================== -->

        <?php


        }

        ?>

        </body>


</html>
