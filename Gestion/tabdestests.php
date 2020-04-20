<?php
	include("./haut.php");
	
	$test = $_GET[file];
	affiche($test);
	$filename = "./files/$classe/_Tests/_Perfs/$test.txt";
	$i=0;
	$fp = fopen($filename, "r");
	while(!feof($fp)){
		$ligne[$i]=fgets($fp);
		$i++;
	}
	fclose($fp);
	sort($ligne);
	for($i=1;$i<count($ligne);$i++){
		$case = explode(":", $ligne[$i]); $nb2case = count($case);
		$dernier = $nb2case - 2;
		$date = $dernier-1;
		if(strlen($case[1])==1) $case[1] = "0$case[1]";
		$raw[$i-1] = "$case[0]</td><td>$case[1]/$case[2]</td><td>$case[$date]</td><td>$case[$dernier]s";
	}
	sort($raw);
	$table = "<table>";
	for($i=0;$i<count($raw);$i++){
		$table .= "<tr><td>$raw[$i]</td></tr>";
	}
	$table .= "</table>";
	echo("$table");
	
	
	//Fichier à supprimer
	$file2delete = "<a href=\"delfile.php?name=$filename&action=0\">Supprimer</a> Perfs $test";


	include("./bas.php");
?>