<script>
	function ajouter(TP) {
		lien = './sujet2TP.php?add='+TP;
		window.location.replace(lien);
	}

	function supprimer(TP) {
		lien = './sujet2TP.php?supp='+TP;
		window.location.replace(lien);
	}
	
	function delfile() {
		lien = './sujet2TP.php?suppfile=1';
		window.location.replace(lien);
	}

</script>
<?php  
	$classe = $_COOKIE["laclasse"];
	$Dir_TP = "./files/$classe/_Sujets2TP";
	$file_liste = "$Dir_TP/liste.txt";
	include("./haut.php");
	include("../Dropbox.php");
	$action = isset($_GET['action'])?$_GET['action']:"";
	$rep = isset($_GET['mat']) ? $_GET['mat'] : "";

//	Dropbox_link3("$classe - Tous les sujets version 2020","./files/$classe/_Sujets2TP/liste.txt",$classe);

	function listedessujets($repertoire,$file_liste,$classe){
		if(file_exists($repertoire)) $liste = scandir($repertoire);
		else $liste[0]="..";
		
		echo("<table>");
		$color = 1;
		for($i=2;$i<count($liste);$i++){
			$bouton = "<input type=\"button\" value=\"Ajouter\" onclick=\"ajouter('$liste[$i]')\">";
			$color = 1-$color;
			if($color) $bgcolor = "#ddd";
			else $bgcolor = "#ccc";
			$titreTP = TitreduTAG($liste[$i],$classe);
			if(estdansliste($file_liste,$liste[$i])) {
				$bouton = "<input type=\"button\" value=\"Supprimer\" onclick=\"supprimer('$liste[$i]')\">";
				$bgcolor = "#fff";
			}
			echo("<tr bgcolor=\"$bgcolor\"><td width=\"80%\"><a href=\"./sujet.php?tag=$liste[$i]\"><b>$liste[$i]</b></a> - $titreTP</td><td>$bouton</td></tr>");
		}
		echo("</table>");
	}

	function estdansliste($liste_file,$elt){
		$drap = 0;
		if(file_exists($liste_file)) {
			$fp = fopen($liste_file, "r");
			while(!feof($fp)) {
				$ligne = fgets($fp);
				if(strpos("_$ligne", $elt)) $drap = 1;
			}
			fclose($fp);
		}
		return $drap;
	}


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

	if(isset($_GET['add'])) {
		$add = $_GET['add'];
		if(file_exists($file_liste)) {
			if(!estdansliste($file_liste,$add)) {
				$fp2020 = fopen($file_liste, "a");
				fprintf($fp2020, "\n$add,");
				fclose($fp2020);
			}
		}
		else {
			$fp2020 = fopen($file_liste, "w");
			fprintf($fp2020, "$add,");
			fclose($fp2020);
		}
	}

	if(isset($_GET['supp'])) {
		$add = $_GET['supp'];
		if(file_exists($file_liste)) {
			$contenu = "";
			//lecture du fichier
			$fp2020 = fopen($file_liste, "r");
			while(!feof($fp2020)) {
				$ligne = fgets($fp2020);
				if(!strpos("_$ligne", $add)) $contenu .= $ligne;
			}
			fclose($fp2020);
			
			//écriture du fichier
			$fp2020 = fopen($file_liste, "w");
			fprintf($fp2020, $contenu);
			fclose($fp2020);
		}
	}

	if(isset($_GET['suppfile'])) {
		echo("-- Suppression de la liste --");
		unlink($file_liste);
	}



	listedessujets("./files/$classe/_Copies/_Sujets",$file_liste,$classe);


?>
<!-- Nouvelles Epreuves -->
<table><tr>
	<td>Supprimer la liste de TP :
	<input type="button" value="Supprimer" onclick="delfile();">
	</td></tr>
</table>
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
	include("./bas.php");
?>

