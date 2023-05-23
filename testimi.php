<?php
session_start();
header("Cache-Control: no cache");
include_once('ini.php');
include_once("shto_function.php");
include_once("functions.php");
if ($_SESSION["Ferid"]){
    $crud = new Crud();
    $validation = new Validation();
    $employee_id = $_SESSION["Ferid"];
    $level = $_SESSION['Access'];
    if (isset($_POST['dergo_1'])) {
        extract($_POST);
        $kontrollo1="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto1' and date(koha_inserimit)=CURRENT_DATE";
        $result_k1=$crud->getData($kontrollo1);
        foreach ($result_k1 as $key => $res2) {
            $totali1=$res2['shumatorja'];;
        }
        if($totali1<1) {
            $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto1','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto1=$crud->execute($query1);

            $query2="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto1','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto2=$crud->execute($query2);

            $query3="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto1','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP)";
            $shto3=$crud->execute($query3);

            $query4="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto1','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP)";
            $shto4=$crud->execute($query4);

            $query5="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto1','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP)";
            $shto5=$crud->execute($query5);

            $query6="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto1','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP)";
            $shto6=$crud->execute($query6);
            echo '<script>window.open("#pyetja2")</script>';
        }else{
            echo "Ju keni shtuar te dhena per kete imazh";
        }


    }
    if (isset($_POST['dergo_2'])) {
        extract($_POST);
        $kontrollo2="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto2' and date(koha_inserimit)=CURRENT_DATE";
        $result_k2=$crud->getData($kontrollo2);
        foreach ($result_k2 as $key => $res2) {
            $totali2=$res2['shumatorja'];;
        }
        if($totali2<1) {
            $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto2','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto1=$crud->execute($query1);

            $query2="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto2','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto2=$crud->execute($query2);

            $query3="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto2','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP)";
            $shto3=$crud->execute($query3);

            $query4="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto2','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP)";
            $shto4=$crud->execute($query4);

            $query5="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto2','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP)";
            $shto5=$crud->execute($query5);

            $query6="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto2','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP)";
            $shto6=$crud->execute($query6);
        }else{
            echo "Ju keni shtuar te dhena per kete imazh";
        }

    }
    if (isset($_POST['dergo_3'])) {
        extract($_POST);
        $kontrollo3="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto3' and date(koha_inserimit)=CURRENT_DATE";
        $result_k3=$crud->getData($kontrollo3);
        foreach ($result_k3 as $key => $res2) {
            $totali3=$res2['shumatorja'];;
        }
        if($totali3<1) {
            $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto3','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto1=$crud->execute($query1);

            $query2="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto3','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto2=$crud->execute($query2);

            $query3="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto3','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP)";
            $shto3=$crud->execute($query3);

            $query4="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto3','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP)";
            $shto4=$crud->execute($query4);

            $query5="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto3','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP)";
            $shto5=$crud->execute($query5);

            $query6="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto3','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP)";
            $shto6=$crud->execute($query6);
        }else{
            echo "Ju keni shtuar te dhena per kete imazh";
        }

    }
    if (isset($_POST['dergo_4'])) {
        extract($_POST);
        $kontrollo4="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto4' and date(koha_inserimit)=CURRENT_DATE";
        $result_k4=$crud->getData($kontrollo4);
        foreach ($result_k4 as $key => $res2) {
            $totali4=$res2['shumatorja'];;
        }
        if($totali4<1) {

            $query1 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto4','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto1 = $crud->execute($query1);

            $query2 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto4','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP)";
            $shto2 = $crud->execute($query2);

            $query3 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto4','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP)";
            $shto3 = $crud->execute($query3);

            $query4 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto4','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP)";
            $shto4 = $crud->execute($query4);

            $query5 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto4','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP)";
            $shto5 = $crud->execute($query5);

            $query6 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `text`, `operatori`, `koha_inserimit`) VALUES ('foto4','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP)";
            $shto6 = $crud->execute($query6);
        }else{
            echo "Ju keni shtuar te dhena per kete imazh";
        }

    }

    $query_get="SELECT distinct imazhi from testimi where operatori='Alket Selimaj'";
    $result=$crud->getData($query_get);

    ?>

    <!doctype html>
    <html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Tabs & Accordions | Upcube - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <style>
            #container {
                width: 700px;
                width: 700px
            }

            #container img {
                width: 100%;
            }
        </style>

        <script>
            function openTab(tabName) {
                var i, tabContent;
                tabContent = document.getElementsByClassName("tab-content");
                for (i = 0; i < tabContent.length; i++) {
                    tabContent[i].style.display = "none";
                }
                document.getElementById(tabName).style.display = "block";
            }
        </script>

    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">


                            <!-- Nav tabs -->
                            <div class="tabview">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#pyetja1" role="tab" aria-selected="false">
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">Pyetja1</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#pyetja2" role="tab" aria-selected="false">
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Pyetja2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#pyetja3" role="tab" aria-selected="true">
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">Pyetja3</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#pyetja4" role="tab" aria-selected="false">
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">Pyetja4</span>
                                        </a>
                                    </li>
                                </ul>


                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane" id="pyetja1" role="tabpanel">

                                        <img class="form-control" src="imgpyetjet/pyetja1.jpg" alt="" />

                                        <form class="form-group" method='post' action='#pyetja1'>

                                            <label for="question02">1. Numero civico?</label>
                                            <input type="text" class="form-control" name="numero_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">2. Categoria civico?</label>
                                            <input type="text" class="form-control" name="categoria_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">3. Tipo di edificio?</label>
                                            <input type="text" class="form-control" name="tipo_di_edificio" value="" placeholder="Answer here..." required>

                                            <label for="question02">4. Unita residenziali?</label>
                                            <input type="text" class="form-control" name="unita_residenziali" value="" placeholder="Answer here..." required>

                                            <label for="question02">5. Unita Business</label>
                                            <input type="text" class="form-control" name="unita_business" value="" placeholder="Answer here..." required>

                                            <label for="question02">6. Nota1</label>
                                            <input type="text" class="form-control" name="shenimi" value="" placeholder="Answer here..." required>


                                            <button name='dergo_1' class="btn btn-primary" value="#settings" >Shto1</button>
                                        </form>
                                    </div>




                                    <div class="tab-pane" id="pyetja2" role="tabpanel">
                                        <div i>
                                            <img class="form-control" src="imgpyetjet/pyetja1.jpg" alt="" />
                                        </div>

                                        <script type="text/javascript">
                                            (function() {

                                                var img = document.getElementById('container').firstChild;
                                                img.onload = function() {
                                                    if(img.height > img.width) {
                                                        img.height = '100%';
                                                        img.width = 'auto';
                                                    }
                                                };

                                            }());
                                        </script>
                                        <form class="form-group" method='post' action=''>

                                            <label for="question02">1. Numero civico?</label>
                                            <input type="text" class="form-control" name="numero_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">2. Categoria civico?</label>
                                            <input type="text" class="form-control" name="categoria_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">3. Tipo di edificio?</label>
                                            <input type="text" class="form-control" name="tipo_di_edificio" value="" placeholder="Answer here..." required>

                                            <label for="question02">4. Unita residenziali?</label>
                                            <input type="text" class="form-control" name="unita_residenziali" value="" placeholder="Answer here..." required>

                                            <label for="question02">5. Unita Business</label>
                                            <input type="text" class="form-control" name="unita_business" value="" placeholder="Answer here..." required>

                                            <label for="question02">6. Nota2</label>
                                            <input type="text" class="form-control" name="shenimi" value="" placeholder="Answer here..." required>
                                            <button name='dergo_2' class="btn btn-primary" >Shto2</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="pyetja3" role="tabpanel">
                                        <div i>
                                            <img class="form-control" src="imgpyetjet/pyetja1.jpg" alt="" />
                                        </div>

                                        <script type="text/javascript">
                                            (function() {

                                                var img = document.getElementById('container').firstChild;
                                                img.onload = function() {
                                                    if(img.height > img.width) {
                                                        img.height = '100%';
                                                        img.width = 'auto';
                                                    }
                                                };

                                            }());
                                        </script>
                                        <form class="form-group" method='post' action='#pyetja3'>

                                            <label for="question02">1. Numero civico?</label>
                                            <input type="text" class="form-control" name="numero_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">2. Categoria civico?</label>
                                            <input type="text" class="form-control" name="categoria_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">3. Tipo di edificio?</label>
                                            <input type="text" class="form-control" name="tipo_di_edificio" value="" placeholder="Answer here..." required>

                                            <label for="question02">4. Unita residenziali?</label>
                                            <input type="text" class="form-control" name="unita_residenziali" value="" placeholder="Answer here..." required>

                                            <label for="question02">5. Unita Business</label>
                                            <input type="text" class="form-control" name="unita_business" value="" placeholder="Answer here..." required>

                                            <label for="question02">6. Nota3</label>
                                            <input type="text" class="form-control" name="shenimi" value="" placeholder="Answer here..." required>

                                            <button name='dergo_3' class="btn btn-primary" >Shto3</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="pyetja4" role="tabpanel">
                                        <div i>
                                            <img class="form-control" src="imgpyetjet/pyetja1.jpg" alt="" />
                                        </div>

                                        <script type="text/javascript">
                                            (function() {

                                                var img = document.getElementById('container').firstChild;
                                                img.onload = function() {
                                                    if(img.height > img.width) {
                                                        img.height = '100%';
                                                        img.width = 'auto';
                                                    }
                                                };

                                            }());
                                        </script>
                                        <form class="form-group" method='post' action=''>

                                            <label for="question02">1. Numero civico?</label>
                                            <input type="text" class="form-control" name="numero_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">2. Categoria civico?</label>
                                            <input type="text" class="form-control" name="categoria_civico" value="" placeholder="Answer here..." required>

                                            <label for="question02">3. Tipo di edificio?</label>
                                            <input type="text" class="form-control" name="tipo_di_edificio" value="" placeholder="Answer here..." required>

                                            <label for="question02">4. Unita residenziali?</label>
                                            <input type="text" class="form-control" name="unita_residenziali" value="" placeholder="Answer here..." required>

                                            <label for="question02">5. Unita Business</label>
                                            <input type="text" class="form-control" name="unita_business" value="" placeholder="Answer here..." required>

                                            <label for="question02">6. Nota4</label>
                                            <input type="text" class="form-control" name="shenimi" value="" placeholder="Answer here..." required>

                                            <button name='dergo_4'   class="btn btn-primary" >Shto4</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Upcube.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">

                <h5 class="m-0 me-2">Settings</h5>

                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="mt-0" />
            <h6 class="text-center mb-0">Choose Layouts</h6>

            <div class="p-4">
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
                </div>
                <div class="form-check form-switch mb-5">
                    <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">
                    <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                </div>


            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

    </body>
    </html>
    <?php
}
?>