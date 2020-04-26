<html>
<head>
<?php
	$password = $_POST['password'];
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

	if($password=="GHRtE9b7"){
		//on vérifie que le champ est bien rempli:
		if(!empty($_FILES["fichier_choisi"]["name"]))
		{
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
	
			//chemin qui mÃ¨ne au dossier qui va contenir les fichiers uplaod:
			$chemin = "./" ;
 
			if(copy($nomTemporaire, $chemin.$nomFichier))
			{
				$Message = "Votre fichier $nomFichier est sauvegard&eacute;." ;
				chmod("$chemin$nomFichier",0777);
			}
			else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<table class=\"pied\"><tr><td>$Message</td></tr></table>");
	}
	else $Message = "Mot de passe incorrect !!";

?>



<title><?php echo($titre1); ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="../../styles.css" rel="stylesheet" media="all" type="text/css">

</head>

<body>
<table class="entete"><tr><td></td></tr></table>
<table class="titre"><tr><td class="titre1"><?php echo($titre1);?></td><td class="titre2"><?php echo($titre2);?></td><td></td></tr></table>
<table class="contenu"><tr><td>