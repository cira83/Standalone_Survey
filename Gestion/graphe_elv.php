<?php
	header ("Content-type: image/png");
	$filesave = $_GET[filename];
	$note = $_GET[note];
	
	
	if(!file_exists($filesave)) $filesave="./graphe.png";
	
	
	$image07 = imagecreatefrompng($filesave);
	$rouge = imagecolorallocate ($image07, 255, 0, 0 );//defini le rouge dans l'image
	
	
	//$note = 15;
	
	if($note!=""){
		$xm = $note/2;
		$y = 3;
		$x = 6+$xm*39;
		imagefilledrectangle($image07,$x,31,$x+1,$y,$rouge);
	}
	
	
	imagepng($image07);
?>