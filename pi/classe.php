<?php		
	$fp = fopen("../Gestion/files/_Sujet_Ouvert.txt", "r");
	$ligne = fgets($fp);
	fclose($fp);
	
	echo($ligne);
?>