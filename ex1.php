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
    if (isset($_POST['dergo'])) {
        extract($_POST);
        $kontrollo1="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='$foto_nr' and date(koha_inserimit)=CURRENT_DATE and operatori='$employee_id'";
        $result_k1=$crud->getData($kontrollo1);
        foreach ($result_k1 as $key => $res2) {
            $totali1=$res2['shumatorja'];;
        }

        if($totali1<1) {
            $names = explode(" ", $employee_id); // Split the full name into an array of first and last names
            $initials = "";
            foreach ($names as $name) {
                $initials .= strtoupper(substr($name, 0, 1)); // Get the first character of each name and concatenate
            }
            $uniqueId=rand ( 100000 , 999999 )."".$initials."".date("Ymdhis")."".$foto_nr;

            $pyetjet = array('Numero civico?', 'Categoria civico?', 'Tipo di edificio?','Unita residenziali?', 'Unita Business?', 'Nota?');
            $pergjigjet = array("$numero_civico", "$categoria_civico", "$tipo_di_edificio","$unita_residenziali", "$unita_business", "$shenimi");
            for($j=0; $j<6; $j++){
                $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('$foto_nr','$j','$pyetjet[$j]','$pergjigjet[$j]','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
                $shto1=$crud->execute($query1);
            }
        }else{
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                <i class='mdi mdi-alert-outline me-2'></i>
        Ju keni shtuar te dhena per Foto Nr <?php echo $i; ?>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
        }


    }
    $query_get="SELECT distinct imazhi from testimi where operatori='Alket Selimaj'";
    $result=$crud->getData($query_get);

    ?>
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <style>
            img{
                height: 708px;
                width: 1251px;
                border: 1px solid #212529;
            }
        </style>

    <body data-topbar="dark">
                            <div class="col-lg-12">
                                <div class="card mt-3">
                                    <div class=" card card-body">
                                        <h4 class="card-title mb-4 text-center">Provimi me 4 pyetje</h4>

                                        <div id="progrss-wizard" class="twitter-bs-wizard">
                                            <ul class="twitter-bs-wizard-nav nav-justified">
                                                <?php
                                                for($i=1; $i<5; $i++){

                                                ?>
                                                <li class="nav-item">
                                                    <a id="tabLink<?php echo $i; ?>" href="#pyetja<?php echo $i;?>" class="nav-link" data-toggle="tab">
                                                        <span class="step-number"><?php echo $i; ?></span>
                                                        <span class="step-title">Foto<?php echo $i;?></span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                <li class="nav-item">
                                                    <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                                                        <span class="step-number">05</span>
                                                        <span class="step-title">Confirm Detail</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div id="bar" class="progress mt-4">
                                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                                            </div>

                                            <div class="tab-content twitter-bs-wizard-tab-content">

                                                <?php
                                                for($i=1; $i<5; $i++){

                                                ?>
                                                <div class="tab-pane" id="pyetja<?php echo $i;?>">
                                                     <?php
                                        $img="foto".$i;
                                        $kontrollo1="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='$img' and date(koha_inserimit)=CURRENT_DATE and operatori='$employee_id'";
                                        $result_k1=$crud->getData($kontrollo1);
                                        foreach ($result_k1 as $key => $res2) {
                                            $totali1=$res2['shumatorja'];;
                                        }
                                        if($totali1<1){?>
                                                    <div class="row">
                                                    <div class="col-xl-8 ">
                                                            <img  id="54" src="imgpyetjet/pyetja<?php echo $i;?>.jpg.png" alt="" style="width:768; height: 478; "/>
                                                            <a id="tabLink<?php echo $i; ?>" href="imgpyetjet/pyetja<?php echo $i;?>.jpg.png" class="btn btn-outline-secondary mt-3 "  target="_blank" rel="noopener"><i class="fas fa-eye mr-2"></i>Hape ne full mode
                                                            </a>
                                                        </div>
                                                    <div class="col-xl-4">
                                                        <form class="form-group mt-3" id="my-form" method='post' action=''>

                                                            <label>1. Numero civico?</label>
                                                            <input type="text" class="form-control" name="numero_civico" value="" placeholder="Answer here...">

                                                            <label>2. Categoria civico?</label>
                                                            <select name="categoria_civico" class="form-control" ref="categoria">
															<option value="Abbandonato">Abbandonato</option>
															<option value="Armadio Esterno">Armadio Esterno</option>
															<option value="Cantiere">Cantiere</option>
															<option value="Commercial">Commercial</option>
															<option value="Edificio Business">Edificio Business</option>
															<option value="Edificio Pubblico">Edificio Pubblico</option>
															<option value="Ente Religioso">Ente Religioso</option>
															<option value="FWA">FWA</option>
															<option value="Inesistente">Inesistente</option>
															<option value="MDU">MDU</option>
															<option value="Multi Building">Multi Building</option>
															<option value="Multi Scala">Multi Scala</option>
															<option value="Negozio Standalone">Negozio Standalone</option>
															<option value="Negozio in Civico Business">Negozio in Civico Business</option>
															<option value="Negozio in Civico Residenziale">Negozio in Civico Residenziale</option>
															<option value="Other">Other</option>
															<option value="Passo Carrabile">Passo Carrabile</option>
															<option value="Residential">Residential</option>
															<option value="Standalone">Standalone</option>
															<option value="Unknown">Unknown</option>
															<option value="Vetrina">Vetrina</option>
															</select>

                                                            <label >3. Tipo di edificio?</label>
                                                            <select name="tipo_di_edificio" class="form-control" ref="tipoedificio">
															<option value="Antenna">Antenna</option>
															<option value="Armadio Telecom">Armadio Telecom</option>
															<option value="Cabina">Cabina</option>
															<option value="Centrale SGU">Centrale SGU</option>
															<option value="Church">Church</option>
															<option value="Commercial">Commercial</option>
															<option value="FWA">FWA</option>
															<option value="Government">Government</option>
															<option value="Hospital">Hospital</option>
															<option value="H/M">Hotel/Motel</option>
															<option value="MDU">MDU</option>
															<option value="Metro">Metro</option>
															<option value="MPO">Minipop</option>
															<option value="Non Servibile">Non Servibile</option>
															<option value="Oggetto Terzo">Oggetto Terzo</option>
															<option value="POI">POI</option>
															<option value="POP">POP</option>
															<option value="Pac Pal">Pac Pal</option>
															<option value="RES">Residential</option>
															<option value="SDU">SDU</option>
															<option value="School">School</option>
															<option value="SHE">Shelter</option>
															<option value="ZTL">ZTL</option>
															<option value="Non definito">Non definito</option>
															</select>

                                                            <label>4. Unita residenziali?</label>
                                                            <input type="text" class="form-control" name="unita_residenziali" value="" placeholder="Answer here..." required>

                                                            <label>5. Unita Business</label>
                                                            <input type="text" class="form-control" name="unita_business" value="" placeholder="Answer here..." required>

                                                            <label>6. Nota<?php echo $i;?></label>
                                                            <input type="text" class="form-control" name="shenimi" value="" placeholder="Answer here..." required>
                                                            <input type="hidden" name="foto_nr" value="foto<?php echo $i;?>">
                                                            <button name='dergo' class="btn btn-primary mt-3" >Shto<?php echo $i;?></button>

                                                        </form>
                                                </div>

                                                    </div>
                                                        <?php
                                                    }else{

                                                    ?>


                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6">
                                                                <div class="text-center">
                                                                    <div class="mb-4">
                                                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h5>Confirm Detail</h5>
                                                                        <p class="text-muted">Ti perfundove me sukses pyetjen Nr:<?php echo $i;?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="tab-pane" id="progress-confirm-detail">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6">
                                                                <div class="text-center">
                                                                    <div class="mb-4">
                                                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h5>Confirm Detail</h5>
                                                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    </div>


                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                                                <li class="next"><a href="javascript: void(0);">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
    </body>





            <!-- end main content-->


        <!-- END layout-wrapper -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- twitter-bootstrap-wizard js -->
        <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

        <script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

        <!-- form wizard init -->
        <script src="assets/js/pages/form-wizard.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
    <?php
}
?>
