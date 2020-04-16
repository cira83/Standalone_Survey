<?php
	include("./security.php");
	include("./DSFonctions.php");
	include("./DS_Securite.php");// function DSMDP($classe, $elv);
	
	
	
	$numero2session = session_id();//Numero de session
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	
	$nom_elv = isset($_GET['name']) ? $_GET['name'] : NULL;
	//$nom_elv = $_GET[name];
	$DS_password = DSMDP($classe, $nom_elv);
	$fichier_elv = "./files/$classe/_Copies/$nom_elv/rep/index.htm"; //echo("<!-- $fichier_elv -->\n");
	$rep_elv = "./files/$classe/_Copies/$nom_elv/rep/$DS_password";
	
	$TAG = TAGdufichier($fichier_elv);
	//$TAG = trim($TAG);
	$fichier_prof= "./files/$classe/_Copies/_Sujets/$TAG/index.htm"; //echo("<!-- $fichier_prof -->\n");
	$rep_prof = "./files/$classe/_Copies/_Sujets/$TAG/rep212";
	$titredudocument = "$TAG $nom_elv";
	$content = "";
	

//--------------------------------------------------------------------------------------------------------------------------------------------------
	function ligne_tab_Q($case1,$case2,$case3,$case4,$num_quest) {
		return("<table id=\"T$num_quest\"><tr><td align=\"left\" width=\"800px\">$case1</td><td width=\"50px\">$case2</td><td width=\"50px\">$case3</td><td align=\"left\" width=\"800px\">$case4</td></tr></table>");
	}

	function ligne_tab($case1,$case2,$case3,$case4) {
		return("<table><tr><td align=\"left\" width=\"800px\">$case1</td><td width=\"50px\">$case2</td><td width=\"50px\">$case3</td><td align=\"left\" width=\"800px\">$case4</td></tr></table>");
	}

	function lire_reponse($repertoire,$num,$type){
		$filename = "$repertoire/I$num.txt";
		$reponse = "";
		if($type=="T"&&file_exists($filename)) {
			$fp = fopen($filename, "r");
			$reponse = fgets($fp);
			fclose($fp);
		}
		if($type=="U"&&file_exists($filename)) {
			$fp = fopen($filename, "r");
			$reponse = fgets($fp);
			while(!feof($fp)){
				$ligne = fgets($fp);
				if(strlen($ligne)>2) {
					$ligne = netoyer4HTML($ligne);
					$reponse .= "<br/>$ligne";
				}
			}
			fclose($fp);
		}
		if($type=="I"&&file_exists($filename)) {
			$fp = fopen($filename, "r");
			$image = fgets($fp);
			$image_link = trim("$repertoire/$image");
			$dimensions = getimagesize($image_link);
			$reponse .= affiche_image($image_link,$dimensions[0]);
			//$reponse .= $image_link;
			fclose($fp);
		}
		
		
		return $reponse;
	}

	function affiche_image($image_link,$size){
		if($size>750) $image = "<img src=\"$image_link\" width=\"750px\">";
		else $image = "<img src=\"$image_link\">";
		return("<a href=\"$image_link\">$image</a>");
	}

	function lire_note($filename,$num){
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$note = fgets($fp);
			fclose($fp);
		}
		$icon[0] = "<img src=\"./icon/X.gif\" id=\"N$num\">";
		$icon[1] = "<img src=\"./icon/X.gif\" id=\"M$num\">";
		if($note=="A\n") {
			$icon[0] = "<img src=\"./icon/A.gif\" id=\"N$num\">";
			$icon[1] = "<img src=\"./icon/A.gif\" id=\"M$num\">";
		}
		if($note=="B\n") {
			$icon[0] = "<img src=\"./icon/B.gif\" id=\"N$num\">";
			$icon[1] = "<img src=\"./icon/B.gif\" id=\"M$num\">";
		}
		if($note=="C\n") {
			$icon[0] = "<img src=\"./icon/C.gif\" id=\"N$num\">";
			$icon[1] = "<img src=\"./icon/C.gif\" id=\"M$num\">";
		}
		if($note=="D\n") {
			$icon[0] = "<img src=\"./icon/D.gif\" id=\"N$num\">";
			$icon[1] = "<img src=\"./icon/D.gif\" id=\"M$num\">";
		}
		
		return $icon;
	}

	function calcul_note($filename,$coef) {		
		$res = 0;
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$note = fgets($fp);
			fclose($fp);
		}
		if($note=="A\n") $res = $coef;
		if($note=="B\n") $res = 0.75*$coef;
		if($note=="C\n") $res = 0.35*$coef;
		if($note=="D\n") $res = 0.05*$coef;
		return $res;
	}


	function notation($num) {
		$notation = "<img src=\"./icon/A.gif\" id=\"A$num\" onclick=\"noter(this.id);\"><br>";
		$notation .= "<img src=\"./icon/B.gif\" id=\"B$num\" onclick=\"noter(this.id);\"><br>";
		$notation .= "<img src=\"./icon/C.gif\" id=\"C$num\" onclick=\"noter(this.id);\"><br>";
		$notation .= "<img src=\"./icon/D.gif\" id=\"D$num\" onclick=\"noter(this.id);\"><br>";
		$notation .= "<img src=\"./icon/X.gif\" id=\"X$num\" onclick=\"noter(this.id);\">";
		
		return $notation;
	}

	function netoyer4HTML($texte){//Netoyage du texte pour HTML
		$texte = str_replace("&", "&amp;", $texte);
		$texte = str_replace(array("<",">","\t"), array("&lsaquo;","&rsaquo;","&nbsp;&nbsp;&nbsp;"), $texte);
		return $texte;
	}
