<?php
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
	
	$filtre = "#$filtre";
	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets";
	echo("<table><tr><td>");
	$lessujets = scandir($repertoire_Sujets);
	foreach($lessujets as $nom01){
		if(estfichier($nom01)&&strpos("_#$nom01", $filtre)) {
			$filename = "$repertoire_Sujets/$nom01/index.htm";
			$repsujet = "$repertoire_Sujets/$nom01";
			if(file_exists($filename)){
				$fp = fopen($filename, "r");
				$titre2ds = fgets($fp);
				$partiesdunom = explode("#", $titre2ds);
				fclose($fp);
				$hauteur = "25px";
				$partiesdunom0 = isset($partiesdunom[0]) ? $partiesdunom[0] : "";
				$partiesdunom2 = isset($partiesdunom[2]) ? $partiesdunom[2] : "";
				echo("<td><font size=\"+1\"><b>$nom01</b> - $partiesdunom0 - <font color=\"blue\">$partiesdunom2</font></font></td>");
				echo("<td width=\"10px\"><a href=\"./devoir.php?name=_Sujets/$nom01&file=$repsujet\" target=\"_blank\" Title=\"Repondre\"><img src=\"./icon/Q_vert.gif\"></a></td>");
				echo("<td width=\"10px\"><a href=\"./copie2DS.php?name=_Sujets/$nom01&file2=$repsujet\" target=\"_blank\" Title=\"La Correction\"><img src=\"./icon/C.gif\"></a></td>");
				echo("<td width=\"10px\"><a href=\"./sujet2DS.php?name=_Sujets/$nom01&file2=$repsujet\" target=\"_blank\" Title=\"Le sujet\"><img src=\"./icon/Page.gif\"></a></td>");
				echo("<td width=\"10px\"><a href=\"./DSNew.php?action=2&TAG=$nom01\" target=\"_blank\" Title=\"Editer\"><img src=\"./icon/Editer.gif\"></a></td>");

				echo("</tr><tr><td>\n");
			}

		}
	}
	echo("</td></tr></table>");

?>