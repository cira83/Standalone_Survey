<?php    	
	$classe = $_COOKIE["laclasse"];
	$laclassefile = "./files/$classe.txt";
	include("./haut.php");

	$action2020 = isset($_GET['action'])?$_GET['action']:"";
	if($action2020==1){
		$filename = $_POST['filename'];
		$oui = "<form action=\"./files.php?action=2\" method=\"post\"> <input type=\"hidden\" name=\"filename\" value=\"$filename\"> <input type=\"submit\" value=\"OUI\"></form>";
		$non = "<form action=\"./files.php\" method=\"post\"> <input type=\"submit\" value=\"NON\"></form>";
		affiche("Voulez vous r&eacute;ellement supprimer $filename ? $oui$non");
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
	
	for($i=0;$i<count($leleve);$i++){
		$nomelv = $leleve[$i];
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
		//Le repertoire des réponses 20 decembre 2017
		$directory = "./files/$classe/_Copies/$nomelv/rep";
		$listedesfichiers = scandir($directory);		
		for($j=0;$j<count($listedesfichiers);$j++) {
			if(pasdossier($listedesfichiers[$j])){
				$supprimer = "<form action=\"./files.php?action=1\" method=\"post\"><input type=\"hidden\" name=\"filename\" value=\"$directory/$listedesfichiers[$j]\"><input type=\"submit\" value=\"Supprimer\"></form>";
				$icone = icone2($listedesfichiers[$j]);
				$listetext[$k]="<td><a href=\"$directory/$listedesfichiers[$j]\">$listedesfichiers[$j]</a></td><td width=\"20px\">$icone</td><td width=\"100px\">$supprimer</td>";
				$k++;
			}
		}
				
		
		if($k>0){
			echo("<table><tr>");
			echo("<td ROWSPAN=\"$k\" width=\"15%\">$nomelv</td>");
			echo("$listetext[0]");
			echo("</tr>");
		}
		for($j=1;$j<$k;$j++) {
			echo("<tr>");
			echo("$listetext[$j]");
			echo("</tr>");	
		}
		if($k>0) echo("</table>");	
	}
	
	
	
	include("./bas.php");
?>