//--------------------------------------------------------------------------------------------------------------------------------------------------
	$num_page = 0;
	$num_question = 0;
	$feuille2notes = "<table><tr>";
	if(file_exists($fichier_elv)&&file_exists($fichier_prof)) {
		$fp_elv = fopen($fichier_elv, "r");
		$fp_prof = fopen($fichier_prof, "r");
		$drap = feof($fp_elv) + feof($fp_prof);
		while(!$drap) {
			$ligne_elv = fgets($fp_elv);
			$ligne_prof = fgets($fp_prof);
			$part_elv = explode("#", $ligne_elv);
			$part_prof = explode("#", $ligne_prof);
			if($part_elv[0]=="Q") {
				$num_question++;				
				$note_elv = calcul_note("$rep_elv/N$num_question.txt",$part_elv[2]);
				
				$content.=ligne_tab_Q("<font color=\"#0000FF\"><b>Q$num_question :</b></font> $part_elv[1]","<span id=\"E$num_question\">$note_elv</span>","<span id=\"C$num_question\">$part_prof[2]</span>","<font color=\"#0000FF\"><b>Q$num_question :</b></font> $part_prof[1]",$num_question);
			}
			if(($part_elv[0]=="T")||($part_elv[0]=="U")){
				$notation = notation($num_question);
				$reponse_elv = lire_reponse("$rep_elv",$num_question,$part_elv[0]);
				$note_elv = lire_note("$rep_elv/N$num_question.txt",$num_question);
				$reponse_prof = lire_reponse("$rep_prof",$num_question,$part_prof[0]);
				
				$content.=ligne_tab($reponse_elv,"<a href=\"#entete\">$note_elv[0]</a>",$notation,$reponse_prof);
				$feuille2notes .= "<td><b>$num_question</b>|</td><td><a href=\"#T$num_question\">$note_elv[1]</a></td>";
			}
			if($part_elv[0]=="I"){
				$notation = notation($num_question);
				$reponse_elv = lire_reponse("$rep_elv",$num_question,$part_elv[0]);
				$note_elv = lire_note("$rep_elv/N$num_question.txt",$num_question);
				$reponse_prof = lire_reponse("$rep_prof",$num_question,$part_prof[0]);
				
				$content.=ligne_tab($reponse_elv,"<a href=\"#entete\">$note_elv[0]</a>",$notation,$reponse_prof);
				$feuille2notes .= "<td><b>$num_question</b>|</td><td><a href=\"#T$num_question\">$note_elv[1]</a></td>";
			}
			if($part_elv[0]=="C") {
				$content.=ligne_tab("$part_elv[1]","","","$part_prof[1]");
			}
			if($part_elv[0]=="L") {
				$num_page++;
				$content.="<table><tr><td bgcolor=\"white\">Page $num_page</td></tr></table>";
			}			
			
			$drap = feof($fp_elv) + feof($fp_prof);
		}
		fclose($fp_elv);
		fclose($fp_prof);
		
	}
	else {
		if(!file_exists($fichier_elv)) $content.="<table><tr><td>Il manque le fichier élève : $fichier_elv.</td></tr></table>";
		if(!file_exists($fichier_prof)) $content.="<table><tr><td>Il manque le fichier prof : $fichier_prof.</td></tr></table>";
	}
		
	$feuille2notes .= "<td>|</td><td><a href=\"DSexport.php?nom=$nom_elv&classe=$classe&last=$num_question\" target=\"_blank\"><img src=\"./icon/backup.gif\" height=\"20px\"></a></td></tr></table>";
?>
	

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles_correction.css">
		<title><?php echo($titredudocument);?></title>
		<script type="text/javascript" src="script_notation.js"></script>
		<meta name="Description" content="<?php echo($numero2session);?>">
	</head>
	<body>
		<center>	
		<table width="100%" id="entete">
			<tr>
				<td width="50%"><font size="+5"><?php echo($titredudocument);?></font></td><td><font size="+5"><?php echo("$TAG Correction");?></font></td>
			</tr>
		</table>
		<input type="hidden" id="nom_elv" value="<?php echo($nom_elv);?>"/>
		<input type="hidden" id="classe" value="<?php echo($classe);?>"/>
		<input type="hidden" id="coderep" value="<?php echo($DS_password);?>"/>
		
<?php
	echo($feuille2notes);
	echo($content);
?>
		</center>
	</body>
</html>