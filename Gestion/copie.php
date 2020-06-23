<?php
	function lecture_DS_pour_image($numero2question, $sujet2DS) {
		if(file_exists($sujet2DS)) {//Pour récupérer le titre court 24 fevrier 2017
			$i=0;
			$image = "./icon/interro.png";
			$fp = fopen($sujet2DS, "r");
			while(!feof($fp)) {
				$ligne1 = fgets($fp);
				$part = explode("#", $ligne1);
				if($part[0]=="Q") $i++;
				if(($numero2question==$i)&&($part[0]=="I")) $image = $part[1];
			}
			fclose($fp);
		}
		else $image ="pas de fichier $sujet2DS";
		return $image;
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
		//3 mars 2017
		$nosize = 0;
		if($size+1==1) $size = 700;//Si pas de taille, alors largeur 700
		if($size>700) $size=700;//Si plus grand je mets 700px
		$ext = explode(".", $image);
		if($size==700) $text = "<img src=\"$image\" width=\"$size px\" id=\"2020\">";
		else $text = "<img src=\"$image\">";
		if($type) echo("<table><tr><td><a href=\"$image\">$text</a></td></tr></table>");
		else echo("<table class=\"reponse\"><tr><td><a href=\"$image\">$text</a></td></tr></table>");
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




//---------------------------------------------------------------------------------------------------------	
	$classe = isset($_COOKIE["laclasse"])?$_COOKIE["laclasse"]:"CIRA1";
	$nom2eleve = isset($_GET['name']) ? $_GET['name'] : NULL;
	$tag = isset($_GET['tag']) ? $_GET['tag'] : NULL;
	$lerepertoire = "./files/$classe/_Copies/$nom2eleve/rep";	

	include("./DS_Securite.php");// function DSMDP($classe, $elv);
	include("./DSFonctionsPlus.php");
	include("./DSFonctions.php");

	$repertoire_rep = filenameof($lerepertoire,$tag);
	$sujet2DS = "$repertoire_rep/index.htm";
	$resume = "$tag $nom2eleve";

	$sommaire_td = bandeau2($repertoire_rep);// Dans DSFonctionPlus
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="print.css" media="print">
		<script type="text/javascript" src="./script.js"></script>
		<title><?php echo($resume);?></title>
	</head>
	<body>
			<table>
				<tr id="sommaire">
					<td><font size="+4"><?php echo($resume);?></font></td>
<?php				
	if($nom2eleve!="Correction") echo("<td width=\"120px\">$sommaire_td[1]</td></tr></table>"); 
	echo("\n<!-- 1 $sujet2DS -->\n");
	if(file_exists($sujet2DS)){
		//------------------------------------------------------------------------------  Sommaire avec toutes les questions
		$numero2page = 0;
		$rebelote =  sommaire_document($sujet2DS);//DSFonctionsPlus
		ligne2tableauOcentre($rebelote,$sommaire_td[0]);
		
		echo("\n<!-- 2  $repertoire_rep -->\n");
		//Fin du sommaire

		$fp = fopen($sujet2DS, "r");
		$ligne = fgets($fp);
		$part = explode("#", $ligne);
		echo("<h1>$part[0]</h1>");
		$_SESSION['points']=0;
		$i=0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$part[1] = chemin_relatif(isset($part[1]) ? $part[1]:"");

			if($part[0]=="C"){//Commentaire
				ligne2tableau("<i>$part[1]</i>");
			}
			if($part[0]=="Q") {//Question
				$i++;
				$bareme = "";
				$nd2pt = isset($part[2])?$part[2]:0;
				$reponsefaite = 0;
				if(!file_exists("$repertoire_rep/I$i.txt")) $reponsefaite = 1;
				$lettre_elv = lettre($repertoire_rep,$i);
				if(isset($part[2])) {
					if(!$reponsefaite) $bareme = "</td><td class=\"pt\">$nd2pt";
					else $bareme = "</td><td class=\"pas2pt\">$nd2pt";

					$_SESSION['points'] = $_SESSION['points'] + floatval($part[2]);
				}
				//ligne2tableau("<p class=\"question\" id=\"Q$i\" ><font color=\"#0000FF\">\n<b>Q$i : </b></font>$part[1]</p> $bareme");
				ligne2tableau("<a id=\"Q$i\" href=\"#sommaire\"><b>Q$i :</b></a> $part[1] $bareme $lettre_elv");
			}

			//Réponse sour la forme d'une image
			if($part[0]=="I") {
				if(!file_exists("$repertoire_rep/I$i.txt")){// Pas encore de réponse image
					$image_link = lecture_DS_pour_image($i, $sujet2DS);
					//if(!$image_link) $image_link = "./icon/interro.png";
					//$dimensions = getimagesize($image_link);
					echo("<!-- $image_link -->");
					affiche_image($image_link,10,1);//100<700 pour ne pas mettre width=700
				}else
				{
					$filetexte16 = fopen("$repertoire_rep/I$i.txt", "r");
					$image = fgets($filetexte16);
					$image_link = trim("$repertoire_rep/$image");//Pour enlever les espaces !!!
					$dimensions = getimagesize($image_link);
					$part_im = explode(".", $image_link);
					if($part_im[count($part_im)-1]=="svg") $dimensions[0] = largeur_svg($image_link);
					affiche_image($image_link,$dimensions[0],0);

					fclose($filetexte16);
				}

				$commentaire = get_commentaire("$repertoire_rep/CX$i.txt");
				if($commentaire) ligne2tableau("<font color=\"red\">$commentaire</font>");
			}
			if($part[0]=="T") {//Réponse sous la forme de texte
				$texte = trouve_texte("I$i",$repertoire_rep);
				if($texte != "?") ligne2tableauRep($texte);
				else ligne2tableau($texte);
				
				$commentaire = get_commentaire("$repertoire_rep/CX$i.txt");
				if($commentaire) ligne2tableau("<font color=\"red\">$commentaire</font>");
			}
			if($part[0]=="U") {//Réponse sous la forme de texte
				$texte = trouve_texte_long("I$i",$repertoire_rep);
				if($texte != "?") ligne2tableauRep($texte);
				else ligne2tableau($texte);

				$commentaire = get_commentaire("$repertoire_rep/CX$i.txt");
				if($commentaire) ligne2tableau("<font color=\"red\">$commentaire</font>");
			}
			if($part[0]=="L") {//Saut de page
				$numero2page++;
				ligne2tableau("</td><td align=\"center\" bgcolor=\"white\">Page $numero2page</td><td>");
				echo("\n<p></p>");
				echo("<div class=\"breakafter\"></div>\n");
			}

			if($part[0]=="D") {//Question dynamique 10/2017
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

				$laquestion2017 = $part[1];
				if(file_exists("$repertoire_rep/Q$i.txt")){
					$question_file = fopen("$repertoire_rep/Q$i.txt", "r");
					$laquestion2017 = fgets($question_file);
					fclose($question_file);
				}
				if(file_exists("$repertoire_rep/R$i.txt")){
					$reponse_file = fopen("$repertoire_rep/R$i.txt", "r");
					$lareponse = fgets($reponse_file);
					fclose($reponse_file);
				}

				ligne2tableau("<p class=\"question\"><font color=\"#0000FF\">\n<b>Q$i : </b></font>$laquestion2017</p> $bareme");
				ligne2tableau("<p class=\"question\">La bonne réponse à <font color=\"#0000FF\">\n<b>Q$i</b></font> est : $lareponse.");
			}

		}
		fclose($fp);
	}
    else{
		echo("<center>Pas encore de fichier corrigé !!</center>");
	}
	$nb_points = $_SESSION['points'];
	$numero2page++;
	ligne2tableau("</td><td align=\"center\" bgcolor=\"white\">Page $numero2page</td><td>");
?>