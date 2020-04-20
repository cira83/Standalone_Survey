<?php
	function netoyage($laclassefile){
		$fichierdenom = fopen($laclassefile, "r"); 
		$k = 0;
		$nb2lignes = 0;
		while (!feof($fichierdenom)){
			$ligne123 = fgets($fichierdenom); $nb2lignes++;
			$leseleves = explode(":", $ligne123);
			$nouveau = true;
			for($i=0;$i<$k;$i++){
				if($leseleves[0]==$unleve[$i]) {
					$nouveau = false;
					$leslignes[$i] = rtrim($ligne123);//Enlève les caratéres inutiles en fin de chaine
				}
			}
			if($nouveau){
				$unleve[$k] = $leseleves[0];
				if($leseleves[8]!="oui") $leslignes[$k] = rtrim($ligne123); //seulement si pas démissionnaire
				$k++;
			}
		}
		fclose($fichierdenom);
	
		sort($leslignes);
		$fichierdenom = fopen($laclassefile,"w");
		if($fichierdenom){
			for($i=0;$i<count($leslignes)-1;$i++) {
				fprintf($fichierdenom, $leslignes[$i]."\n");
			}
			fprintf($fichierdenom, $leslignes[$i]);
			fclose($fichierdenom);
			$nb2lignes2 = $i;
		}
		else echo("<p>Je ne peux pas enregistrer le nouveau fichier</p>");
	}
?>