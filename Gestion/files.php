<?php    	
	$classe = $_COOKIE["laclasse"];
	//$laclassefile = "./files/$classe/_Profils.txt";
	include("./haut.php");

	$action2020 = isset($_GET['action'])?$_GET['action']:"";
	if($action2020==1){
		$filename = $_POST['filename'];
		$oui = "<form action=\"./files.php?action=2\" method=\"post\"> <input type=\"hidden\" name=\"filename\" value=\"$filename\"> <input type=\"submit\" value=\"OUI\"></form>";
		$non = "<form action=\"./files.php\" method=\"post\"> <input type=\"submit\" value=\"NON\"></form>";
		affiche("Voulez vous r&eacute;ellement supprimer $filename ? $oui$non");
	}
	if($action2020==4){
		$nom2020 = $_GET['rep'];
		$rep_1 = "./files/$classe/_Copies/$nom2020/rep";
		if(file_exists($rep_1)) rmdir($rep_1);
		$rep_2 = "./files/$classe/_Copies/$nom2020";
		if(file_exists($rep_2)) rmdir($rep_2);
	}	
	
	if($action2020==2){
		$filename = $_POST['filename'];
		$directory = "./files/$classe/_Copies/_Poubelle";
		if(!file_exists($directory)) {
			mkdir($directory);
			affiche("$directory crée");
		}
		$part = explode("/", $filename);
		$name1 = $part[count($part)-1];
		$newname = "$directory/$name1";
		
		rename($filename, $newname);
		affiche("Le fichier $filename est");
		affiche("déplacé vers $newname");

	}
	
	$repertoire_Copies = "./files/$classe/_Copies";
	$leleve2 = scandir($repertoire_Copies);
	
	
	for($i=2;$i<count($leleve2);$i++){
		$nomelv = $leleve2[$i];
		$directory = "./files/$classe/_Copies/$nomelv";
		$listedesfichiers = scandir($directory);
		$k=0;
		for($j=0;$j<count($listedesfichiers);$j++) {
			if(pasdossier($listedesfichiers[$j])){
				$supprimer = "<form action=\"./files.php?action=1\" method=\"post\"><input type=\"hidden\" name=\"filename\" value=\"$directory/$listedesfichiers[$j]\"><input type=\"submit\" value=\"Supprimer\"></form>";
				$icone = icone2($listedesfichiers[$j]);
				$listetext[$k]="<td><a href=\"$directory/$listedesfichiers[$j]\">$listedesfichiers[$j]</a></td><td width=\"20px\">$icone</td><td width=\"100px\">$supprimer</td>";
				$k++;
			}
		}		
	
		echo("<table><tr>");
		if($k>0) {
			echo("<td ROWSPAN=\"$k\" width=\"15%\">$nomelv</td>");
			echo("$listetext[0]");
		}
		else {
			if(in_array($nomelv, $leleve)) $affiche = "<td  width=\"50%\">Le repertoire vide de</td><td><font color=\"blue\">$nomelv</font></td>";
			else $affiche = "<td  width=\"50%\"><a href=\"./files.php?action=4&rep=$nomelv\">Supprimer</a> repertoire vide de </td><td><font color=\"red\">$nomelv</font></td>";
			if(strpos("*$nomelv", "_")==1) $affiche = "<td  width=\"50%\">Le repertoire spécial</td><td><font color=\"blue\">$nomelv</font></td>";;
			echo($affiche);
		}
		echo("</tr>");
		
		for($j=1;$j<$k;$j++) {
			echo("<tr>");
			echo("$listetext[$j]");
			echo("</tr>");	
		}
		
		echo("</table>");	
	}
	
	include("./bas.php");
?>