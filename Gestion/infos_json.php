<?php
	$nom = $_GET['nom'];
	$classe = $_COOKIE['laclasse'];
	$filename = "./files/$classe/_JSON/$nom.json";
	if(file_exists($filename)){
		$fp = fopen($filename, "r");
		while(!feof($fp)) {
			$ligne = fgets($fp);
			echo($ligne);
		}
	}
	else {
		echo("{\"nom\":\"not_found\"}");
	}
?>