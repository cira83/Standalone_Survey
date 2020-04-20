<?php
	$origine_filename = $_GET['file'];
	$affichage = "<table><tr><td bgcolor=\"yellow\">Pas de fichier enregistré dans $origine_filename</td></tr></table>";
	
	$repertoire = "$origine_filename";
	$ListFiles = scandir($repertoire);
	sort($ListFiles);
	$i=0;
	$nbfichier=0;
	while ($i < count($ListFiles)){
		$file = $ListFiles[$i];
		$array=explode('.',$file);
		$extension = $array[1];
		if(($array[1]!="php")&&($array[1]!="")){
			$filename[$nbfichier] = $file;
			$nbfichier++;
		}
		$i++;
	}
	if($nbfichier>0){
		$affichage = "<table><tr><td bgcolor=\"yellow\">Fichier enregistré</td></tr>";
		if($nbfichier>1) $affichage = "<table><tr><td bgcolor=\"yellow\">Fichiers enregistrés</td></tr>";
		
		for($i=0;$i<$nbfichier;$i++) $affichage .= "<tr><td><a href=\"./ranger.php?file=$filename[$i]\">$filename[$i]</a></td></tr>";
		
		
		$affichage .= "</table>";
	}
	
	
	
	echo($affichage);
?>