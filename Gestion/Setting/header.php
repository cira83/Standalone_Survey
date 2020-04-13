<html>
<head>
<?php
	$password = $_COOKIE["password"];
	
	$nom=$_SERVER['SCRIPT_NAME'];
	$txt = explode("/",$nom);
	$k = count($txt);
	$j = explode(".",$txt[$k-1]);
	if($titre=="") 
	{
		$titre=$j[0];
		$titre1=$txt[$k-2];
		$titre2=$j[0];
	}

	$chemin = "./Diapos/" ;
	
	//on vérifie que le champ est bien rempli:
	if(!empty($_FILES["fichier_choisi"]["name"])){
		//nom du fichier choisi:
		$nomFichier = $_FILES["fichier_choisi"]["name"] ;
		//nom temporaire sur le serveur:
		$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
		//type du fichier choisi:
		$typeFichier = $_FILES["fichier_choisi"]["type"] ;
		//poids en octets du fichier choisit:
		$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
		//code de l'erreur si jamais il y en a une:
		$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
		if(copy($nomTemporaire, $chemin.$nomFichier)){
			$Message = "Votre fichier $nomFichier est sauvegard&eacute;." ;
			chmod("$chemin$nomFichier",0777);
		}
		else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
	}
	else $Message = "Vous n'avez pas choisit de fichier !!";
	
	
	if($password=="OK") echo("<table class=\"pied\"><tr><td>$Message</td></tr></table>");

?>

<title>Diaporamas BTS CIRA</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="../../styles.css" rel="stylesheet" media="all" type="text/css">

</head>

<body>
<table class="entete"><tr><td></td></tr></table>

<!-- Header.php -->


