<?php
	
	function statistiques($classe,$test){
		$filename .= "./files/$classe/_Tests/_Perfs/$test.txt";
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			$nb2test = 0; $max = 0; $nb = 0;
			while(!feof($fp)){
				$line= fgets($fp);	
				$part = explode(":", $line); 
				$lg_nom = strlen($part[0]); 
				if($lg_nom>0){//Ce n'est pas une ligne vide	
					if($nb2test==0) { 
						$nom[0] = $part[0];//Premier élève de la liste
						$maxi[0] = $part[1];
						$nb = $part[2];
						$nb2test++;
						}
					else {
						$nom = nouveau_elt($part[0],$nom);//Ajoute l'élève dans la liste
						$maxi[$nb2test]= $part[1];$nb2test++;
					}
				}
			}
			fclose($fp);
		}	

		//Calcul max et min
		$max = $maxi[0];
		for($rg=1;$rg<$nb2test;$rg++) if($max<$maxi[$rg]) $max=$maxi[$rg];
		$min = $maxi[0];
		for($rg=1;$rg<$nb2test;$rg++) if($min>$maxi[$rg]) $min=$maxi[$rg];
		
		$rg_elv = count($nom);
		$stat[0] = "<a href=\"./tabdestests.php?file=$test\">$nb2test</a>";
		for($i=0;$i<count($nom);$i++) $Description .= "$nom[$i] ";
		$stat[1] = "<a title=\"$Description\">$rg_elv</a>";
		$stat[2] = "$max/$nb";
		$stat[3] = "$min/$nb";
		
		return($stat);
	}
	
	
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";

	$performances_files = "./files/$classe/_Tests/_Perfs";
	$tests_files = "./files/$classe/_Tests";
	
	include("./haut.php");
	
	
	if(!is_dir($performances_files)){
		mkdir($performances_files, 0777);
		echo("<p>Création du dossier $performances_files</p>");
	}
	
	//Liste des questionnaires
	$ListFiles = scandir($tests_files);
	sort($ListFiles);

	$j = 0;
	for($i=0;$i<count($ListFiles);$i++){
		$part = explode(".", $ListFiles[$i]);
		if(strlen($part[0])>3) {
			$test[$j] = $part[0];
			$j++;
		}
	}
	
	$blabla = "Ensemble des tests disponibles";
	titre_tab($blabla);

	$tableau = "<table>";
	$premiereligne = "<tr><td></td><td>Test</td><td>Essais</td>";
	$premiereligne .= "<td>Candidats</td>";
	$premiereligne .= "<td>Max</td>";
	$premiereligne .= "<td>Min</td>";
	$premiereligne .= "</tr>\n";
	$tableau .= $premiereligne;
	
	for($i=0;$i<count($test);$i++){
		$ligne = "<td><a href=\"./podium.php?file=$test[$i]\"><img src=\"./img/podium.png\"/></a></td>";//lien vers le podium des résultats
		$ligne .= "<td><a href=\"./editest.php?file=$test[$i]\">$test[$i]</a></td>";
		$stat = statistiques($classe,$test[$i]);
		for($k=0;$k<4;$k++) $ligne .= "<td>$stat[$k]</td>";
		$ligne .= "</tr>\n";
		if(estfichier($test[$i])) $tableau .= $ligne;	
	}
	
	$tableau .= "</table>\n";
	echo($tableau);
	$blabla = "<a href=\"./DSZone.php\">Zone de DS personnalisée</a>";
	titre_tab($blabla);
	include("./bas.php");
?>