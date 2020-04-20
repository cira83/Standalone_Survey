<?php
	function my_GET($champ) {
		$retour = isset($_GET[$champ]) ? $_GET[$champ] : null;
		return($retour);
	}

	function my_POST($champ) {
		$retour = isset($_POST[$champ]) ? $_POST[$champ] : null;
		return($retour);
	}

	function my_array_value($array,$i){
		$retour = isset($array[$i]) ? $array[$i] : null;
		return($retour);
	}

	function my_value($champ) {
		$retour = isset($champ) ? $champ : null;
		return($retour);
	}
	
	function my_count($tab) {
		$retour = 0;
		if(is_array($tab)) $retour = count($tab);
		return($retour);
	}

// array_fill(0, 500, 0);

?>