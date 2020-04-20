<?php  
	$classe = $_COOKIE["laclasse"];
	$Dir_TP = "./files/$classe/_Sujets2TP";
	include("./haut.php");
	include("../Dropbox.php");

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
	$pass = 0;				
	$liste2 = scandir($Dir_TP);
	$file = "$Dir_TP/allfiles.txt";
	$fp = fopen($file, "w");
	foreach($liste2 as $tp) {
		$part = explode(".", $tp);
		$part[1] = isset($part[1])?$part[1]:"";
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
	Dropbox("$classe - Tous les sujets version 2020",$file);
	include("./bas.php");
?>
