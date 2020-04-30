<?php
	$remarque = $_GET['remarque'];
	$nom = $_GET['lenom'];
	$classe = $_COOKIE['laclasse'];
	
	$filename = "../Gestion/files/$classe/_Copies/$nom/rep/RQ.txt";
	
	$fp = fopen($filename, "w");
	fwrite($fp, "$remarque");
	fclose($fp);	
?>