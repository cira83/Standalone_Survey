<?php
	$matieres = $_GET['mat'];
	$titre_page = "$matieres";
	include("./haut.php");
	$casetab = array_fill(0, 500, 0);

	tableau("$accueil$classe</a>");
	$fontclasse = "<font color=\"green\">";
	$lastligne = "<tr><td>$fontclasse CLASSE</font></td>";//modification d'octobre 2017

	$classe_sum7[0] = 0;
	$classe_nb7[0] = 0;

	$matieres = $_GET['mat'];
	tableau($matieres);
	
	//Définition de la première colonne du tableau
	$nbdelignetab = count($leleve)+1;
	$casetab[0]="...";
	for($j=0;$j<$nbdelignetab-1;$j++) $casetab[$j+1]="<a href=\"./eleve.php?nom=$leleve[$j]\">$leleve[$j]</a>";
	
	//LISTE DES EPREUVES
	$repertoire = "./files/$classe/$matieres";
	$epreuves = scandir($repertoire);
	sort($epreuves);
	$j=0;
	$k=0;
	while ( $j < count($epreuves)){
		if(estfichier($epreuves[$j])) {
			$fifi = explode(".", $epreuves[$j]);
			$casetab[($k+2)*$nbdelignetab] = "<a href=\"./epreuve.php?mat=$matieres&epr=$epreuves[$j]\">$fifi[0]</a>";
			$epr[$k] = $fifi[0];
			$k++;
		}
		$j++;
	}
	$nbdepreuves = $k;
	
	//Gestion des notes
	for($j=0;$j<count($leleve);$j++){
		$somme_coef[$j]=0;
		$somme_note[$j]=0;
	}
	
	for($k=0;$k<$nbdepreuves;$k++) {
		//On efface les notes de la colonne précédente - octobre 2017
		$classe_sum7[$k] = 0;
		$classe_nb7[$k] = 0;
		for($j=0;$j<count($leleve);$j++) $note[$j]="";
		
		$fichier = $files."$classe/$matieres/$epr[$k].txt"; //affiche($fichier);
		$fp = fopen($fichier,"r");
		while (!feof($fp)){
			$ligne = fgets($fp);
			$data = explode(":", $ligne);
			$nom = $data[0];
			$note1 = $data[1];
			$coef1 = $data[2]; if($coef1=="") $coef1=1;
			for($j=0;$j<count($leleve);$j++) {//On ne considère que la dernière ligne
				if(dansgroupe($nom,$leleve[$j])) {
					$note[$j]=$note1;
					$coef[$j]=$coef1;
					if($data[3]=="Non Fait") $coef[$j]=0;
				}
			}
		}
		
		//###
		//Actualisation des notes et coefficients
		for($j=0;$j<count($leleve);$j++) {
			$somme_note[$j]=$somme_note[$j]+ floatval($coef[$j])*floatval($note[$j]);
			if(($note[$j]!="")&&(($note[$j]!="Nnot"))) {
				$somme_coef[$j]=$somme_coef[$j]+$coef[$j];
				$notej = isset($note[$j])?$note[$j]:0;
				 
				$classe_sum7[$k] += $notej; //Somme des notes dans l'épreuve
				$classe_nb7[$k] += 1; //Nombre de notes à l'épreuve
			}
			
			$puce = lescopies2($leleve[$j],$classe,$epr[$k],$repertoire_copies);
			$casetab[($k+2)*$nbdelignetab+$j+1]="$puce $note[$j] ($coef[$j])";
		}
		
	}
	//Calcul de la moyenne de la classe dans l'épreuve
	for($k=0;$k<$nbdepreuves;$k++) {
		if($classe_nb7[$k]>0) $classe_moy_ep[$k] = beau_nombre($classe_sum7[$k]/$classe_nb7[$k]);
		else $classe_moy_ep[$k] = "-";
	}
	
	
	//Calcul de la moyenne de la classe dans la matière
	$n=0;
	$moyenne_classe = 0;
	$somme_classe = 0;
	$casetab[$nbdelignetab] = "Moy.";
	for($j=0;$j<count($leleve);$j++) {
		if($somme_coef[$j]>0) {
			$moyenne_elv = $somme_note[$j]/$somme_coef[$j];
			$moyenne_elv_txt = beau_nombre($moyenne_elv);
			$casetab[$nbdelignetab+$j+1]="$moyenne_elv_txt ($somme_coef[$j])";
			$lesnoms14[$n]= $leleve[$j];
			$lesmoyennes[$n]=$moyenne_elv_txt;$n++;
			$somme_classe += $moyenne_elv; 
		}
	}
	if($n>0) {
		 $moyenne_delaclasse = beau_nombre($somme_classe/$n); 
		 
		 $moyenne_delaclassetext = "<p>Moyenne de la classe : $moyenne_delaclasse ($n)</p>";
	}
	else {
		 $moyenne_delaclasse = "";
		 $moyenne_delaclassetext = "-";
	}
	
	//CONSTRUCTION LE TABLEAU
	if($nbdepreuves>5) $tableau = "<table class=\"C100\">";
	else $tableau = "<table>";
	for($j=0;$j<$nbdelignetab;$j++){
		$tableau .= "\n<tr>";
		for($k=0;$k<$nbdepreuves+3;$k++){
			$tableau .= "<td>".$casetab[$j+$k*$nbdelignetab]."</td>";
		}
		$tableau .= "</tr>";
	}
	$lastligne.="<td>$fontclasse$moyenne_delaclasse</td>";
	for($k=0;$k<$nbdepreuves;$k++){
		$lastligne.="<td>$fontclasse $classe_moy_ep[$k] </td>";
	}
	
	$tableau .= $lastligne;//Moyennes de la classe
	$tableau .= "</table>";	
	
	echo($tableau);
	echo($moyenne_delaclassetext);	
	
	$texte_notes = liste2texte($lesmoyennes);
	$texte_noms = liste2texte($lesnoms14);
	$filesave = "./files/$classe/_$matieres.txt";
	$image = "<a href=\"./geo.php?nomfichier=$filesave\">";
	
	//mars 2018
	$savefileicon = "<a href=\"exportxls.php?filesave=$filesave&file=$matieres\"><img src=\"./icon/backup.gif\" width=\"49px\" style=\"border:solid 1px #000000;\"></a>";
	
	// Graphe .svg avril 2020
	$notes = explode(":", $texte_notes);
	$noms = explode(":", $texte_noms);
	echo("<a href=\"./geo.php?nomfichier=$filesave\">");
	include("grapheSVG_fct.php");
	include("grapheSVG.php");
	echo("</a>");
	
	
	include("./bas.php");
?>