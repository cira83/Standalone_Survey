<?php
	$nom = $_GET[elv];
	$fait = "&#9679;";
	$non_fait = "&#9675;";
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	
	$repertoire_rep = "./files/$classe/_Copies/$nom/rep";
	$liste_fichier = scandir($repertoire_rep);
	foreach($liste_fichier as $reponse) {
		if(strpos("_$reponse", "I")) {
			$part1 = explode("I", $reponse);
			$part2 = explode(".", $part1[1]);
			$nb_quest = $part2[0];
			if($nb_quest>$last_file) $last_file = $part2[0];
			$rep_ok .= "$nb_quest:";
		}
	}
	for($i=0;$i<$last_file;$i++) $bulle[$i]=$non_fait;
	$rep_donnees = explode(":", $rep_ok);
	foreach($rep_donnees as $number) 
		if($number) $bulle[$number-1]=$fait;
	
	$k = 0;
	for($i=0;$i<$last_file;$i++) {//Création de la liste de bulle
		$k++;
		$phrase .= "$bulle[$i]";
		if($k==10) {
			$k=0;
			$phrase .= "</br>";
		}
	}
	
	
	$color = "#CCC";
	if(file_exists("$repertoire_rep/sessions.txt")) $color = "black";
	if(file_exists("$repertoire_rep/infos.txt")) {
		$fp_infos = fopen("$repertoire_rep/infos.txt", "r");
		$ligne = fgets($fp_infos);
		$delta_time = time() - $ligne; //temps depuis dernière lecture en s
		if($delta_time<1620) $color = "#8d1682";//violet 27min
		if($delta_time<540) $color = "#fd0002";//rouge 9min
		if($delta_time<180) $color = "#ff8b01";//orange 3min
		if($delta_time<60) $color = "#ffed02";//jaune 1min
		if($delta_time<20) $color = "#02fe00";//vert 20s
	}
	
	
	echo("<font size=\"-1\">$phrase</font>:<font size=\"+2\" color=\"$color\">$fait</font>");	
?>