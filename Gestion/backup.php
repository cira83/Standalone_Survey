<?php    	
	$classe = $_COOKIE["laclasse"];
	include("./haut.php");
	$lerepertoire = "./files/$classe";
	
	function estunecopie($tab_epr,$nom_fichier){//Ne sert pas
		$drap = "";
		foreach($tab_epr as $epreuve) if(strstr("_$nom_fichier", $epreuve)) $drap = $epreuve;
		return $drap;
	}
	
	function lesnotes2($classe,$mat,$epr){
		$drap = false;
		$filename = "./files/$classe/$mat/_$epr.txt";
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			$ligne1 = fgets($fp);
			$ligne2 = fgets($fp);
			fclose($fp);
			$drap = "$ligne1$ligne2";
		}
		
		return $drap;
	}
	
	
	if(password($nom,$password,$classe)){
		$filename = "./files/_index_$classe.htm";
		affiche("Backup de $classe dans <a href=\"$filename\">_index_$classe.htm</a>");
		$fp=fopen($filename, "w");
		$modele = fopen("./modele.htm", "r");
		while(!feof($modele)){
			$ligne = fgets($modele);
			fwrite($fp, $ligne); //recopie le modèle	
		}
		
		//Début du travail
		
		fwrite($fp, "<center><h1>$classe</h1></center>");	
		
		foreach($lepreuve1 as $epreuve)	{
			$part = explode(".", $epreuve);
			echo("$part[0] - $part[2]<br/>");//$part[2] = matière et $part[0] = épreuve
			
			$lesnotes = lesnotes2($classe,$part[2],$part[0]);
			if($lesnotes) {
				$ext[0] = "pdf";
				$ext[1] = "pro";
				
				fwrite($fp, "<h3>$part[2] - $part[0]</h3>");
				$notenom = explode("\n", $lesnotes);
				$note_elv = explode(":", $notenom[0]);
				$nom_elv = explode(":", $notenom[1]);
				for($i=0;$i<count($note_elv);$i++){
					$information = "$nom_elv[$i] : $note_elv[$i] : ";
					$drap = false;
					for($k=0;$k<count($ext);$k++){
						$nomdufichier = "/$classe/_Copies/$nom_elv[$i]/$part[0] $nom_elv[$i].$ext[$k]";
						if(file_exists("./files/$nomdufichier")) {
							$drap = true;
							$information .= "<a href=\"./$nomdufichier\">Fichier $ext[$k]</a> ";
						}								
					}
					if($drap) fwrite($fp, "$information<br>");						
				}

				
				
			}
		}

		
		
		
		//Cloture du fichier htm
		fwrite($fp, "\n</body></html>");
		fclose($fp);
	}
	
	include("./bas.php");
?>