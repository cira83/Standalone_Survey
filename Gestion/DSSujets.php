<?php
	include("./DSFonctions.php");
	$classe = $_COOKIE['laclasse'];
	$filtre = $_GET['filtre'];
	

	function estfichier($nom){// Fichier ou non ?
		$drap = true;
		$data = explode(".", $nom);
		if($data[0]=="") $drap = false;
		if($nom[0]=="_") $drap = false;
		if($nom=="index.htm") $drap = false; //Nom du fichier questionnaire
		if($nom=="rep") $drap = false; //Nom du répertoire des réponse au questionnaire
		//if(!isset($data[1])) $drap = false; // Pas d'extension donc repertoire avril 2020

		return($drap);
	}
	
	function infosurlefichier($filename) {
		$tab = array_fill(0, 10, " ");
		$nb2pages = 1;
		$nb2questions = 0;
		$fp = fopen($filename, "r");
		$titre2ds = fgets($fp);
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			if($part[0]=="Q") $nb2questions++;
			if($part[0]=="L") $nb2pages++;
		}
		fclose($fp);
		
		$partiesdunom = explode("#", $titre2ds);
		$tab[0] = isset($partiesdunom[0]) ? $partiesdunom[0] : "";
		$tab[1] = isset($partiesdunom[1]) ? $partiesdunom[1] : "";
		$tab[2] = isset($partiesdunom[2]) ? $partiesdunom[2] : "";
		$tab[3] = $nb2questions;
		$tab[4] = $nb2pages;
		
		return "$tab[0]#$tab[1]#$tab[2]#$tab[3]#$tab[4]#";//titre#TAG#infos#nb2questions#nb2pages#
	}
	
	
	$filtre = "#$filtre";
	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets";
	echo("<table><tr><td>");
	$lessujets = scandir($repertoire_Sujets);
	foreach($lessujets as $nom01){
		if(estfichier($nom01)&&strpos("_#$nom01", $filtre)) {
			$filename = "$repertoire_Sujets/$nom01/index.htm";
			$repsujet = "$repertoire_Sujets/$nom01";
			$code4 = code_correction($repsujet);
			if(file_exists($filename)){
				$parties = explode("#", infosurlefichier($filename));

				$hauteur = "25px";
				$TAG_Affiche = "<font size=\"+1\"><b>$nom01</b></font>";
				if($parties[1]!=$nom01) $TAG_Affiche = "<font size=\"+1\" color=\"red\"><b>$nom01 ? $parties[1]</b></font>";
				echo("<td align=\"left\">$TAG_Affiche</td><td align=\"left\">$parties[0]</td><td> <font color=\"blue\">$parties[2]</font></td><td>Q$parties[3]</td><td>P$parties[4]</td>");
				echo("<td width=\"10px\"><a href=\"./devoir.php?name=_Sujets/$nom01&file=$repsujet\" target=\"_blank\" Title=\"Repondre\"><img src=\"./icon/Q_vert.gif\"></a></td>");
				echo("<td width=\"10px\"><a href=\"./DScorrection.php?tag=$nom01&code4=$code4\" target=\"_blank\" Title=\"La Correction\"><img src=\"./icon/C.gif\"></a></td>");
				//echo("<td width=\"10px\"><a href=\"./copie2DS.php?name=_Sujets/$nom01&file2=$repsujet\" target=\"_blank\" Title=\"La Correction\"><img src=\"./icon/C.gif\"></a></td>");
				//echo("<td width=\"10px\"><a href=\"./sujet2DS.php?name=_Sujets/$nom01&file2=$repsujet\" target=\"_blank\" Title=\"Le sujet\"><img src=\"./icon/Page.gif\"></a></td>");
				echo("<td width=\"10px\"><a href=\"./sujet.php?tag=$nom01\" target=\"_blank\" Title=\"Le sujet\"><img src=\"./icon/Page.gif\"></a></td>");

				echo("<td width=\"10px\"><a href=\"./DSNew.php?action=2&TAG=$nom01\" target=\"_blank\" Title=\"Editer\"><img src=\"./icon/Editer.gif\"></a></td>");

				echo("</tr><tr><td>\n");
			}

		}
	}
	echo("</td></tr></table>");

?>