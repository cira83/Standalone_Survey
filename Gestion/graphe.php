<?php
	header ("Content-type: image/png");
	$filesave = $_GET[filename];
	$notes = explode(":", $_GET[notes]);
	$noms = explode(":", $_GET[noms]);
	
	function moyenne($notes){
		$sigma = 0;
		for($i=0;$i<count($notes);$i++) $sigma += $notes[$i];
		if($i>0) $moyenne = $sigma/$i;
		else $moyenne = "---";
		
		return $moyenne;
	}
	
	function graphe07($notes,$filesave){
		$image07 = imagecreatefrompng("./graphe.png");
		$jaune = imagecolorallocate ($image07, 240, 240, 0 );//defini le jaune
		$noir = imagecolorallocate ($image07, 0, 0, 0 );//defini le noir
		$rouge = imagecolorallocate ($image07, 255, 0, 0 );//defini le rouge
		
		for($i=0;$i<count($notes);$i++) $haut[$i]=0;
		for($i=0;$i<count($notes);$i++){
			$lanote = $notes[$i]/2;
			$part = explode(".", $lanote);
			$haut[$part[0]]++;
		}
		$max = 0;
		$haut[9]+=$haut[10];
		for($i=0;$i<10;$i++) if($max<$haut[$i]) $max = $haut[$i];
		
		if(($max>0)&&((count($notes)>1)||($notes[0]>0))){
			$step = 30/$max;
			for($i=0;$i<$max;$i++){//Horizontales
				$y = 2 + $step*$i;
				imageline($image07,2,$y,394,$y,$noir);
			}
		
		
			for($i=0;$i<10;$i++){
				$y = 32 - $step*$haut[$i];
				$x = 6+$i*39;
				if($haut[$i]>0) {
					imagefilledrectangle($image07,$x,32,$x+30,$y,$jaune);
					imagerectangle($image07,$x,32,$x+30,$y,$noir);
				}
			}
			
			//Moyenne
			$moyenne = moyenne($notes);
			if($moyenne!="---") {
				$xm = $moyenne/2;
				$y = 3;
				$x = 6+$xm*39;
				imagefilledrectangle($image07,$x,31,$x+1,$y,$noir);
			}
		}
		
		$file_image = str_replace("txt", "png", $filesave);
		imagepng($image07,$file_image);
		
		return($image07);
	}	
	
	//Fichier texte
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
	$fp = fopen($filesave, "w");
	fprintf($fp, "$listedesnotes\n$listedesnoms");
	fclose($fp);
	
	$image07 = graphe07($notes,$filesave);
	imagepng($image07);
?>