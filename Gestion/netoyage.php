<?php
	function netoyage($laclassefile1,$laclassefile2){
		$fichierdenom = fopen($laclassefile1, "r"); 
		$k = 0;
		$nb2lignes = 0;
		while(!feof($fichierdenom)){
			$ligne123 = fgets($fichierdenom); 
			$nb2lignes++;
			$leseleves = explode(":", $ligne123);
			
			$nouveau = 1;
			for($i=0;$i<$k;$i++){// Cherche si déjà trouvé
				if($leseleves[0]==$unleve[$i]) {
					$nouveau = 0;
					$leslignes[$i] = rtrim($ligne123);//Enlève les caratéres inutiles en fin de chaine
				}
			}
			
			if($nouveau==1){// Pas déjà trouvé
				$unleve[$k] = $leseleves[0];
				$leslignes[$k] = rtrim($ligne123); //seulement si pas démissionnaire
				$k++;
			}
			
		}
		fclose($fichierdenom);
	
		sort($leslignes);
		
		$fichierdenom = fopen($laclassefile2,"w");
		$num_ligne = 0;
		if($fichierdenom){
			for($i=0;$i<count($leslignes);$i++) {
				$part = explode(":",$leslignes[$i]);
				$newline = "$part[0]:$part[1]:$part[2]:$part[3]:$part[4]:$part[5]:$part[6]:$part[7]:non:$part[9]:$part[10]:$part[11]:$part[12]:";
				if($part[8]!="oui") {
					if(!$num_ligne) {
						fprintf($fichierdenom, $newline);
						$num_ligne = 1;
					}
					else fprintf($fichierdenom, "\n".$newline);
				}
			}
			fclose($fichierdenom);
		}
		else 
			echo("<p>Je ne peux pas enregistrer le nouveau fichier</p>");
	}
?>