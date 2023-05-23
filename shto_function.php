<?php

function shtoHartat ($res, $kodi,$fushata){
	$kodi=$res->escape_string($kodi);
	$data=date("Y-m-d");
	$gjatesia_teksit=strlen($kodi);
	if($gjatesia_teksit>5){
		$update= $res -> execute("UPDATE `hartat` SET `data_fine`='$data', `status`='FINITO', `KOMENT`='FINITO' where `FOLDER` = '$kodi' AND fushata='$fushata'");
		
	}else{
		echo "Dicka shkoi keq";
	}
}
function gjejFascia($res,$fushata){
	$query="select `Fascia` as Kodi, COUNT(IF((`data_inizio`='0000-00-00' or`data_inizio` is null),1,null)) AS paperfunduara from hartat WHERE `fushata`='$fushata' group by Kodi HAVING (paperfunduara) > 0 Order by Fascia LIMIT 1";
	
	$result=$res->getData($query);
	foreach ($result as $key => $res1) { 
          $vlera=$res1['Kodi'];	  
	}
	
	if(empty($vlera)){
		echo "Ska harta te lira/ Kane perfunduar";
	}else{
		return $vlera;
	}
}
function jepPrioritet ($res, $kodi,$fushata){
	$kodi=$res->escape_string($kodi);
	$update=$res->execute("UPDATE `hartat` SET `priority`='SI' where `folder`='$kodi' AND fushata='$fushata'");
}

function ndryshoFasciat1 ($res, $fushata, $Fascia, $fascia_re){
	$update1 = $res->execute("UPDATE `hartat` SET `Fascia`='$fascia_re' WHERE `Fascia`='$Fascia' AND `fushata`='$fushata'");
}

function hiqHartenNgaOperatori ($res, $kodi, $operatori, $fushata,$st_h){
	$update1 = $res->execute("UPDATE `hartat` SET `data_inizio`='', `operatore`='',`koment`='' WHERE `folder`='$kodi' AND fushata='$fushata' AND (operatore='$operatori' OR operatore = '')");

	echo $operatori;
	$statusi=statusiHartes($res,$kodi, $operatori, $fushata);
	echo $st_h;


	if($st_h=='neproces' or $st_h=='nderprere') {
		$update4 = $res->execute("UPDATE `koha_punes` SET `mbarimi`=CURRENT_TIMESTAMP, `veprimi_permbylles`='kthyer', `koha`=TIMEDIFF(CURRENT_TIMESTAMP,`fillimi`) WHERE `folder`='$kodi' AND `operatori`='$operatori' AND `fushata`='$fushata' AND `mbarimi` IS NULL");
	}else{
		$query2=("select `hapi` FROM `koha_punes` where `folder`='$kodi' AND `operatori`='$operatori' AND `fushata`='$fushata' ORDER BY `hapi` DESC limit 1");
		$result2=$res->getData($query2);
		foreach ($result2 as $key => $res2) {

			$hapi=preg_replace("/[^0-9]/", "", $res2['hapi'] );
			echo $hapi;
			if($hapi===true){
				$hapi++;
				$hapi="step".$hapi;
				echo $hapi;
			}else{
				$hapi='step0';
				echo $hapi;
			}


		}


		$shto= $res->execute("INSERT INTO `koha_punes` (`folder`, `fushata`, `operatori`,`hapi`, `fillimi`,`mbarimi`,`koha`,`veprimi_permbylles`) VALUES ('$kodi','$fushata','$operatori','$hapi',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,0,'kthyer')");
	}
	}
function perfundoPunen ($res, $kodi, $operatori,$fushata,$rruget,$shenimi){
	$kodi=$res->escape_string($kodi);
	$data=date("Y-m-d");
	$gjatesia_teksit=strlen($kodi);
	if($gjatesia_teksit>1){
		$update= $res -> execute("UPDATE `hartat` SET `data_fine`='$data', `operatore`='$operatori', `koment`='perfunduar' , `civici_operatore`='$rruget', `shenimi`='$shenimi' where `folder` = '$kodi' AND fushata='$fushata'");
		$updat1= $res -> execute("UPDATE `details_strade` SET `OPERATORE`='$operatori' WHERE `indirizzo`='$kodi' AND `fushata`='$fushata'");
		perfundoKohen($res,$kodi,$fushata,$operatori);
	}else{
		echo "Dicka shkoi keq";
	}
}

function perditesoCivici($res, $kodi, $rruga){
	$update=$res->execute("UPDATE `hartat` SET `civici_operatore`='$rruga' WHERE `folder`='$kodi'");
}

function updateLavoro($res, $kodi, $operatori,$fushata){
	$data=date("Y-m-d");
	$kodi=$res->escape_string($kodi);
	$query1="SELECT IF(`operatore` IS NULL or `operatore` = '', '',`operatore`) AS `operatore` FROM hartat WHERE `folder` = '$kodi' and fushata='$fushata'";
	$result1=$res->getData($query1);

	foreach ($result1 as $key => $res1) { 
          $operatore_=$res1['operatore'];
	}
	$nr_hartave=perllogaritHartaAktive($res,$operatori,$fushata);
	if($operatore_==='' && $nr_hartave<1){
		$update1 = $res->execute("UPDATE `hartat` SET `data_inizio`='$data', `operatore`='$operatori', `koment`='neproces'  where fushata='$fushata' AND `folder` = '$kodi' AND (`operatore` ='' or `operatore` is null)");
		matKohen($res,$kodi,$fushata, $operatori);
	}else{
		echo "Kete harte e ka mare ".$operatore_;
	}
}


