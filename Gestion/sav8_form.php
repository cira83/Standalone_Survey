<!-- Formulaire de sauvegarde -->
<hr/>
<?php
	include("sav8_form.html");
	$form_rep = $_POST['formulaire'];
	
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
	
		$stop = false;
		$filename = $nomFichier;
		if(ereg("php$", $filename) || ereg("php3$", $filename) || ereg("cgi$", $filename)) {
			
			$stop = true;
		}
	
	
		if(!$stop){
			if(copy($nomTemporaire, $chemin.$nomFichier)){
				$Message = "Votre fichier <font class=\"jaune\">$chemin$nomFichier</font> est sauvegard&eacute;." ;
				chmod("$chemin$nomFichier",0777);
				rename("$chemin$nomFichier", "$chemin$elv $nomFichier");
			}
				else $Message = "La sauvegarde a &eacute;chou&eacute; $chemin$nomFichier !! <br/>" ;
		} 
		else echo "Format non-autorisé <br/>";

	}
	else $Message = "<p>Vous n'avez pas encore choisi de fichier !!!</p>";

	echo("<!-- $nomTemporaire, $chemin.$nomFichier -->");
	
	if($form_rep=="OK") echo($Message);
?>
<!-- Fin Formulaire de sauvegarde -->
	

