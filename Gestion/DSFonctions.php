<?php
	function menu_lien($filename,$classe,$TAG){//// Retourne le menu des liens - Filename nom du fichier contenant titre,lien,
		$menu = "<select id=\"menu_lien\" onchange=\"charge_lien(this);\">\n";
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			$menu .= "<option>----</option>\n";
			while(!feof($fp)){
				$ligne = fgets($fp);
				$part = explode(",", $ligne);
				$menu .= "<option value=\"$part[1]\">$part[0]</option>\n";
			}
			fclose($fp);
		}
		else $menu .= "</option>$filename not found</option>\n";
		
		//Ajout des images
		$repertoire_image = "./files/$classe/_Copies/_Sujets/$TAG/img"; 

		$liste_images = scandir($repertoire_image);
		for($i=2;$i<count($liste_images);$i++){
			$menu .= "<option value=\"$repertoire_image/$liste_images[$i]\">$liste_images[$i]</option>\n";
		}
		
		$menu .= "</select >\n";
		return($menu);
	}
	
	function lien_vers($filename,$titre) {//// Retourne le lien pour javascript
		$lien = "";
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			while(!feof($fp)){
				$ligne = fgets($fp);
				$part = explode(",", $ligne);
				if($titre==$part[0]) $lien = $part[1];
			}
			fclose($fp);
		}
		return($lien);				
	}
	
	
	function icone4lettre($lettre) {
		$icone = "";
		$SUP = "<img src=\"icon/Moins.gif\" title=\"Supprimer\"/>";
		$C = "<img src=\"icon/C_vert.gif\" title=\"Commentaire\"/>";
		$Mod = "<img src=\"icon/Editer.gif\" title=\"Mofifier\/>";
		$Q = "<img src=\"icon/Q_vert.gif\" title=\"Question\"/>";
		$T = "<img src=\"icon/T_vert.gif\" title=\"R&eacute;ponse courte\"/>";
		$U = "<img src=\"icon/Ligne.gif\" title=\"R&eacute;ponse longue\"/>";
		$I = "<img src=\"icon/I_vert.gif\" title=\"R&eacute;ponse image\"/>";
		$L = "<img src=\"icon/Page.gif\" title=\"Saut de page\"/>";
		switch($lettre) {
			case "X": $icone = $SUP; break;
			case "C": $icone = $C; break;
			case "M": $icone = $Mod; break;
			case "Q": $icone = $Q; break;
			case "T": $icone = $T; break;
			case "U": $icone = $U; break;
			case "I": $icone = $I; break;
			case "L": $icone = $L; break;
		}
		return($icone);
	}


	function est_image($image) {
		$type_img = array("jpg","jpeg","gif","png","JPG","JPEG","GIF","PNG");

		$part = explode(".",rtrim($image));
		$ext = $part[count($part)-1];
		return(in_array($ext,$type_img));
	}


	function TAGdufichier($filename) {
		$TAG = "TD?";
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$TAG = isset($part[1])?$part[1]:"";
			fclose($fp);
		}
		return trim($TAG);
	}

	function TitreduTAG($TAG,$classe) {
		$filename = "./files/$classe/_Copies/_Sujets/$TAG/index.htm";
		$Titre = "Titre?";
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$Titre = $part[0];
			fclose($fp);
		}
		return trim($Titre);
	}

	function myintdiv($dividend,$divisor){
		$frac = 0;
		while($dividend-$divisor>=0) {
			$frac++;
			$dividend = $dividend-$divisor;
		}
		return($frac);
	}

	function magiqueNB($nd_elv,$max){
		$div = myintdiv($nd_elv,$max);
		$reste = $nd_elv-$div*$max;
		while(($max-$reste>$div)&&$reste) {
			$max--;
			$div = myintdiv($nd_elv,$max);
			$reste = $nd_elv-$div*$max;
		}
		return $max;
	}

	function get_commentaire($filename){
		$retour = "";
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$retour = fgets($fp);
			fclose($fp);
		}
		return($retour);
	}
	


?>
