<?php
// Sample arrays

?>
<?php
//including the database connection file

include_once('ini.php');
include('includes/header1.php');
include_once("shto_function.php");

if ($_SESSION["Ferid"]) {
    $crud = new Crud();
    $validation = new Validation();
    $employee_id = $_SESSION['Ferid'];
    $level = $_SESSION['Access'];
    $part1=array();
    $part2=array();
    ?>
    <form class="form-horizontal well" action="add_part1.php" method="post" name="upload_excel" enctype="multipart/form-data">
        <fieldset>
            <legend>Import CSV/Excel file</legend>
            <div class="control-group">
                <div class="control-label">
                    <label>CSV/Excel File:</label>
                </div>
                <div class="controls">
                    <input type="file" name="file1" id="file" class="form-control">
                </div>
            </div>
            <div class="control-group">
                <div class="control-label">
                    <label>CSV/Excel File:</label>
                </div>
                <div class="controls">
                    <input type="file" name="file2" id="file" class="form-control">
                </div>
            </div>


            <div class="control-group mt-3">
                <div class="controls text-center">
                    <button type="submit" id="submit" name="Import_2" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                </div>
            </div>
        </fieldset>
    </form>
    <?php
    $rruga1="select concat(via,'_',numero_civico) as pjesa1 from panoramica";
    $result = $crud->getData($rruga1);
    foreach ($result as $key=>$res){
        $part1[]=$res['pjesa1'];
    }
    $rruga2="select concat(des_indirizzo, '_',des_address_number) as pjesa2 from pan2";
    $result2 = $crud->getData($rruga2);
    foreach ($result2 as $key=>$res){
        $part2[]=$res['pjesa2'];
    }
    $difference = array_diff($part1,$part2);
    $difference1 = array_diff($part2,$part1);
    $listaTotale = array_unique(array_merge($part1,$part2));
    sort($listaTotale);

    $array1 = $difference;
    $array2 = $difference1;

// Determine the maximum count between the two arrays
    $maxCount = max(count($array1), count($array2));


    for ($i = 0; $i < $maxCount; $i++) {
        echo $array1[$i];
    }




}

