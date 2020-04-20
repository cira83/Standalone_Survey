<script type="text/javascript" src="./routes.js"></script>

<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
			</head>
<body>
	<center>
<?php
	/* 
		Le fichier ./files/$classe/_Progressions/objectifs.htm contient les différents objectifs du programme
		Le fichier ./files/$classe/_Progressions/$nom.txt contient la progression de $nom_elv
	*/
	$nom = $_COOKIE[elv];
	$password = $_COOKIE[password];
	$files = "./files/";
	$classe = $_COOKIE[laclasse];	
	
		//Accés aux données pour le professeur
	$getnom = $_GET[nomelv];
	if($getnom!="") {
		$nom=$getnom;
		$_COOKIE["elv"] = $nom;
	}
	
	// FONCTIONS ET CONSTANTES
	include("./lesfonctions.php");
	function menu_progression($level,$name){
		$case ="<td align=\"right\" bgcolor=\"FF0000\">";
		$menu = "<select name=\"$name\" onchange=\"reload(this.name,this.value)\">";
		
		if($level==0) {
			$menu .= "<option value=\"0\" selected";
			$case ="<td align=\"right\" bgcolor=\"#FF0000\" width=\"5px\"></td><td width=\"5px\"></td><td width=\"5px\"></td><td width=\"5px\"></td><td width=\"150px\">";
		}
		else $menu .= "<option value=\"0\"";
		$menu .= ">C'est quoi ?</option> ";
		
		if($level==1) {
			$menu .= "<option value=\"1\" selected";
			$case ="<td width=\"5px\"></td><td align=\"right\" bgcolor=\"#FFCD66\" width=\"5px\"></td><td width=\"5px\"></td><td width=\"5px\"></td><td width=\"150px\">";
		}
		else $menu .= "<option value=\"1\"";
		$menu .= ">Je sais ce que c'est</option> ";
		
		if($level==2) {
			$menu .= "<option value=\"2\" selected";
			$case ="<td width=\"5px\"></td><td width=\"5px\"></td><td align=\"right\" bgcolor=\"#FFFE66\" width=\"5px\"></td><td width=\"5px\"></td><td width=\"150px\">";
		}
		else $menu .= "<option value=\"2\"";		
		$menu .= ">Je peux en parler</option> ";
		
		if($level==3) {
			$menu .= "<option value=\"3\" selected";
			$case ="<td width=\"5px\"></td><td width=\"5px\"></td><td width=\"5px\"></td><td align=\"right\" bgcolor=\"#CCFF65\" width=\"5px\"></td><td width=\"150px\">";
		}
		else $menu .= "<option value=\"3\"";		
		$menu .= ">Je peux expliquer</option> ";
		
		$menu .= "</select></td>";
		return($case.$menu);
	}
	
	
	//Gestions des Fichiers
	$racine = "./files/$classe/_Progressions";
	if(!is_dir($racine)){
		mkdir($racine, 0777);
		echo("<p>Création du dossier $racine</p>");
	}
	
	$filename1 = "$racine/objectifs.htm";
	if(file_exists($filename1)) {
		$objectifs = fopen($filename1, "r");
		$i=0;
		while(!feof($objectifs)){
			$objs[$i]=fgets($objectifs); $i++;
		}
	}
	else echo("<p>Le fichier $filename1 n'existe pas !!</p>");
	
	//Lecture du fichier élève
	$filename2 = "$racine/$nom.txt";
	if(!file_exists($filename2)) {
		$fichier_elv = fopen($filename2, "w");
		fclose($fichier_elv);
		echo("<p>Création du fichier $filename2</p>");
	}
	$fichier_elv = fopen($filename2, "r");
	$couleurs = explode(":", fgets($fichier_elv));
	fclose($fichier_elv);
	
	if($_GET[number]>0){//Si modification d'un niveau - Script OnChange()
		$couleurs[$_GET[number]]=$_GET[niveau];
		$newline = "0";
		for($i=1;$i<count($couleurs);$i++) $newline .= ":$couleurs[$i]";
		$fichier_elv = fopen($filename2, "w");
		fprintf($fichier_elv, $newline);
		fclose($fichier_elv);
	}
	
	
	$logout = "<td onclick=\"direction(0);\" class=\"pointer\"><b>Retour</b></td>";
	$routes = "<table><tr>$tabbleu$taborange$tabjaune</tr>";
	echo($routes);
	
	if(password($nom,$password,$classe)){
		echo("<tr bgcolor=\"$levert\"><td>$classe</td><td>Progression de $nom</td>$logout</tr></table>");
		echo("<table border=\"1px\"");
		for($i=0;$i<count($objs);$i++) {
			$cellule = explode(":", $objs[$i]);
			if(count($cellule)>1) echo("\n<tr class=\"lignes\"><td colspan=6><font size=\"+1\">$cellule[0]</font></td></tr>");
			else {
				$case2 = menu_progression($couleurs[$i],$i);
				echo("\n<tr><td align=\"left\">$cellule[0]</td>$case2</tr>");
			}
		}
		echo("</table>");
	}
	else {
		echo("<tr bgcolor=\"$levert\"><td colspan=2>Vous n'&ecirc;tes pas connect&eacute;(e) !!</td>$logout</tr></table>");
	}
	
?>
	</center>
</body>
</html>