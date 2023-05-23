<?PHP

function checkWork($res,$f,$d,$m,$y){
	if($d<10){
	$query="SELECT COUNT(`data_fine`) as data_fine from `hartat` WHERE `data_fine`='$y-$m-0$d' AND fushata='$f'";
	}else{
		$query="SELECT COUNT(`data_fine`) as data_fine from `hartat` WHERE `data_fine`='$y-$m-$d' AND fushata='$f'";
	}
	$result=$res->getData($query);

	foreach ($result as $key => $res) { 
          $numri3=$res['data_fine'];
	}
	return $numri3;

}


