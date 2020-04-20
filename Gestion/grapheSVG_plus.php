<?php 
	//Utilise le graphique svg déjà généré et ajoute le moyenne de l'élève
	function graphe_plus($lanote,$filename){
		$retour = "";
		$i=0;
		$x = 2+floatval($lanote)*20-1;
		if($x>397) $x=397;
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			while(!feof($fp)) {
				$i++;
				$ligne = fgets($fp);
				if($i>30) {
					$ligne = str_replace("###", "$x", $ligne);
				}
				$retour .= $ligne;
				
			}
			fclose($fp);
		}
		else $retour = "$filename ?";
		
		return($retour);
	}
?>