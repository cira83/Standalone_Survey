<?php
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	include("./haut.php");
	$test = $_GET[file];
	
	
	$filename = "./files/$classe/_Tests/_Perfs/$test.txt"; //echo("$filename");
	$i=0;
	$fp = fopen($filename, "r");
	while(!feof($fp)){
		$ligne[$i]=fgets($fp);
		$i++;
	}
	fclose($fp);
	sort($ligne);//Pour mettre dans l'ordre. La première ligne est vide
	
	//Création du tableau des participants et des performances
	$part = explode(":", $ligne[1]);
	$j=0;
	$nom = $part[0];
	$note = $part[1];
	$temps = $part[count($part)-2];	//echo("<p>-!0:$nom:$note:$temps</p>");
	$sportif[$j] = $nom;
	$perf[$j] = $note;
	$time[$j] = $temps;
	
	for($i=2;$i<count($ligne);$i++){
		$part = explode(":", $ligne[$i]); 
		$nom = $part[0];
		$note = $part[1];
		$temps = $part[count($part)-2]; //echo("<p>-0$i:$nom:$note:$temps</p>");
		if($nom!=$sportif[$j]){//Nouveau nom dans la liste classée
			$j++;
			$sportif[$j] = $nom;
			$perf[$j] = $note;
			$time[$j] = $temps;
		}
		else {
			if($note>$perf[$j]){//Le même avec un meilleur résultat
				$perf[$j]= $part[1];
				$time[$j] = $temps; //echo("<p>-1$i:$nom:$note:$temps</p>");
			}
			if($note==$perf[$j]){//Le même avec le même résultat
				if($temps<$time[$j]) $time[$j] = $temps;//le temps plus court
			}
		}
		//echo("<p>$j:$sportif[$j]:$perf[$j]:$temps[$j]</p>");
	}
	
	
	
	//Classement des candidats
	for($i=0;$i<count($sportif);$i++){
		$place[$i]=1;
		for($j=0;$j<count($sportif);$j++){
			if($perf[$j]>$perf[$i]) $place[$i]++;
			if(($perf[$j]==$perf[$i])&($time[$j]<$time[$i])) $place[$i]++;
		}
	}
	
	for($i=0;$i<count($sportif);$i++){
		$ligne_tab[$place[$i]-1].= "<tr><td>$place[$i]</td><td>$sportif[$i]</td><td>$perf[$i]</td><td>$time[$i] s</td></tr>";
		//$ligne_tab[$i].= "<tr><td>$place[$i]</td><td>$sportif[$i]</td><td>$perf[$i]</td><td>$time[$i] s</td></tr>";
	}
	
	$tableau = "<table><tr><td bgcolor=\"#fff\"><font size=\"+2\" color=\"#000\">Classement des candidats - $test</font></td></tr></table>";
	$tableau .= "<table><tr bgcolor=\"#ff0\"><td>Rang</td><td>Nom</td><td>Performance</td><td>Dur&eacute;e</td></tr>";
	for($j=0;$j<count($sportif);$j++) $tableau .= $ligne_tab[$j];
	$tableau .= "</table>";
	echo("$tableau");
			
?>
<!-- Pour recharger la page -->
<script type="text/javascript">
	window.setTimeout("window.location.reload();",7000);
</script>


