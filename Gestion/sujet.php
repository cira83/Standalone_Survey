<?php
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


//---------------------------------------------------------------------

	$classe = isset($_COOKIE['laclasse'])?$_COOKIE['laclasse']:"";
	$tag = isset($_GET['tag'])?$_GET['tag']:"";
	$numero2page = 0;
	$sujet2DS = "./files/$classe/_Copies/_Sujets/$tag/index.htm";
	$repertoire_rep = "";
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
		$titre = "$part[1] - $part[0]";//pour enlever la référence au répertoire réponse
		echo("<title>$titre</title>");
		echo("\n<!-- $sujet2DS -->");
		
	}
?>
	</head>
	<body>
<?php
	if(file_exists($sujet2DS)){
		echo("<center><h1>$titre</h1></center>");
		$_SESSION['points']=0;
		$i=0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$part[1] = chemin_relatif(isset($part[1])?$part[1]:"");

			if($part[0]=="C"){//Commentaire
				ligne2tableau("$part[1]");
			}
			if($part[0]=="Q") {//Question
				$i++;
				$bareme = "";
				$nd2pt = isset($part[2]) ? $part[2] : 0;
				$reponsefaite = 0;
				if(!file_exists("$repertoire_rep/I$i.txt")) $reponsefaite = 1;
				
				$nd2pt = "<font color=\"red\">$nd2pt</font>";
				if(isset($part[2])) $bareme = "</td><td width=\"10px\">$nd2pt";
				ligne2tableau("<p class=\"question\"><font color=\"#0000FF\">\n<b>Q$i : </b></font>$part[1]</p> $bareme");
			}
			if($part[0]=="I") {//Réponse sour la forme d'une image
				$limage = $part[1];
				if($limage) {
					if(file_exists($limage)) $dimensions = getimagesize($limage);
					else $dimensions[0] = "";
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
		fclose($fp);
	}else{
		echo("<center> Pas de fichier correspondant au TAG:'$tag' !!</center>");
	}
	$numero2page++;
	ligne2tableau("</td><td align=\"center\" bgcolor=\"white\">Page $numero2page</td><td>");

?>
