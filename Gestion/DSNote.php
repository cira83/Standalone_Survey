<?php
	include("./DS_Securite.php");// function DSMDP($classe, $elv);
	include("./DSFonctionsPlus.php");
	include("./DSFonctions.php");
	
	$infos = isset($_GET['infos'])?$_GET['infos']:"";
	$part = explode(":", $infos);
	
	$lerepertoire = "./files/$part[1]/_Copies/$part[0]/rep";
	$repertoire_rep = filenameof($lerepertoire,$part[2]);
	$sommaire_td = bandeau2($repertoire_rep);// Dans DSFonctionPlus
	
	echo($sommaire_td[2]);	
?>