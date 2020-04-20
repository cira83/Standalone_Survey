<?php	
	//Ecriture du fichier texte
	$listedesnotes = "";
	$listedesnoms = "";
	if(!($notes===null)) {
		for($i=0;$i<count($notes);$i++){
			if($i<count($notes)-1) {
				$listedesnotes .= rtrim("$notes[$i]").":";//pour nettoyer
				$listedesnoms .= rtrim("$noms[$i]").":";
			}
			else {
				$listedesnotes .= rtrim("$notes[$i]");
				$listedesnoms .= rtrim("$noms[$i]");
			}
		}
	}
	
	//id du graphique
	$svg_name = "no_name";
	//$svg_name = extract_name($filesave);
	$value = distribution_note($notes);
	if(!($notes===null)) {
		$moyenne = moyenne($notes);
		$image_svg = create_graphe_svg($filesave,$value,$moyenne); 
	}
	else $image_svg = create_graphe_svg($filesave,"",""); 	
	if($filesave) {
		if($notes) {
			$fp = fopen($filesave, "w");
			fprintf($fp, "$listedesnotes\n$listedesnoms");
			fclose($fp);
		}
		$filesave = str_replace("txt", "svg", $filesave);
		$fp = fopen($filesave, "w");
		fprintf($fp, "$image_svg");
		fclose($fp);		
	}

	echo($image_svg);
?>
	
