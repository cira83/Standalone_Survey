<?php
	$infos = $_GET['infos'];//infos='+commentaire+':'+numero+':'+rep+':';	
	$part = explode(":", $infos);
	$fp = fopen("$part[2]/CX$part[1].txt", "w");
	fwrite($fp, "$part[0]");
	fclose($fp);
?>
	