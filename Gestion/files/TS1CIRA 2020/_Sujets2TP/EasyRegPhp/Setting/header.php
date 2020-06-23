<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>EasyReg PHP</title>
<link href="./style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<div id="entete"><table ><tr align=center><td><font size="+3">EASYREG</font></td></tr></table></div>

<?php
	//liste des constantes
	$suffix = ".txt";//Suffix de tous les fichiers
	$repertoire = "./files/";//Emplacement des fichiers
	$schem = "S"; //T(p)
	$modarg = "B";//liste des points
	$temporel = "T";//reponse tempo
	$reglages = "R";//Réglages pour les calculs
	$calc = "C";

	$px0 = 512;//POUR LE GRAPHIQUE
	$py0 = 384;
	$scalex = 1024/360;
	$scaley = 15;

function menu($numero)
{
	//echo("<ul id=\"menu\"><li><a href=\"./index.php?num=$numero\">Fichier</a>");
	echo("<ul id=\"menu\"><li><a href=\"./index.php?num=$numero&action=Tp\">Fichier</a>");
	echo("<ul>");
	echo("<li><a href=\"./index.php?action=newfile\">Nouveau</a>");
	echo("</li>");
	echo("</ul>");
	echo("</li>");
	echo("<li><a href=\"./index.php?num=$numero&action=calcul\">Calculs</a>");
	echo("<ul>");
	echo("<li><a href=\"./index.php?num=$numero&action=tableau\">Valeurs Black</a>");
	echo("</li>");
	echo("<li><a href=\"./index.php?num=$numero&action=tableau2\">Valeurs Temps</a>");
	echo("</li>");
	echo("</ul>");
	echo("</li>");
	echo("<li><a href=\"./index.php?num=$numero&action=black\">Black</a>");
	echo("<li><a href=\"./index.php?num=$numero&action=temps\">Temps</a>");
	echo("</li>");
	echo("</ul>");
}
?>