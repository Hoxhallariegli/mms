<?php
include 'db.php';
if(isset($_GET['fushatat'])){
	$fushata= $_GET['fushatat'];
	$Communa= $_GET['Communa'];
}
if(isset($_POST["Import"])){
	$result = mysqli_query($conn, "SELECT * FROM fushatat WHERE fushata_id='$fushata'");
	$num_rows = mysqli_num_rows($result);
	if($num_rows<1){
		$sql1="INSERT into fushatat(fushata_id, fushata,Communa) VALUES('$fushata','$fushata','$Communa')";
	    $result1 = mysqli_query( $conn, $sql1);
	}

		echo $filename=$_FILES["file"]["tmp_name"];
 
 		$row = 1;
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE)
	         {
				 if($row == 1){ $row++; continue;
				 }
 
	          //It wiil insert a row to our subject table from our csv file`
				 $emapData[2]= mysqli_real_escape_string($conn, $emapData[2]);
	           $sql = "INSERT INTO `details_strade`(`OBJECTID`, `id_civico`, `indirizzo`, `id_building`, `address_number`, `type`, `id_egon_civico`, `tipologia_uscita`, `lat`, `lng`, `type_edificio`, `nome_scala`, `numero_piani_edificio`, `totale_ui`, `ui_residential`, `ui_business`, `accumulo`, `note`, `OPERATORE`, `fushata`, `Communa`) VALUES ('$emapData[0]', '$emapData[1]', '$emapData[2]', '$emapData[3]', '$emapData[4]', '$emapData[5]', '$emapData[6]', '$emapData[7]', '$emapData[8]', '$emapData[9]','$emapData[10]', '$emapData[11]', '$emapData[12]', '$emapData[13]', '$emapData[14]', '$emapData[15]', '$emapData[16]', '$emapData[17]', '$emapData[18]', '$fushata', '$Communa')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysqli_query( $conn, $sql );




				if(! $result ){
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";
 
				}else{
					$update="UPDATE `details_strade` SET `f_id`=CONCAT(`indirizzo`,`fushata`)";
					$result = mysqli_query( $conn, $update);
				}
 
	         }
			 $insert_="INSERT INTO hartat(folder, civici, fushata, Fascia, Communa) select indirizzo, count(indirizzo), fushata, 'A', Communa from details_strade where fushata='$fushata' group by indirizzo";
			 $result1= mysqli_query( $conn, $insert_ );

			 
			 fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
 
 
 
			 //close of connection
			 
			mysqli_close($conn); 
 
 
 
		 }
	}	 
?>
