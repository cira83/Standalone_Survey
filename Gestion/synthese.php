<?php include("./haut.php");?>

<?php
	$ligne1 = array_fill(0, 100, "");
	$ligne2 = array_fill(0, 100, "");
	$ligne = array_fill(0, 100, "");
	$somme_moyenne1 = array_fill(0, 20, 0);
	$somme_moyenne2 = array_fill(0, 20, 0);
	$somme_coef1 = array_fill(0, 20, 0);
	$somme_coef2 = array_fill(0, 20, 0);
	$somme_moyenne_epreuve = 0;
	$coef_epreuve = 0;
	$somme_semestre1 = 0;
	$somme_semestre2 = 0;
	$total_semestre1 = 0;
	$total_semestre2 = 0;
	$somme_annee = 0;
	$total_anne = 0;
	
	
	//PREMIERE COLONNE
	$ligne[0] = "<td></td>";
	for($i=0;$i<count($leleve);$i++){
		
		$ligne[$i+1] = "<td><a href=\"./eleve.php?nom=$leleve[$i]\">$leleve[$i]</a></td>";
		
	}
	
	//SUIVANTES
	for($j=0;$j<count($tableaudesmatieres);$j++){
		$periode = periode($tableaudesmatieres[$j]);//fournie la periode des epreuves
		$lelien6 = "<a href=\"./matiere.php?mat=$tableaudesmatieres[$j]\">";
		$tableaudesmatieres_j = my_array_value($tableaudesmatieres,$j);
		if($periode==1) $ligne1[0] .= "<td>---></td><td>$lelien6$tableaudesmatieres_j</a></td>";
		else $ligne2[0] .= "<td>---></td><td>$lelien6$tableaudesmatieres[$j]</a></td>";
		$repertoire = "./files/$classe/$tableaudesmatieres[$j]";
		$eprsynth = scandir($repertoire);
		sort($eprsynth);
		$l=0;
		for($i=0;$i<count($leleve);$i++) {
			if($periode==1) $ligne1[$i+1] .= "<td><font size=\"-1\">";
			else $ligne2[$i+1] .= "<td><font size=\"-1\">";
			$som[$i] = 0;
			$nbnote[$i] = 0;
		}
		while($l < count($eprsynth)){
			if(estfichier($eprsynth[$l])){
				$filename = $repertoire."/$eprsynth[$l]"; //echo("<p> ----> $filename");
				$fp = fopen($filename, "r");
				$m = 0;
				if($fp){
					while(!feof($fp)){
						$fileline[$m] = fgets($fp);
						$m++;
					}
				}
				//echo(":$m</p>");
				for($i=0;$i<count($leleve);$i++){
					$lanote = "#";
					for($n=0;$n<$m;$n++){
						$leselts2 = explode(":", $fileline[$n]);//Les différents élements de la ligne considérée						
						if(dansgroupe($leselts2[0],$leleve[$i])) {//Si l'éleve fait partie du groupe
							$lanote = $leselts2[1];
							if($lanote=="") $lanote = "#";
							if($leselts2[3]=="Non Fait") $lanote = "#";//15 janvier 2019
							$lecoef = $leselts2[2];
						}

					}
					if($periode==1) $ligne1[$i+1] .= "$lanote "; else $ligne2[$i+1] .= "$lanote ";
					if($lanote!="#"){
						if($lecoef=="") $lecoef = 1; //Coef = 1 par defaut
						$som[$i] += floatval($lanote)*floatval($lecoef);
						$nbnote[$i] += $lecoef;
					}
				}
			}
			$l++;
		}
		for($i=0;$i<count($leleve);$i++) {
			if($nbnote[$i]>0) {
				$lamoyenne = number_format($som[$i]/$nbnote[$i],2);
				$coefmat = coefmat($tableaudesmatieres[$j]); //
				if($periode==1) $somme_moyenne1[$i+1]+= $lamoyenne*$coefmat;
				else $somme_moyenne2[$i+1]+= $lamoyenne*$coefmat;
				if($periode==1) $somme_coef1[$i+1]+= $coefmat;
				else $somme_coef2[$i+1]+= $coefmat;
			}
			else $lamoyenne = "#";
			if($periode==1) {
				$ligne1[$i+1] .= "</font></td><td>$lamoyenne</td>";
				if($lamoyenne!="#") {
					$somme_moyenne_epreuve += $lamoyenne;
					$coef_epreuve++;
				}
			}
			else {
				$ligne2[$i+1] .= "</font></td><td>$lamoyenne</td>";
				if($lamoyenne!="#") {
					$somme_moyenne_epreuve += $lamoyenne;
					$coef_epreuve++;
				}				
			}
		}
		
		//Création de la dernière ligne, moyenne de la classe...
		$ligne[count($leleve)+1] = "<td><font color=\"yellow\">Classe</font></td>";
		if($periode==1) {
			if($coef_epreuve) $moyenne_classe_epreuve = number_format($somme_moyenne_epreuve/$coef_epreuve,2);
			else $moyenne_classe_epreuve = "#";
			$ligne1[count($leleve)+1] .= "<td><font color=\"yellow\">---></font></td><td><font color=\"yellow\">$moyenne_classe_epreuve</font></a></td>";
		}
		else {
			if($coef_epreuve) $moyenne_classe_epreuve = number_format($somme_moyenne_epreuve/$coef_epreuve,2);//###
			else $moyenne_classe_epreuve = "#";
			$ligne2[count($leleve)+1] .= "<td><font color=\"yellow\">---></font></td><td><font color=\"yellow\">$moyenne_classe_epreuve</a></font></td>";
		}
		$somme_moyenne_epreuve = 0; //RAZ
		$coef_epreuve = 0; //RAZ
	}
	
	//Construction du tableau
	$tableau = "<table class=\"C100\">";
	$ligne[0] .= "$ligne1[0] <td><font color=\"red\">Sem 1</font></td>";
	$ligne[0] .= "$ligne2[0] <td><font color=\"red\">Sem 2</font></td><td><font color=\"green\">Ann&eacute;e</font></td>";
	$tableau .= "<tr>$ligne[0]</tr>";//entête	
	for($i=1;$i<count($leleve)+1;$i++) {
		$coef_year = 0;$year=0;
		if($somme_coef1[$i]>0) {
			$moyennesem1 = number_format($somme_moyenne1[$i]/$somme_coef1[$i],2);
			$year+=$moyennesem1; $coef_year++;
		}
		else $moyennesem1 ="#";
		if($somme_coef2[$i]>0) {
			$moyennesem2 = number_format($somme_moyenne2[$i]/$somme_coef2[$i],2);
			$year+=$moyennesem2; $coef_year++;
		}
		else $moyennesem2 ="#";
		
		$ligne[$i] .= "$ligne1[$i] <td><font color=\"red\">$moyennesem1</font></td>";$notes1[$i-1]=$moyennesem1;
		if($moyennesem1!="#") {
			$somme_semestre1 += $moyennesem1;
			$total_semestre1++;
		}
		$ligne[$i] .= $ligne2[$i]."<td><font color=\"red\">$moyennesem2</font></td>";$notes2[$i-1]=$moyennesem2;
		if($moyennesem2!="#") {
			$somme_semestre2 += $moyennesem2;
			$total_semestre2++;
		}
		
		if($coef_year) $year = number_format($year/$coef_year,2); else $year="#";
		$ligne[$i] .= "<td><font color=\"green\">$year</font></td>";
		if($year!="#") {
			$somme_annee += $year;
			$total_anne++;
		}
		$tableau .= "<tr>$ligne[$i]</tr>";
	}
	//Ajout de la dernière ligne
	$i = count($leleve)+1;
	if($total_semestre1>0) $moyennesem1 = number_format($somme_semestre1/$total_semestre1,2);
	$ligne[$i] .= $ligne1[$i]."<td><font color=\"yellow	\">$moyennesem1</font></td>";
	if($total_semestre2>0) $moyennesem2 = number_format($somme_semestre2/$total_semestre2,2);
	$ligne[$i] .= $ligne2[$i]."<td><font color=\"yellow\">$moyennesem2</font></td>";
	if($total_anne>0) $year = number_format($somme_annee/$total_anne,2);
	$ligne[$i] .= "<td><font color=\"yellow\">$year</font></td>";
	$tableau .= "<tr>$ligne[$i]</tr>";
	$tableau .= "</table>";

	echo($tableau);

	
	//Éléments de graphique du semestre 1
	$texte_notes1 = liste2texte($notes1);
	$texte_noms1 = liste2texte($leleve);
	$filesave1 = "./files/$classe/_Semestre 1.txt";

	//Éléments de graphique du semestre 2
	$texte_notes2 = liste2texte($notes2);
	//$texte_noms2 = $texte_noms1;
	$filesave2 = "./files/$classe/_Semestre 2.txt";	
?>

<table>
	<tr><td>Semestre 1</td></tr>
	<tr><td>
<?php
	//###
	$notes = explode(":", $texte_notes1);
	$noms = explode(":", $texte_noms1);
	$filesave = $filesave1;
	echo("<a href=\"./geo.php?nomfichier=$filesave1\">");
	include("grapheSVG_fct.php");
	include("grapheSVG.php");
	echo("</a>");
	echo("<a href=\"exportxls_sem.php?sem=1&classe=$classe\"><img src=\"./icon/backup.gif\" width=\"49px\" style=\"border:solid 1px #000000;\"></a>");
?>
</td></tr>
<tr><td>Semestre 2</td></tr>
<tr><td>
<?php 
	//###
	$notes = explode(":", $texte_notes2);
	//$noms = explode(":", $texte_noms2);
	$filesave = $filesave2;
	echo("<a href=\"./geo.php?nomfichier=$filesave2\">");
	include("grapheSVG.php");
	echo("</a>");
	echo("<a href=\"exportxls_sem.php?sem=2&classe=$classe\"><img src=\"./icon/backup.gif\" width=\"49px\" style=\"border:solid 1px #000000;\"></a>");	
?>
	</td></tr>
</table>
<?php	
	include("./bas.php");
?>