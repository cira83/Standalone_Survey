<?php    	
	$classe = $_COOKIE["laclasse"];
	$Dir_TP = "./files/$classe/_Sujets2TP";
	include("./haut.php");
	include("../Dropbox.php");

	
	Dropbox("$classe - Les sujets du moment","$Dir_TP/liste.txt");

//$deroulant1 = <SELECT name="mat">
	$action = $_GET[action];
	if($action==1) {
		$rep = $_GET[mat];
		echo("<p>Création des épreuves de TP dans $rep.<br>");
		$rep_new_TP = "./files/$classe/$rep/"; //echo $rep_new_TP;
		$fp = fopen("$Dir_TP/liste.txt", "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$filename = explode(",", $ligne);
			$newfile = "$rep_new_TP$filename[0].txt";
			if(!file_exists($newfile)&($filename[0][0]!="[")) {
				echo("$newfile<br/>");
				$fp2 = fopen($newfile, "w");
				fprintf($fp2, "----::1:");
				fclose($fp2);
				$newfile = "$rep_new_TP"."_link$filename[0].txt";
				$fp2 = fopen($newfile, "w");
				fprintf($fp2, "$filename[1]\n");
				fclose($fp2);
			}
			
		}
		fclose($fp);
		echo("</p>");
	}

?>	
<!-- Nouvelles Epreuves -->
<form action="sujet2TP.php" method="get">
<table><tr>
	<td>Création des épreuves de TP :
<?php
	echo($deroulant1);
?>
	<input type="hidden" value="1" name="action">
	<input type="submit">
	</td></tr></table>
	</form>
<?php				
	$liste2 = scandir($Dir_TP);
	$file = "$Dir_TP/allfiles.txt";
	$fp = fopen($file, "w");
	foreach($liste2 as $tp) {
		$part = explode(".", $tp);
		if($part[1]&$part[0]) {
			if($pass) fprintf($fp, "\n$tp,$Dir_TP/$tp");
			else {
				$sujet2tp[$pass] = $tp;
				$pass++;
				fprintf($fp, "$tp,$Dir_TP/$tp");
			}
		}
	}
	fclose($fp);
	Dropbox("$classe - Tous les sujets",$file);
	include("./bas.php");
?>
