<?php
include 'db.php';
if(isset($_POST["Import_2"])){
    $fshi1 = "DELETE from panoramica";
    //we are using mysql_query function. it returns a resource on true else False on error
    $result = mysqli_query( $conn, $fshi1 );

    $fshi2 = "DELETE from PAN2";
    //we are using mysql_query function. it returns a resource on true else False on error
    $result = mysqli_query( $conn, $fshi2 );

     $filename1=$_FILES["file1"]["tmp_name"];
    $filename2=$_FILES["file2"]["tmp_name"];
   // echo $filename=$_FILES["file2"]["tmp_name"];
    $row = 2;
    if ($_FILES["file1"]["size"] > 0) {
        $file1 = fopen($filename1, "r");

        while (($emapData = fgetcsv($file1, 1000000, ",")) !== FALSE) {
            if ($row == 2) {
                $row++;
                continue;
            }

            $emapData[1]=mysqli_real_escape_string($conn,$emapData[1]);

            $sql = "INSERT INTO `panoramica`(`egon`, `via`, `numero_civico`, `km`, `stato`, `esistente`, `rilegatura`, `categoria civico`, `unita residenziali`, `unita business`, `struttura`, `tipo di edificio`, `nome edificio`, `numero piani`, `access point: proprietario`, `access point: sede di posa`, `access point: note`, `delivery point: proprietario`, `delivery point: sede di posa`, `delivery point: note`, `amministratore: recapito`, `amministratore: nome/studio`, `amministratore: email`, `amministratore: telefono`, `amministratore: Ã¨ proprietario`, `note`)
                    VALUES ('$emapData[0]', '$emapData[1]', '$emapData[2]', '$emapData[3]', '$emapData[4]', '$emapData[5]', '$emapData[6]', '$emapData[7]', '$emapData[8]', '$emapData[9]','$emapData[10]', '$emapData[11]', '$emapData[12]', '$emapData[13]', '$emapData[14]', '$emapData[15]', '$emapData[16]', '$emapData[17]', '$emapData[18]', '$emapData[19]', '$emapData[20]', '$emapData[21]', '$emapData[22]', '$emapData[23]', '$emapData[24]', '$emapData[25]')";
            //we are using mysql_query function. it returns a resource on true else False on error
            $result = mysqli_query( $conn, $sql );

        }
        fclose($file1);

    }
    if ($_FILES["file2"]["size"] > 0) {
        $file2 = fopen($filename2, "r");

        while (($emapData = fgetcsv($file2, 1000000, ",")) !== FALSE) {
            if ($row == 2) {
                $row++;
                continue;
            }

            $emapData[5]=mysqli_real_escape_string($conn,$emapData[5]);
            $sql2 = "INSERT INTO `pan2`(`des_codice_egon_civico`, `des_regione`, `des_provincia`, `des_comune`, `des_particella_top`, `des_indirizzo`, `des_address_number`, `NOTE`, `EMRI`, `num_lat`, `des_lng`)
                                VALUES ('$emapData[0]', '$emapData[1]', '$emapData[2]', '$emapData[3]', '$emapData[4]', '$emapData[5]', '$emapData[6]', '$emapData[7]', '$emapData[8]', '$emapData[9]','$emapData[10]')";
            //we are using mysql_query function. it returns a resource on true else False on error
            $result2 = mysqli_query( $conn, $sql2 );

            if(! $result2 ){
                echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";

            }else{
                echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"exceltpphpcode.php\"
						</script>";
            }

        }
        fclose($file2);

    }




}
?>
