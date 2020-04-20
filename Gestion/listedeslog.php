<?php
	include("./haut.php");
	if(file_exists($logindeseleves)){
		$fp = fopen($logindeseleves, "r");
		$i=0;
		$content_tab = "";
		while (!feof($fp)){
			$ligne26 = fgets($fp);
			if($i!=0) $content_tab = "<tr>$ligne26</tr>".$content_tab;
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