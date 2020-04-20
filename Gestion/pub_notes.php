<?php
	$filename = $_GET[file];
	$image = $_GET[filesave];

	$part = explode(".", $image);
	$image = ".".$part[1].".png";
	$part = explode(".", $filename);
	
	$part2 = explode("/", $image);?>


<html>
	<body>
	<p>Les notes de l'épreuve <b><?php echo($part[0]);?></b> des <b><?php echo($part2[2]);?></b> sont disponibles</p>
	<p><img src="<?php echo($image);?>"></p>
	</body>
</html>