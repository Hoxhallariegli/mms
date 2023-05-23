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
if (isset($_POST['dergo_1'])) {
    extract($_POST);
    $kontrollo1="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto1' and date(koha_inserimit)=CURRENT_DATE and operatori='$employee_id'";
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
        $uniqueId=rand ( 100000 , 999999 )."".$initials."".date("Ymdhis");

        $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto1','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto1=$crud->execute($query1);

    $query2="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto1','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto2=$crud->execute($query2);

    $query3="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto1','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto3=$crud->execute($query3);

    $query4="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto1','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto4=$crud->execute($query4);

    $query5="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto1','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto5=$crud->execute($query5);

    $query6="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto1','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto6=$crud->execute($query6);
    echo '<script>window.open("#pyetja2")</script>';
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show text-center ' role='alert'>
                                                <i class='mdi mdi-alert-outline me-2 '></i>
        Ju keni shtuar te dhena per Foto Nr 1
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
    }


}
if (isset($_POST['dergo_2'])) {
    extract($_POST);
    $kontrollo2="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto2' and date(koha_inserimit)=CURRENT_DATE and operatori='$employee_id'";
    $result_k2=$crud->getData($kontrollo2);
    foreach ($result_k2 as $key => $res2) {
        $totali2=$res2['shumatorja'];;
    }
    if($totali2<1) {
        $names = explode(" ", $employee_id); // Split the full name into an array of first and last names
        $initials = "";
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1)); // Get the first character of each name and concatenate
        }
        $uniqueId=rand ( 100000 , 999999 )."".$initials."".date("Ymdhis");

        $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto2','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto1=$crud->execute($query1);

    $query2="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto2','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto2=$crud->execute($query2);

    $query3="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto2','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto3=$crud->execute($query3);

    $query4="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto2','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto4=$crud->execute($query4);

    $query5="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto2','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto5=$crud->execute($query5);

    $query6="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto2','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto6=$crud->execute($query6);
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                <i class='mdi mdi-alert-outline me-2'></i>
        Ju keni shtuar te dhena per Foto Nr 2
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
    }

}
if (isset($_POST['dergo_3'])) {
    extract($_POST);
    $kontrollo3="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto3' and date(koha_inserimit)=CURRENT_DATE and operatori='$employee_id'";
    $result_k3=$crud->getData($kontrollo3);
    foreach ($result_k3 as $key => $res2) {
        $totali3=$res2['shumatorja'];;
    }
    if($totali3<1) {
        $names = explode(" ", $employee_id); // Split the full name into an array of first and last names
        $initials = "";
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1)); // Get the first character of each name and concatenate
        }
        $uniqueId=rand ( 100000 , 999999 )."".$initials."".date("Ymdhis");

        $query1="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto3','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto1=$crud->execute($query1);

    $query2="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto3','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto2=$crud->execute($query2);

    $query3="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto3','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto3=$crud->execute($query3);

    $query4="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto3','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto4=$crud->execute($query4);

    $query5="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto3','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto5=$crud->execute($query5);

    $query6="INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto3','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
    $shto6=$crud->execute($query6);
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                <i class='mdi mdi-alert-outline me-2'></i>
        Ju keni shtuar te dhena per Foto NR 3
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
    }

}
if (isset($_POST['dergo_4'])) {
    extract($_POST);

    $kontrollo4="SELECT count(imazhi) as shumatorja FROM `testimi` where imazhi='foto4' and date(koha_inserimit)=CURRENT_DATE and operatori='$employee_id'";
    $result_k4=$crud->getData($kontrollo4);
    foreach ($result_k4 as $key => $res2) {
        $totali4=$res2['shumatorja'];;
    }
    if($totali4<1) {
        $names = explode(" ", $employee_id); // Split the full name into an array of first and last names
        $initials = "";
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1)); // Get the first character of each name and concatenate
        }
        $uniqueId=rand ( 100000 , 999999 )."".$initials."".date("Ymdhis");
        $query1 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto4','1','Numero civico?','$numero_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
        $shto1 = $crud->execute($query1);

        $query2 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto4','2','Categoria civico?','$categoria_civico','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
        $shto2 = $crud->execute($query2);

        $query3 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto4','3','Tipo di edificio?','$tipo_di_edificio','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
        $shto3 = $crud->execute($query3);

        $query4 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto4','4','Unita residenziali?','$unita_residenziali','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
        $shto4 = $crud->execute($query4);

        $query5 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto4','5','Unita Business?','$unita_business','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
        $shto5 = $crud->execute($query5);

        $query6 = "INSERT INTO `testimi`(`imazhi`, `pyetjanr`, `pyetja`, `pergjigjia`, `operatori`, `koha_inserimit`, `id_testimit`) VALUES ('foto4','6','Nota?','$shenimi','$employee_id', CURRENT_TIMESTAMP, '$uniqueId')";
        $shto6 = $crud->execute($query6);
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show ' role='alert'>
                                                <i class='mdi mdi-alert-outline me-2'></i>
        Ju keni shtuar te dhena per Foto 4
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";

    }

}