function prenderelogs($res,$kodi,$operatori,$veprimi){

	$shto= $res->execute("INSERT INTO `prendere_logs` (`username`, `data_ora`, `folder`, `veprimi`) VALUES ('$operatori',current_date(),'$kodi','$veprimi')");
}



function nderpritPunen ($res, $kodi, $operatori,$fushata,$shenimi){
	$kodi=$res->escape_string($kodi);
	$update1 = $res->execute("UPDATE `hartat` SET `koment`='nderprere', `shenimi`='$shenimi' WHERE `folder`='$kodi' AND fushata='$fushata'");
	nderpritKohen($res,$kodi,$operatori,$fushata);
}


function rimerrPunen ($res, $kodi, $operatori,$fushata){
	$kodi=$res->escape_string($kodi);
          $numri=perllogaritHartaAktive($res,$operatori,$fushata);
	if($numri< 1){
		$update1 = $res->execute("UPDATE `hartat` SET `koment`='neproces' WHERE `folder`='$kodi' and fushata='$fushata'");
		rimerPunenKoha($res, $kodi, $operatori,$fushata);
	}else{
		echo "Ju keni nje pune tjeter aktive";
	}
}


function statusiHartes ($res, $kodi, $operatori,$fushata){
	$kodi=$res->escape_string($kodi);
	$query="select `koment` from `hartat` where `folder` = '$kodi' and fushata='$fushata'";
	$result=$res->getData($query);
	foreach ($result as $key => $res) { 
          $vlera=$res['koment'];	  
	}
	return $vlera;
}


function perllogaritHartaAktive($res,$operatori,$fushata){
	$query2="select count(CASE WHEN(data_inizio !='' AND data_inizio IS NOT NULL AND data_inizio !='0000-00-00') AND (data_fine ='' or data_fine IS NULL or data_Fine ='0000-00-00') THEN 1 END) as `punet` from `hartat` where `operatore` = '$operatori' and `koment`='neproces' and `fushata`='$fushata'";
	$result2=$res->getData($query2);
	
	foreach ($result2 as $key => $res2) { 
          $numri=$res2['punet'];
	}
	return $numri;
}

function modifikodb_1($res,$kodi){
	$query="SELECT `FOLDER`, `DATA INIZIO1`, `DATA FINE1`, `OP.PLG`, KOMENT FROM consegne WHERE `FOLDER`='$kodi'";
	$result=$res->getData($query);
	if($result == TRUE){
		
		foreach ($result as $key => $res1) { 
				$DATAFINE1=$res1['DATA FINE1'];
				$OPPLG=$res1['OP.PLG'];

				if($DATAFINE1!='0000-00-00' && $OPPLG !=''){
						$Update1 = $res->execute("UPDATE `consegne` SET `KOMENT`='perfunduar' WHERE `FOLDER`='$kodi'");
					}else if($DATAFINE1='0000-00-00'&& $OPPLG !=''){
						$Update1 = $res->execute("UPDATE `consegne` SET `KOMENT`='neproces' WHERE `FOLDER`='$kodi'");
					}else{
						$Update1 = $res->execute("UPDATE `consegne` SET `KOMENT`='' WHERE `FOLDER`='$kodi'");
					}

			}
	}else{
		echo 'Query Gabim.';
	}

}
function matKohen($res,$folder,$fushata, $employee_id){
	$shto= $res->execute("INSERT INTO `koha_punes` (`folder`, `fushata`, `operatori`,`hapi`, `fillimi`) VALUES ('$folder','$fushata','$employee_id','step1',CURRENT_TIMESTAMP)");
}

function perfundoKohen($res,$folder,$fushata,$employe_id){
	$update4= $res->execute("UPDATE `koha_punes` SET `mbarimi`=CURRENT_TIMESTAMP, `veprimi_permbylles`='perfunduar', `koha`=TIMEDIFF(CURRENT_TIMESTAMP,`fillimi`) WHERE `folder`='$folder' AND `operatori`='$employe_id' AND `fushata`='$fushata' AND `mbarimi` IS NULL");
}
function nderpritKohen($res,$folder,$employee_id,$fushata){
	$update4= $res->execute("UPDATE `koha_punes` SET `mbarimi`=CURRENT_TIMESTAMP, `veprimi_permbylles`='nderprere', `koha`=TIMEDIFF(CURRENT_TIMESTAMP,`fillimi`) WHERE `folder`='$folder' AND `operatori`='$employee_id' AND `fushata`='$fushata' AND `mbarimi` IS NULL");


}

function rimerPunenKoha ($res, $folder, $employee_id,$fushata){
	$folder=$res->escape_string($folder);
	$query2=("select `hapi` FROM `koha_punes` where `folder`='$folder' AND `operatori`='$employee_id' AND `fushata`='$fushata' ORDER BY `hapi` DESC limit 1");
	$result2=$res->getData($query2);
	foreach ($result2 as $key => $res2) {
		$hapi=preg_replace("/[^0-9]/", "", $res2['hapi'] );

	}
	echo $hapi;
	$hapi++;
	$hapi="step".$hapi;
	$shto= $res->execute("INSERT INTO `koha_punes` (`folder`, `fushata`, `operatori`,`hapi`, `fillimi`) VALUES ('$folder','$fushata','$employee_id','$hapi',CURRENT_TIMESTAMP)");
}

function dita_par_e_fundit($week, $year)
{
	$time = strtotime("1 January $year", time());
	$day = date('w', $time);
	$time += ((7*$week)+1-$day)*24*3600;
	$dates[0] = date('Y/n/j', $time);
	$time += 6*24*3600;
	$dates[1] = date('Y/n/j', $time);
	return $dates;
}

?>
