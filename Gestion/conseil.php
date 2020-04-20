<?php
	$classe = $_COOKIE["laclasse"];
	$titre_page = "Conseil $classe";
	$Semestre1 = "./files/$classe/_Semestre 1.txt"; 
	include("./haut.php");
	
	
	if(file_exists($Semestre1)){
		$drap = true;
		 $fpp = fopen($Semestre1, "r");
		 $ligne = fgets($fpp);
		 $note = explode(":",$ligne);
		 $ligne = fgets($fpp);
		 $nom = explode(":",$ligne);
		 fclose($fpp);
	}
	else {
		$drap = false;
		echo("Le fichier $Semestre1 n'existe pas !!");
	}
	
	
	if($drap){
		affiche("Semestre 1");
		for($i=0;$i<count($nom);$i++){
			if($note[$i]<10) $resultat[$i] = "0$note[$i]:$nom[$i]";
			else $resultat[$i] = "$note[$i]:$nom[$i]";
		}
		sort($resultat);
		$table = "<table><tr>";
		for($i=0;$i<count($nom);$i++){
			$part = explode(":", $resultat[$i]);
			$photo = "<img src=\"./photos/$part[1].jpg\" height=\"100px\"/>";
			$table .= "<td><a href=\"./eleve.php?nom=$part[1]\">$photo</a><br/>$part[1]<br/>$part[0]</td>";
		}
		$table .= "</tr></table>";
		echo($table);
		echo("<a href=\"./geo.php?nomfichier=./files/$classe/_Semestre%201.txt\">Graphique</a><hr>");
	}

	// Semestre 2 - 11 mai 2017
	$Semestre2 = "./files/$classe/_Semestre 2.txt"; 

	if(file_exists($Semestre2)){
		$drap = true;
		 $fpp = fopen($Semestre2, "r");
		 $ligne = fgets($fpp);
		 $note = explode(":",$ligne);
		 $ligne = fgets($fpp);
		 $nom = explode(":",$ligne);
		 fclose($fpp);
	}
	else {
		$drap = false;
		echo("Le fichier $Semestre2 n'existe pas !!");
	}
	
	
	
	if($drap){
		affiche("Semestre 2");
		for($i=0;$i<count($nom);$i++){
			if($note[$i]<10) $resultat[$i] = "0$note[$i]:$nom[$i]";
			else $resultat[$i] = "$note[$i]:$nom[$i]";
		}
		sort($resultat);
		$table = "<table><tr>";
		for($i=0;$i<count($nom);$i++){
			$part = explode(":", $resultat[$i]);
			$photo = "<img src=\"./photos/$part[1].jpg\" height=\"100px\"/>";
			$table .= "<td><a href=\"./eleve.php?nom=$part[1]\">$photo</a><br/>$part[1]<br/>$part[0]</td>";
		}
		$table .= "</tr></table>";
		echo($table);
		echo("<a href=\"./geo.php?nomfichier=./files/$classe/_Semestre%202.txt\">Graphique</a><hr>");
	}

?>

