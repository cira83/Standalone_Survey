<?php
	$photos = "../photos/";
	$files = "./files/";
	$nbphotoslignes = 5;
	if(!file_exists("./files/$classe.txt")) $classe = $_COOKIE["laclasse"];  //$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="TS2CIRA";
	$largeurdelecran = $_COOKIE["largeur"];
	$password = $_COOKIE["password"];
	$accueil = "<a href=\"./appel.php\">";
	$date = date("j/m");
	$cheminfichiertp = "../Commun/tp/";
	$nonfait = "Non Fait";
	$tabgphw = " width=\"420px\"";//largeur case graphique
	$tabeprw = " width=\"100px\"";//largeur case epreuve
	$tabnotw = " width=\"100px\"";//largeur case epreuve
	//$repertoire_copies =  "./files/$classe/_Copies";
	$file2delete = "Pas de fichier &agrave; supprimer";

	include("./lesfonctions.php");
	$passwordOK = password($nom,$password,$classe); 
	
	//Ajouter le 8 septembre 2016
	if(!$passwordOK){
		$tableaudesmatieres = "";
		$tableaudesappels = "";
		$leleve = "";
		$lepreuve1 = "";
		$tableauplanning = "";
		$tableaudesTP = "";
	}
?>
<!--                                  DEBUT DU FICHIER                         -->
<script type="text/javascript" src="./script.js"></script>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
		<link rel="icon" type="image/jpg" href="./icon/favicon.jpg" />
		<title><?php echo("$titre_page");?></title>
	</head>
	
	<body onload="tailledelafenetre();">
		<center>
		<?php
			if($passwordOK) echo("<table>");
			else echo("<table class=\"Px400\">");
		?>	
		<tr><td><?php echo($listedesclasses);?></td>
		<?php
			if(!$passwordOK){
				echo("<td><input type=\"text\" name=\"nom\" id=\"nom\" size=\"8\"><input type=\"password\" name=\"pwd\" id=\"pwd\" size=\"8\"></td>");
			}
		?>
		<td><input type="submit" onclick="<?php if($passwordOK) echo("out();"); else echo("motdepasse();");?>" value="<?php if($passwordOK) echo("Logout"); else echo("Login");?>"></td>
		</tr></table>

<!-- haut.php -->
