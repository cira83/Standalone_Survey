<?php
	$infos = $_GET['infos'];
	$part = explode("_", $infos);
	
	$classe = $part[0];
	$nom = $part[1];
	$reponse = $part[2];
	$tipe = $part[3];// 0=remarque
	
	
	$filename = "../Gestion/files/$classe/_Copies/$nom/rep/qs.txt";
	$information = "";
	if(file_exists($filename)) $information .= "\n";
	if($tipe==0) $information .= " Remarque : #$reponse#";
	else $information = " #$reponse#";
	$fp = fopen($filename, "a");
	fwrite($fp, $information);
	fclose($fp);
	
	$filename = "../Gestion/files/$classe/_Copies/$nom/rep/RQ.txt";
	$fp = fopen($filename, "w");
	fwrite($fp, $reponse);
	fclose($fp);	

?>