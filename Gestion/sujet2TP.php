<?php  
	$classe = $_COOKIE["laclasse"];
	$Dir_TP = "./files/$classe/_Sujets2TP";
	include("./haut.php");
	include("../Dropbox.php");

	Dropbox_link3("$classe - Tous les sujets version 2020","./files/$classe/_Sujets2TP/liste.txt",$classe);


	$action = isset($_GET['action'])?$_GET['action']:"";
	$rep = isset($_GET['mat']) ? $_GET['mat'] : "";
	if(($action==1)&&$rep) {
		echo("<p>Création des épreuves de TP dans $rep.<br>");
		$rep_new_TP = "./files/$classe/$rep/"; //echo $rep_new_TP;
		if(file_exists("$Dir_TP/liste.txt")){
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
				}
			}
			fclose($fp);
		}
		echo("</p>");
	}

?>
<!-- Nouvelles Epreuves -->
<form action="sujet2TP.php" method="get">
<table><tr>
	<td>Création des épreuves de TP :
	<?php echo($deroulant1);?>
	<input type="hidden" value="1" name="action">
	<input type="submit">
	</td></tr>
</table>
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
