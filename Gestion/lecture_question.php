<?php
	$nom = $_COOKIE['nom'];
	$classe = $_COOKIE['laclasse'];
	$repertoire = "./files/$classe/_Copies/$nom/rep";
	$nb_ligne = 0;
	$ligne1 = "";
	$ligne2 = "";
	
	if(file_exists("$repertoire/qs.txt")){
		$fp = fopen("$repertoire/qs.txt", "r");
		$nb_ligne = 0;
		$ligne1 = "";
		while(!feof($fp)) {
			$ligne2 = $ligne1;
			$ligne1 = fgets($fp);
			$nb_ligne=1-$nb_ligne;
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
	
	if($nb_ligne) echo("$ligne1$ligne3");
	else echo("$ligne2$ligne1$ligne3");
?>