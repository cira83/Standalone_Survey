<?php
	$infos = $_GET['infos'];
	$part = explode(":", $infos);
	$fichier_coef = $part[0];
	$coef_matiere = $part[1];
	
	$f_coef = fopen($fichier_coef, "w");
	fwrite($f_coef, "$coef_matiere:changer_coef.php:");
	fclose($f_coef);
?>