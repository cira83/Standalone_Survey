<?php
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe="CIRA1";
	$TAG = $_GET[TAG];

	function est_image($image) {
		$type_img = array("jpg","jpeg","gif","png");
		
		$part = explode(".",rtrim($image));
		$ext = $part[count($part)-1];
		return(in_array($ext,$type_img));
	}
	

	$repertoire = "./files/$classe/_Copies/_Sujets/$TAG/img/";
	$liste_img = scandir($repertoire);
	foreach($liste_img as $img) //echo("$img<br>");
	if(est_image($img)) echo("<a href=\"$repertoire$img\"><img src=\"$repertoire$img\" width=\"200px\"/></a><br>$img<hr>");
?>
