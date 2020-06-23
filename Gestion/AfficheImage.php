<?php
	session_start();

	$mon_image = $_COOKIE['laimage'];
	$im_part001 = explode("/", $mon_image); // monimage = lien vers le fichier image
	$im_part002 = explode(".",$im_part001[count($im_part001)-1]);
	$format_image = $im_part002[count($im_part002)-1];
	
	header ("Content-type: image/$format_image");
	
	echo file_get_contents($mon_image);
	
?>