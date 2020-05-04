<?php
	$infos = $_GET[nota];
	$part = explode(":", $infos);
	
	$filename = "./files/$part[0]/_Copies/$part[1]/rep/$part[4]/N$part[3].txt";
	$fp = fopen($filename, "w");
	fwrite($fp, "$part[2]\n");
	fclose($fp);
?>