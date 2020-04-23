<?php
	$classe = $_COOKIE['laclasse'];
	$reponse = $_GET['lareponse'];
	$nom = $_GET['lenom'];
	
	$filename = "../Gestion/files/$classe/_Copies/$nom/rep/qs.txt";
	
	if(file_exists($filename)) {
		$fp = fopen($filename, "a");
		fwrite($fp, "\n$reponse#");
		fclose($fp);	
	}
?>