$query_get="SELECT distinct imazhi from testimi where operatori='Alket Selimaj'";
$result=$crud->getData($query_get);

    ?>


    <style>
        img{
            height: 478px;
            width: 897px;
            border: 1px solid #212529;
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


<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->



                <div class="col-xl-12 mt-3>
                    <div class="card">
                        <div class="card card-body">


                            <!-- Nav tabs -->
                            <div class="tabview">
                            <ul class="nav nav-tabs justify-content-center" role="tablist">
                                <?php
                                for($i=1; $i<5; $i++){

                                ?>
                                <li class="nav-item">
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#pyetja<?php echo $i;?>" role="tab" aria-selected="false">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block btn btn-light  waves-effect waves-light">Foto<?php echo $i;?></span>
                                    </a>
                                </li>
                                <?php
                                }?>
                            </ul>


                            <div class="tab-content p-3 text-muted">

                                <?php
                                for($i=1; $i<5; $i++){

                                    ?>

                                    <div class="tab-pane" id="pyetja<?php echo $i;?>" role="tabpanel">
                                        <div class="row">
                                            <div class="col-xl-6 ">
                                                <img  id="54" src="imgpyetjet/pyetja<?php echo $i;?>.jpg.png" alt="" style="width:768; height: 478; "/>
                                                <a href="imgpyetjet/pyetja<?php echo $i;?>.jpg.png" class="btn btn-outline-secondary mt-3 "  target="_blank" rel="noopener"><i class="fas fa-eye mr-2"></i>Hape ne full mode
                                                </a>
                                            </div>
                                            <div class="col-xl-6">
                                    <form class="form-group mt-3" method='post' action='#pyetja<?php echo $i;?>'>

                                        <label for="question02">1. Numero civico?</label>
                                        <input type="text" class="form-control" name="numero_civico" value="" placeholder="Answer here...">

                                        <label for="question02">2. Categoria civico?</label>
                                        <input type="text" class="form-control" name="categoria_civico" value="" placeholder="Answer here..." required>

                                        <label for="question02">3. Tipo di edificio?</label>
                                        <input type="text" class="form-control" name="tipo_di_edificio" value="" placeholder="Answer here..." required>

                                        <label for="question02">4. Unita residenziali?</label>
                                        <input type="text" class="form-control" name="unita_residenziali" value="" placeholder="Answer here..." required>

                                        <label for="question02">5. Unita Business</label>
                                        <input type="text" class="form-control" name="unita_business" value="" placeholder="Answer here..." required>

                                        <label for="question02">6. Nota<?php echo $i;?></label>
                                        <input type="text" class="form-control" name="shenimi" value="" placeholder="Answer here..." required>


                                        <button name='dergo_<?php echo $i;?>' class="btn btn-primary mt-3" value="#settings" >Shto<?php echo $i;?></button>
                                    </form>
                                            </div>
                                        </div>
                                </div>
        <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <footer class="footer">

                <div class="row justify-content-center">

                        <script>document.write(new Date().getFullYear())</script> © KeyService.

                </div>

        </footer>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
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