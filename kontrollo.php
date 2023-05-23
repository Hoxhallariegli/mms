<?php
include_once('ini.php');
include_once("shto_function.php");
$crud = new Crud();
?>
<div class="input-group date">

    <form action="" method="POST" class="formafundit">
        <td>
            <input type="date" name="dataz" class="datedate" value="<?php echo date('Y-m-d'); ?>" />

            <input type="submit" name="submitdt" value="Shiko" style="margin-left: 30px;">

        </td>
    </form>
</div>

<?php
if (isset($_POST['submitdt'])) {
extract($_POST);
echo $dataz;
$date = explode('-', $dataz);
$y = $date[0];
$m   = $date[1];
$d  = $date[2];


$log_directory = 'V:\CONS\_____CONSEGNE_TOTAL_GMW_'.$d.'.'.$m.'.'.$y;

$results_array = array();

if (is_dir($log_directory))
{
    if ($handle = opendir($log_directory)){
        //Notice the parentheses I added:
        while(($file = readdir($handle)) !== FALSE){
            $results_array[] = $file;
        }
        closedir($handle);
    }
}

//Output findings

$i=1;
?>
<table class="table table-bordered" id="thetable_1">
    <thead class="header_tab">
    <?php




    $query = "select `FOLDER`, `OP.PLG` from `consegne` where `DATA FINE1` ='$dataz' order by `FOLDER`";
    $result = $crud->getData($query);
    ?>
    <h4>Kontrolli i puneve sipas db dhe folderaves</h4>
    <table class="table table-bordered"id="thetable_1">
        <body onload="alternate('thetable_1')">
        <thead class="header_tab">
        <tr>
            <th>Nr.</th>
            <th>OPERATORI</th>
            <th>Punet e perfunduara nga db</th>
            <th>Punet e perfunduara nga folder</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        $j=2;
        foreach ($result as $key => $res) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $res['OP.PLG']; ?></td>
                <td><?php echo $res['FOLDER']; ?></td>
                <td>
                    <?php
                    echo $results_array[$j];
                    $j++;
                    echo $j;
                    ?>

                </td>


            </tr>
        <?php } ?>
        </tbody>

    </table>


    <?php } ?>
