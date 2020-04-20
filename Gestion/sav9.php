<?php
	include("./lesfonctions.php");
	include("../head1.html");
	
	
	if($_COOKIE["nom"]) $elv = $_COOKIE["nom"]; 
	echo("<title>SAUVEGARDE $elv</title>");
?>		
	<script type="text/javascript">
	function login(){
		classe = document.getElementById('classe').value;
		document.cookie = 'laclasse='+classe;
		location.reload() ;
	}
	</script>
		
	</head>
	<body>
		<img src="head.png"/>
		<table><tr><td><p class="titre">
			<?php echo("$classe - $elv - Sauvegarde"); ?>
		</p></td></tr></table>

<!-- Liste des fichiers sauvegardés -->
<?php
	$repertoire_TP = "./files/$classe/_Sujets2TP/Copies/"; 	
	if(!file_exists($repertoire_TP)){
		mkdir($repertoire_TP);
		echo("<!-- mkdir $repertoire_TP -->");
	}
	
	echo("<!-- CODE SAUVEGARDE -->");
	$chemin = $repertoire_TP ;
	if(!file_exists($chemin)) {
		mkdir($chemin);
		chmod("$chemin",0777);
		echo("<!-- mkdir $chemin -->");
	}
	//on vérifie que le champ est bien rempli:
	if(!empty($_FILES["fichier_choisi"]["name"])){
		//nom du fichier choisi:
		$nomFichier = $_FILES["fichier_choisi"]["name"] ; echo("<!-- $nomFichier -->");
		//nom temporaire sur le serveur:
		$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
		//type du fichier choisi:
		$typeFichier = $_FILES["fichier_choisi"]["type"] ;
		//poids en octets du fichier choisit:
		$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
		//code de l'erreur si jamais il y en a une:
		$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
		if(copy($nomTemporaire, $chemin.$nomFichier)){
			chmod("$chemin$nomFichier",0777);
			//remplace les php
			$nomFichier_propre = strtolower($nomFichier);
			$nomFichier_propre = str_replace("php", "txt", $nomFichier_propre);
			$Message = "Votre fichier $nomFichier_propre est sauvegard&eacute;." ;
			rename("$chemin$nomFichier", "$chemin$elv $nomFichier_propre");
		}
		else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
	}

	$ListFiles = scandir($repertoire_TP);
	sort($ListFiles);
	$i=0;
	$k=1;
	$nbfichier=0;
	echo("<p class=\"jaune\">");
	while ( $i < count($ListFiles)){
       	$file = $ListFiles[$i];
		$array=explode('.',$file);
		$extension=$array[1];
        if(($array[1]!="php")&&($array[1]!="")){
			echo($array[0].".".$array[1]);
			echo("<br/>");
			$nbfichier++;
    	}
    	$i++;
	}
	echo("</p><p>$nbfichier fichier(s) sauvegard&eacute;(s) </p>");
?>
<!-- sav8_form.html -->
<hr/>
<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="./sav9.php">
<tr><td align="left"><input name="fichier_choisi" type="file"></td><td><input name="formulaire" type="hidden" value="OK"</td>
<td align="right"><input name="bouton" value="Envoyer le fichier" type="submit"></td></tr>
</form></table>
<!-- /sav8_form.html -->
<?php
	$Message2 = isset($Message) ? $Message : null;
	echo("<font color=\"yellow\" size=\"-1\">$Message2</font>");	
	echo("<!-- /CODE SAUVEGARDE -->");	
		
	include("../foot2.html");
?>	



