<?php 
	if(!function_exists("my_array_value")) 	include("lespetitesfonctions.php");
	$infos = my_GET("infos");
	
	$id = "";
	$filtre = "";
	if($infos) {
		$info = explode(":", $infos);
		$id = $info[0];
		$filtre = $info[1];
	}
	echo("<!-- id=$id  filtre=$filtre -->\n");
	
	
	$classe = $_COOKIE['laclasse'];
	$logindeseleves = "./files/$classe/_logindeseleves.txt";
	if(file_exists($logindeseleves)){
		$fp = fopen($logindeseleves, "r");
		$i=0;
		$content_tab = "";
		while (!feof($fp)){
			$ligne26 = fgets($fp);
			$part = explode("<td>", $ligne26);
			$ligne1 = "<tr>$ligne26</tr>";
			$part_2 = my_array_value($part,2);
			$part_3 = my_array_value($part,3);
			$part_5 = my_array_value($part,5);
			if(strpos("_$part_3", "1")) $ligne1 = "<tr bgcolor=\"white\">$ligne26</tr>";
			if(strpos("_$part_3", "0")) $ligne1 = "<tr bgcolor=\"red\">$ligne26</tr>";
	
	//echo("<!-- id=$id  $part_5!=$filtre</td> ? -->\n");
	
	
			$part_5 = rtrim($part_5);
			if(strlen($filtre)) {
				if(($id==2)&&($part_2!="$filtre</td>")) $ligne1 = "";
				if(($id==3)&&($part_3!="$filtre</td>")) $ligne1 = "";
				if(($id==5)&&($part_5!="$filtre</td>")) $ligne1 = "";
			}
			$content_tab = $ligne1.$content_tab;
		}
		fclose($fp);
		
		echo("<tr bgcolor=\"yellow\"><td>Classe</td><td>Nom</td><td>Type</td><td>Date</td><td>IP</td></tr>");
		echo($content_tab);
		
		//Fichier à supprimer
		$file2delete = "<a href=\"delfile.php?name=$logindeseleves&action=0\">Supprimer</a> $logindeseleves";
	}
	else $content_tab = "<tr><td>Pas de fichier log disponible</td></tr>";	
	
		
?>