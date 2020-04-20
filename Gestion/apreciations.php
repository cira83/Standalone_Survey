<?php
	$classe = $_COOKIE["laclasse"];
	$titre_page = "Conseil $classe";
	include("./haut.php");
	
	
	$Sem1_file = "./files/$classe/_Semestre 1.txt";
	if(file_exists($Sem1_file)){
		$fp = fopen($Sem1_file, "r");
		$ligne = fgets($fp);
		$note1 = explode(":", $ligne);
		fclose($fp);
	} else echo("$Sem1_file not exist !!");
		
	$Sem2_file = "./files/$classe/_Semestre 2.txt";
	if(file_exists($Sem2_file)){
		$fp = fopen($Sem2_file, "r");
		$ligne = fgets($fp);
		$note2 = explode(":", $ligne);
		fclose($fp);
	} else echo("$Sem2_file not exist !!");

	
	$filename = "./files/$classe.txt";
	
	if(file_exists($filename)){
		echo("<table><tr bgcolor=\"#ffffff\"><td width=\"120px\">Noms</td><td>Appréciations - $classe</td></tr></table>");
		$fp = fopen($filename, "r");
		$i = 0;
		while(!feof($fp)){
			$ligne = fgets($fp); //echo("<p>$ligne</p>");
			$part = explode(":", $ligne);
			echo("<table><tr><td width=\"120px\"><b>$part[0]</b><br/>$part[1]<br/>$part[2]</td><td align=\"left\"><font color=\"blue\">$note1[$i] :</font> $part[9]<br/><font color=\"blue\">$note2[$i] :</font> $part[10]</td></tr></table>");
			$i++;
		}
		fclose($fp);
	} 
	else {
		echo("Le fichier $filename n'existe pas !!");
	}
	
	include("./bas.php");
?>

