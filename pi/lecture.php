<?php
	$fp = fopen("../Gestion/files/_Sujet_Ouvert.txt", "r");
	$ligne = fgets($fp);
	fclose($fp);
	

	function ping() {
		$output = shell_exec('ping -c 1 8.8.8.8');
		$part_ping1 = explode("time=",$output);
		$part_ping2 = explode(" ",$part_ping1[1]);
		return($part_ping2[0]);		
	}

	function my_in_array($mot,$tableau){
		$k = 0;
		foreach($tableau as $valeur) 
			if(strpos("_$valeur", $mot)) $k++;
		return $k;
	}
	
	$part = explode(":", $ligne);//CIRA2:Ayza:TP12:
	$classe = $part[0];
	$repertoire_documents = "../Gestion/files/$classe/_Copies";
	if(file_exists($repertoire_documents)) $liste_dossiers = scandir($repertoire_documents);
	else $liste_dossiers = 0;
	$liste_actif = "";
	$liste_tempo = "";
	$liste_rep = "";
	$file_info = "";
	$TP = "";
	$nb_actif = 0;
	$liste_question = "";
	if($liste_dossiers) {
		foreach($liste_dossiers as $nom) {
			$file_info = "$repertoire_documents/$nom/rep/infos.txt";
			if(file_exists($file_info)) {
				$fp = fopen($file_info, "r");
				$tempo = time()-fgets($fp);
				fclose($fp);
				
				$liste_tempo .= "$tempo:";
				$liste_actif .= "$nom:";
				$nb_actif++;
				$sujet = "$repertoire_documents/$nom/rep/index.htm";
				if(file_exists($sujet)) {
					$fp = fopen($sujet, "r");
					$ligne1 = explode("#",fgets($fp));
					fclose($fp);
					$TP .= "$ligne1[1]:";					
				}
				else $TP .= ":";
				$on_file = "$repertoire_documents/$nom/rep/on.txt";
				if(file_exists($on_file)) {
					$fp = fopen($on_file, "r");
					$code4 = fgets($fp);
					fclose($fp);
					$dossier_rep = "$repertoire_documents/$nom/rep/$code4";	
					if(file_exists($dossier_rep)) $listerep = preg_grep("/I(\w+)/", scandir($dossier_rep)) ;
				}
				else $listerep[0]=0;
				$number = intval(count($listerep))-2;
				$number = my_in_array("txt",$listerep);
				$liste_rep .= "$number:";
				
				$question = "";
				$nb_ligne = 0;
				$question_file = "$repertoire_documents/$nom/rep/qs.txt";
				if(file_exists($question_file)){
					$fp = fopen($question_file, "r");
					while(!feof($fp)) {
						 $ligne = fgets($fp);
						 $nb_ligne=1-$nb_ligne;
					}
					fclose($fp);
					$part = explode("#", $ligne);
					if($nb_ligne) $question = $part[0];
				}
				$liste_question.="$question:";
			}
		}
	}
	
	$ping = ping();
	
	$information = "$liste_actif#$liste_tempo#$liste_rep#$nb_actif#$classe#$TP#$file_info#$liste_question#$ping#";
	echo("$information");
?>