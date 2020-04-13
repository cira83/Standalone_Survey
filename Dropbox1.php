<?php
	
	//Fonction qui génére un tableau de lien à partir d'un fichier
	//Elle est utilisée dans Doc/index.php et dans cours.php
	function Dropbox($titre,$filename){//Version du 07/05/2019
		if($titre) echo("<h2>$titre</h2>");
		if(file_exists($filename)){
			$fp=fopen($filename, "r");
			echo("<table ><tr align=\"left\">");
			$k=0;
			while(!feof($fp)) {
				$ligne=fgets($fp);
				$part = explode(",",$ligne);
				if($part[1]) {
					echo("<td><a href=\"$part[1]\" class=\"annales\" target=\"_blank\">$part[0]</a></td>");
					$k++;
				}
				else if($part[0][0]!="/") {//Commentaires dans le fichier source - Permet plus de clarté dans ce fichier
					echo("<td><p class=\"annales_blanc\">$part[0]</p></td>");
					$k++;	
				}

				if($k==3){
					$k=0;
					echo("</tr><tr align=\"left\">");
				}
			}
			echo("</tr></table>");
			fclose($fp);
		}
		else echo("Le fichier $filename n'existe pas !!");
	}		
?>