<?php
	function commente($com) {
		echo("<!-- $com -->\n");
	}

	
	//Fonction qui génére un tableau de lien à partir d'un fichier
	//Elle est utilisée dans Doc/index.php et dans cours.php
	function Dropbox($titre,$filename){//Version du 03/06/2019
		if($titre) echo("<h2>$titre</h2>");
		if(file_exists($filename)){
			$fp=fopen($filename, "r");
			echo("<table>");
			$k=0;
			while(!feof($fp)) {
				$ligne=fgets($fp);
				$part = explode(",",$ligne);
				if($part[1]) {//C'est une ligne normale
					if($k==0) echo("<tr align=\"left\">");//première colonne
					echo("<td><a href=\"$part[1]?name=$part[0]\" class=\"annales\" target=\"_blank\">$part[0]</a></td>");
					$k++;
				}
				else 
				if($part[0][0]!="/") {//Commentaires dans le fichier source - Permet plus de clarté dans ce fichier
					if(!strpos("_$ligne","[")) {//Cas des titres sur 3 colonnes
						if($k==0) echo("<tr align=\"left\">");
						echo("<td><p class=\"annales_blanc\">$part[0]</p></td>");
						$k++;
					}
					else {
						while($k>0){
							echo("<td></td>");
							$k++;
							if($k==3) {
								$k=0;
								echo("</tr>");
							}
						}
						$part[0] = substr($part[0], strpos("_$ligne","[" ));
						echo("<tr align=\"center\"><td colspan=3 align=center><p class=\"annales_titre\">$part[0]</p></td></tr>");
					} 
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