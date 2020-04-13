<?php
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe="CIRA1";
	
	$separation = "$";
	$fait = "&#9679;";
	$non_fait = "&#9675;";

	function bulle($acteur,$paroles){
		$bulle = "<div class=\"bulles\">";
		$bulle .= "<b>$acteur</b><br>";
		$bulle .= "$paroles";

		$bulle .= "</div>";
		echo($bulle);
	}

	$filename = "./files/$classe/_chat.txt";
	$repertoire = "./files/$classe/_Copies/";
	$liste_eleve = scandir($repertoire);
	
	
	$fp = fopen($filename,"w");
	$i=0;
	foreach($liste_eleve as $eleve) {
		$maj = ord($eleve);
		if(($maj>64)&($maj<91)) {
			$repertoire_elv = "$repertoire/$eleve/rep";
			$liste_fichier = scandir($repertoire_elv);
			$rep_ok = "";
			$last_file = 0;
			foreach($liste_fichier as $reponse) {
				if(strpos("_$reponse", "I")) {
					$part1 = explode("I", $reponse);
					$part2 = explode(".", $part1[1]);
					$nb_quest = $part2[0];
					if($nb_quest>$last_file) $last_file = $part2[0];
					$rep_ok .= "$nb_quest:";
				}
			}
			$filename_sujet = "$repertoire/$eleve/index.htm";//le sujet
			if(file_exists($filename_sujet)){
				$fp_td = fopen($filename_sujet, "r");
				$ligne1 = fgets($fp_td);
				$td_number = explode("#", $ligne1);
				$le_nom_du_td = rtrim($td_number[1]);
				fclose($fp_td);
			}
			$liste2nombre = explode(":", $rep_ok);//liste des réponses disponibles
			for($ii=0;$ii<$last_file;$ii++) $case_quest[$ii]=$non_fait;
			foreach($liste2nombre as $nombre) $case_quest[$nombre-1]=$fait;
			$ligne2led = "";
			$kkdoit = 0;
			for($ii=0;$ii<$last_file;$ii++) {
				$title_id = $ii+1; 
				$ligne2led.="<span title=\"$title_id\">$case_quest[$ii]</span>";
				$kkdoit++;
				if($kkdoit==10) {
					$kkdoit = 0;
					$ligne2led.="<br>";
				}
			}
			
			if($last_file) {//ecriture du fichier
				if($i==0) fprintf($fp, "$eleve $le_nom_du_td$separation $ligne2led");
				else fprintf($fp, "\n$eleve $le_nom_du_td$separation $ligne2led");
				$i++;
			}
			
		}
	}
	fclose($fp);
	
	
	//Lecture du fichier et création des bulles
	$fp = fopen($filename,"r");
	$nb2copies = 0;
	//$ligne = fgets($fp);
	while(!feof($fp)){
		$ligne = fgets($fp);
		if($ligne) {
			$part = explode($separation, $ligne);
			bulle($part[0],$part[1]);
			$nb2copies++;
		}
	}
	bulle("$nb2copies copies","");
	fclose($fp);
?>
