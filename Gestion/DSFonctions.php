<?php
	function icone4lettre($lettre) {
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
			$TAG = $part[1];
			fclose($fp);
		}
		return trim($TAG);
	}


?>