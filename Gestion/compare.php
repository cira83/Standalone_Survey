<?php include("./haut.php");?>


<?php
	$mat = $_GET[mat];
	$epr_part = explode(".",$_GET[epr]);
	$epr = $epr_part[0];
	$laclasse = $_GET[classe];

	tableau("Je compare les copies $epr dans le r&eacute;pertoire $mat des $laclasse");
	$repertoire_copies = "./files/$laclasse/_Copies"; //affiche($repertoire_copies);
	
	if(file_exists($repertoire_copies)){
		$lesrep = scandir($repertoire_copies);
	} 
	else {
		affiche("Le répertoire $repertoire_copies n'existe pas !!!");
	}
	
	$indice = 0;
	foreach($lesrep as $rep){
		if(estfichier($rep)) {
			//affiche($rep);
			$lescopies = scandir("$repertoire_copies/$rep");
			foreach($lescopies as $copie){
				if(strpos("_".$copie, $epr)){
					$md5 = md5_file("$repertoire_copies/$rep/$copie");
					$date5 = filemtime("$repertoire_copies/$rep/$copie");
					if($indice){
						$vu = false; 
						for($i=0;$i<$indice;$i++){//regarde si pas déjà vu
							if($lesmd5[$i]==$md5) {
								$element[$i] .= ":$date5;$copie";
								$vu = true;
							}
						}
						if(!$vu){//Nouveau
							$element[$indice] = "$md5:$date5;$copie"; 
							$lesmd5[$indice] = $md5;
							$indice++;
						}
					}
					else {//Premier élément
						$element[$indice] = "$md5:$date5;$copie"; 
						$lesmd5[$indice] = $md5;
						$indice++;
					}
				}
			}
		}
	}
	
	foreach($element as $elt){
		$part = explode(":", $elt);
		if(count($part)>2) {
			$ligne23 = "$part[1]";
			for($i=2;$i<count($part);$i++){
				$ligne23 .= "/$part[$i]";
			}
			$part2 = explode("/",$ligne23);
			sort($part2);
			$part3 = explode(";", $part2[0]);
			$ligne24 = "<font color=\"blue\">$part3[1]</font>";
			for($i=1;$i<count($part2);$i++){
				$part3 = explode(";", $part2[$i]);
				$ligne24 .= "/$part3[1]";
			}
			affiche("$ligne24");
		}
	}
	
	
	
?>


<?php 	include("./bas.php");?>