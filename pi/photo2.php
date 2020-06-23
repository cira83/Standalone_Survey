<?php
	$image_file = isset($_GET['file'])?$_GET['file']:"";
	
	header ("Content-type: image/jpeg");
	
	if(file_exists($image_file)) readfile($image_file);
	else readfile("../Gestion/photos/----.jpg");
	
?>