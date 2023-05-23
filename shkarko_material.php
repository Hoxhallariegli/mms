<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "refresh_1";
//mysql and db connection
if(isset($_GET['fushatat'])){
  $fushata= $_GET['fushatat'];
}

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {  //error check
    die("Connection failed: " . $con->connect_error);
}
else
{

}

$timestamp = strtotime('1st January 2004');
$DB_TBLName = "hartat"; 
$filename = "excelfilename";  //your_file_name
$file_ending = "xls";   //file_extention

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.'.'.$file_ending");  
header("Pragma: no-cache"); 
header("Expires: 0");

$sep = "\t";

$sql="select IFNULL(folder, '') as folder, IFNULL(operatore, '') as operatore, IFNULL(data_inizio, '') as data_inizio, IFNULL(data_fine, '') as data_fine, IFNULL(koment, '') as koment,IFNULL(Fascia, '') as Fascia  from $DB_TBLName WHERE fushata='$fushata'"; 
$resultt = $con->query($sql);
while ($property = mysqli_fetch_field($resultt)) { //fetch table field name
    echo $property->name."\t";
}

print("\n");    

while($row = mysqli_fetch_row($resultt))  //fetch_table_data
{
    $schema_insert = "";
    for($j=0; $j< mysqli_num_fields($resultt);$j++)
    {
        if(!isset($row[$j]))
            $schema_insert .= "NULL".$sep;
        elseif ($row[$j] != "")
            $schema_insert .= "$row[$j]".$sep;
        else
            $schema_insert .= "".$sep;
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}
?>