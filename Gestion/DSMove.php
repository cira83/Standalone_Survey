<?php
	$valeur = $_GET['valeurs'];
	$classe = $_COOKIE['laclasse'];

	$part = explode(":", $valeur);
	$nom111 = $part[1];
	
	//Code du DS pour connaitre le répertoire des réponses à archiver
	$filecode = "./files/$classe/_Copies/$nom111/rep/on.txt";
	if(file_exists($filecode)) {
		$fp = fopen($filecode, "r");
		$DS_password = fgets($fp);
		fclose($fp);
	}
	
	//TAG du sujet
	$filesujet = "./files/$classe/_Copies/$nom111/rep/index.htm";
	if(file_exists($filesujet)) {
		$fp = fopen($filesujet, "r");
		$Ligne1 = fgets($fp);
		fclose($fp);
		$part2 = explode("#", $Ligne1);
		$td111 = $part2[1];
	}	
	
	if($td111) {
		//Renommage du fichier réponse avec le TAG + code
		$dossier_rep = "./files/$classe/_Copies/$nom111/rep/$DS_password";
		$dossier_bak = "./files/$classe/_Copies/$nom111/rep/$td111 $DS_password/";
		if(file_exists($dossier_rep)) rename($dossier_rep, $dossier_bak);
		
		//Deplacement des éléments dans le dossier de sauvegarde ci-dessus
		$dossier_rep = "./files/$classe/_Copies/$nom111/rep";
		if(file_exists($dossier_rep)){
			$listeDreponses = scandir($dossier_rep);
			foreach($listeDreponses as $filename){
				$partiesdunom2020 = explode(".", $filename);
				if($partiesdunom2020[1]) {// tous les fichiers sauf .. et .
					$avant = "./files/$classe/_Copies/$nom111/rep/$filename";
					$apres = "$dossier_bak$filename";
					if(file_exists($avant)) rename($avant, $apres);
				}
			}
			$avant = "./files/$classe/_Copies/$nom111/rep/index.htm";
			$apres = $dossier_bak."index.htm";
			if(file_exists($avant)) rename($avant, $apres);
		}
		$Message .= "$td111 de $nom111 archivé";
	}

	//Retour du DS choisi
	$DS_choisi = $part[0];
	$part3 = explode(" ", $DS_choisi); //Separe le TAG et le code $part3[0]=TAG $part3[1]=code
	//Repertoire
	$avant = "./files/$classe/_Copies/$nom111/rep/$DS_choisi";
	$apres = "./files/$classe/_Copies/$nom111/rep/$part3[1]";
	if(file_exists($avant)) rename($avant, $apres);
	//Sujet
	$avant = "./files/$classe/_Copies/$nom111/rep/$part3[1]/index.htm";
	$apres = "./files/$classe/_Copies/$nom111/rep/index.htm";
	if(file_exists($avant)) rename($avant, $apres);
	//Fichier on
	$avant = "./files/$classe/_Copies/$nom111/rep/$part3[1]/off.txt";
	$apres = "./files/$classe/_Copies/$nom111/rep/on.txt";
	if(file_exists($avant)) rename($avant, $apres);	
	$avant = "./files/$classe/_Copies/$nom111/rep/$part3[1]/on.txt";
	$apres = "./files/$classe/_Copies/$nom111/rep/on.txt";
	if(file_exists($avant)) rename($avant, $apres);	
	//Session
	/* $avant = "./files/$classe/_Copies/$nom111/rep/$part3[1]/sessions.txt";
	$apres = "./files/$classe/_Copies/$nom111/rep/sessions.txt";
	if(file_exists($avant)) rename($avant, $apres);	*/
	//infos.txt
	$avant = "./files/$classe/_Copies/$nom111/rep/$part3[1]/infos.txt";
	$apres = "./files/$classe/_Copies/$nom111/rep/infos.txt";
	if(file_exists($avant)) rename($avant, $apres);	

	$fp = fopen("DSMove.txt","w");
	fwrite($fp, $Message);
	fclose($fp);
?>