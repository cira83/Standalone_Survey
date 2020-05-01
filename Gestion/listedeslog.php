<?php
	include("./haut.php");
	//$logindeseleves = "./files/$classe/_logindeseleves.txt";

	echo("<!-- $logindeseleves -->");
	if(file_exists($logindeseleves)){
		$fp = fopen($logindeseleves, "r");
		$i=0;
		$content_tab = "<tr bgcolor=\"white\"><td>Classe</td><td>Nom</td><td>Etat</td><td>Date</td><td>IP</td></tr>";
		while (!feof($fp)){
			$ligne26 = fgets($fp);
			$content_tab .= "<tr>$ligne26</tr>";
			$i++;
		}
		fclose($fp);
		
		//Fichier à supprimer
		$file2delete = "<a href=\"delfile.php?name=$logindeseleves&action=0\">Supprimer</a> $logindeseleves";
	}
	else $content_tab = "<tr><td>Pas de fichier log disponible</td></tr>";
	
	echo("<table>");
	echo($content_tab);
	echo("</table>");
	
	include("./bas.php");
?>