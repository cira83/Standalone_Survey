<?php
	$nom = $_COOKIE['nom'];
	$classe = $_COOKIE['laclasse'];
	$question = $_GET['question'];
	$filename = "./files/$classe/_Copies/$nom/rep/qs.txt";
	
	if(file_exists($filename)) {
		$fp = fopen($filename, "a");
		fwrite($fp, "\n$question#");
		fclose($fp);	
	}
	else {
		$fp = fopen($filename, "w");
		fwrite($fp, "$question#");
		fclose($fp);		
	}

?>