<?php
	$nom = $_COOKIE['nom'];
	$classe = $_COOKIE['laclasse'];
	$repertoire = "./files/$classe/_Copies/$nom/rep";
	$ligne1 = "";
	
	if(file_exists("$repertoire/qs.txt")){
		$fp = fopen("$repertoire/qs.txt", "r");
		$nb_ligne = 0;
		$ligne1 = "";
		while(!feof($fp)) {
			$ligne1 = fgets($fp);
		}
		fclose($fp);	
	}
	else $ligne1 = "##";//pas de fichier
	
	$ligne3 = "";
	if(file_exists("$repertoire/RQ.txt")){
		$fp = fopen("$repertoire/RQ.txt", "r");
		while(!feof($fp)) {
			$ligne3 = fgets($fp);
		}
		fclose($fp);
		unlink("$repertoire/RQ.txt");
	}	
	
	echo("$ligne1$ligne3");
?>