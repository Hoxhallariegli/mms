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