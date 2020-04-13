<?php
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";

	
	$nom2eleve = $_GET[name];
	$titre_copie = $_COOKIE["elv"];
	$sujet2DS = $_GET[file];
	$repertoire_rep = "./files/$classe/_Copies/$nom2eleve/rep";	
	
	$sujet = $_GET[file2];//Pour le professeur uniquement 18 fevrier 2017
	if($sujet) {
		$repertoire_rep = "$sujet/rep212";//pour éviter la fraude
		$_SESSION[sujet2DS]=$sujet;
		$nom2eleve = "Professeur";
		$emplacement = $_GET[name];
		$sujet2DS = "./files/$classe/_Copies/$emplacement/index.htm";
	}
	
	
	function largeur_svg($image_link){
		$largeur = 0;
		$fp = fopen($image_link, "r");
		$drap = true;
		while($drap) {
			$ligne = fgets($fp);
			$svg_txt = strpos("_$ligne", "<svg");
			if($svg_txt) {
				$part = explode("\"", $ligne);
				for($i=0;$i<count($part);$i++){
					$width_txt = strpos($part[$i], "width=");
					if($width_txt) {
						$largeur = $part[$i+1]-1;//Bidouille pour transformer en nombre
						$largeur++;
						//echo("<p>--- $largeur</p>");
					}
						
				}
			}
			$drap =  !feof($fp);
		}
		fclose($fp);
		return $largeur;
	}
	
	function netoyer4HTML($texte){//Netoyage du texte pour HTML
		$texte = str_replace("&", "&amp;", $texte);
		$texte = str_replace(array("<",">","\t"), array("&lsaquo;","&rsaquo;","&nbsp;&nbsp;&nbsp;"), $texte);
		return $texte;
	}
		
	function ligne2tableau($content){
		echo("<table class=\"left\"><tr><td>$content</td></tr></table>");
	}

	function ligne2tableauRep($content){
		echo("<table class=\"reponse\"><tr><td>$content</td></tr></table>");
	}

	function trouve_image($nom,$rep){
		$drap = false;
		$files = scandir($rep);
		foreach($files as $txt) {
			$part = explode(".", $txt);
			if($part[0]==$nom) $drap = $txt;
		}
		return $drap;
	}

	function trouve_texte($nom,$repertoire_rep){
		$filename = "$repertoire_rep/$nom.txt";
		$texte = "?";
		if(file_exists($filename)) {
			$fp = fopen("$filename", "r");
			$texte = netoyer4HTML(fgets($fp));
			fclose($fp);
		}
		return $texte;
	}
	
	function trouve_texte_long($nom,$repertoire_rep){
		$texte = "?";
		$filename = "$repertoire_rep/$nom.txt";
		if(file_exists($filename)) {
			$fp = fopen("$filename", "r");
			$texte = fgets($fp);
			while(!feof($fp)){
				$ligne = fgets($fp);
				if(strlen($ligne)>2) {
					$ligne = netoyer4HTML($ligne);
					$texte .= "<br/>$ligne";//pour éliminer les trop nombreux saut de ligne
				}
			}
			fclose($fp);
		}
		return $texte;
	}

	function affiche_image($image,$size,$type){
		//2 mars 2017
		$nosize = 0;
		if($size>700) $nosize = 1;
		$ext = explode(".", $image);
		if($ext[count($ext)-1]=="svg") $nosize = 1;
		
		if($nosize) $text = "<img src=\"$image\">";
		else $text = "<img src=\"$image\" width=\"$size px\">";
		echo("<table><tr><td><a href=\"$image\">$text</a></td></tr></table>");
	}
		
	function affiche_texte($texte,$name,$size){
		$text = "<form method=\"post\" action=\"./devoir.php?action=3\"><input type=\"text\" name=\"reponse\" value=\"$texte\" size=\"$size\"/>";
		$text .= "<input type=\"hidden\" name=\"question\" value=\"$name\"/>";
		$text .= "<input type=\"submit\" value=\"R&eacute;pondre\"></form>";
		echo("<table><tr><td>$text</td></tr></table>");
	}
	
	function chemin_relatif($bout2texte){
		$bout2texte = str_replace("http://gatt.fr/Gestion/", "./", $bout2texte);
		return $bout2texte;
	}
	
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="sujet.css" media="print">
		<script type="text/javascript" src="./script.js"></script>
<?php
	if(file_exists($sujet2DS)){
		$fp = fopen($sujet2DS, "r");
		$titre_complet = fgets($fp);
		$part = explode("#", $titre_complet);
		$titre = "$part[1] $part[0]";//pour enlever la référence au répertoire réponse
		echo("<title>$titre</title>");
	}
?>
	</head>
	<body>	
<?php
	//echo("<p>$repertoire_rep</p>");
	if(file_exists($sujet2DS)){
		//$fp = fopen($sujet2DS, "r");
		//$titre = fgets($fp);
		echo("<center><h1>$titre</h1></center>");
		$_SESSION[points]=0;
		$i=0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$part[1] = chemin_relatif($part[1]);

			if($part[0]=="C"){//Commentaire
				ligne2tableau("$part[1]");
			}	
			if($part[0]=="Q") {//Question
				$i++;
				$bareme = "";
				$nd2pt = $part[2];
				$reponsefaite = 0;
				if(!file_exists("$repertoire_rep/I$i.txt")) $reponsefaite = 1;

				if($part[2]) {
					if(!$reponsefaite) $bareme = "</td><td class=\"pt\">$nd2pt";
					else $bareme = "</td><td class=\"pas2pt\">$nd2pt";
					
					$_SESSION[points] = $_SESSION[points] + $part[2];
				}
				ligne2tableau("<p class=\"question\"><font color=\"#0000FF\">\n<b>Q$i : </b></font>$part[1]</p> $bareme");
			}
			if($part[0]=="I") {//Réponse sour la forme d'une image
				$limage = $part[1];
				if($limage) {
					$dimensions = getimagesize($limage);
					affiche_image($limage,$dimensions[0],1);
				}
			}
			if($part[0]=="L") {//Saut de page
				$numero2page++;
				ligne2tableau("</td><td align=\"center\" bgcolor=\"white\">Page $numero2page</td><td>");
				if($part[1]!="N") {//L#N# Pas de saut pour le sujet
					echo("<div class=\"breakafter\"></div>\n");
					echo("\n<p></p>");
				}else echo("\n<hr>");
			}
		}
		fclose($fpDS);
	}else{
		echo("Pas de fichier  $sujet2DS !!");
	}
	$nb_points = $_SESSION[points];
	$numero2page++;
	ligne2tableau("</td><td align=\"center\" bgcolor=\"white\">Page $numero2page</td><td>");
	
	if($_GET[calc])  echo("<script type=\"text/javascript\">message(\"$nb_points\");</script>");
?>
