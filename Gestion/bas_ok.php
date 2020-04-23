<!-- bas_ok.php -->
<?php
	function menu_deroulant_bas($liste,$nom,$onchange){ //Crée un menu deroulant avec la liste $liste et de nom $nom
		$lemenu = "<SELECT name=\"$nom\" onchange=\"$onchange\">";
		$lemenu .= "<OPTION selected>----</OPTION>";
		if(is_array($liste)) $liste_count = count($liste);
		else $liste_count = 0;
		for($i=0;$i<$liste_count;$i++) $lemenu .= "<OPTION>$liste[$i]</OPTION>";
		$lemenu .= "<\SELECT>";
		return $lemenu;
	}
	
	function menu_deroulant_bas2($liste,$nom,$onchange){ //Crée un menu deroulant avec la liste $liste et de nom $nom
		$lemenu = "<SELECT name=\"$nom\" onchange=\"$onchange\">";
		$lemenu .= "<OPTION selected>----</OPTION>";
		if($liste) $liste_count = count($liste);
		else $liste_count = 0;
		for($i=0;$i<$liste_count;$i++) {
			$elts = explode(".", $liste[$i]);
			$elts2 = my_array_value($elts,2);
			$lacible = "?mat=$elts2&epr=$elts[0].txt";
			$lemenu .= "<OPTION value=\"$lacible\">$elts[0]</OPTION>";
		}
		$lemenu .= "<\SELECT>";
		return $lemenu;
	}
	
	$menu_mat = menu_deroulant_bas(isset($tableaudesmatieres)?$tableaudesmatieres:"","mat2","redirect('./matiere.php?mat='+this.value);");
	$menu_elv = menu_deroulant_bas(isset($leleve)?$leleve:"","elv2","redirect('./eleve.php?nom='+this.value);");
	$menu_epreuve = menu_deroulant_bas2(isset($lepreuve1)?$lepreuve1:"","epreuve2","redirect_epreuve(this.value);");
	$menu_appel = menu_deroulant_bas(isset($tableaudesappels)?$tableaudesappels:"","appel2","redirect('./appel.php?ladate='+this.value);");
	$menu_planning = menu_deroulant_bas(isset($tableauplanning)?$tableauplanning:"","planning2","redirect('./planning.php?action=3&ladate='+this.value);");
	$menu_ranger = menu_deroulant_bas(isset($tableaudesTP)?$tableaudesTP:"","ranger2","redirect('./ranger.php?file='+this.value);");		

	$ladate_slash = str_replace("_", "/", $ladate);
?>
<script type="text/javascript">
function redirect(lacible){
	window.location.replace(lacible);
}
function redirect_epreuve(lacible){
	lien = './epreuve.php'+lacible;
	window.location.replace(lien);
}

</script>

<table>
	<tr>
		<td>Mati&egrave;re</td>
		<td>Epreuve</td>
		<td><a href="./index.php?ladate=<?php echo($ladate_slash);?>">Appel</a></td>
		<td>
			<?php
				$lg_date2017 = date("d_m");
				if(file_exists("./files/$classe/_Plannings/$lg_date2017.txt"))
					echo("<a href=\"./planning.php?action=3&ladate=$lg_date2017\">Planning</a>");
				else
					echo("Planning");
			?>
		</td>
		<td><a href="./ranger.php">Ranger</a></td>
		<!-- <td rowspan=2><a href="./bts.php"><img src="icon/laureat.png" height="45px"/> </td> -->
	</tr>
	<tr>
		<td><?php echo($menu_mat);?></td>
		<td><?php echo($menu_epreuve);?></td>
		<td><?php echo($menu_appel);?></td>
		<td><?php echo($menu_planning);?></td>
		<td><?php echo($menu_ranger);?></td>
		
	</tr>
</table>

<table>
	<tr>
		<td>(NEW)</td>
		<td><a href="./appel.php?ladate=<?php echo($date);?>">Appel</a></td>
		<td><a href="./planning.php?action=0">Planning</a></td>
		<td><a href="./new.php">Epreuve</a></td>
		<td><a href="./synthese.php">Synth&egrave;se</a></td>
		<td><a href="./cahier.php">Cahier de texte</a></td>
		<!--<td><a href="./calendrier.php">Progression</a></td>-->
		<td><a href="./conseil.php?classe=<?php echo($classe);?>">Conseil</a></td>
	</tr>
</table>

<?php
	$ftp_link = isset($ftp_filename)?"./ftp2pi.php?file=$ftp_filename":"";
?>

<table><tr>
<!-- <td><a href="./index.php?nomelv=<?php echo("$nom");?>" title="Acc&egrave;s &eacute;l&egrave;ves"><img src="./icon/elv.jpg" height="15px" style="border:solid 4px #fff"></a></td> 
-->		
	<td><a href="./liste_eleve.php" title="Tableau des élèves"><img src="./icon/tab.jpg" height="15px" style="border:solid 4px #fff"></a></td>

	<td><a href="./listedeslog.php" title="Visites"><img src="./icon/----.jpg" height="15px" style="border:solid 4px #fff"></a></td>
	<!--<td><a href="./tab_copies.php" title="Tableau des copies"><img src="./icon/tabV.jpg" height="15px" style="border:solid 4px #fff"></a></td>-->
	<td><a href="./apreciations.php" title="Apréciations"><img src="./icon/conseil.jpg" height="15px" style="border:solid 4px #fff"></a></td>
	
	<td><a href="./files.php" title="Fichiers des élèves"><img src="./icon/finder.jpg" height="15px" style="border:solid 4px #fff"></a></td>	
	<td><a href="./sujet2TP.php" title="Les sujets de TP"><img src="./icon/main.png" height="15px" style="border:solid 4px #fff"></a></td>
	<!-- <td><a href="./tp.php" title="Sujets de TP" target="_blank"><img src="./icon/tp.jpg" height="15px" style="border:solid 4px #fff"></a></td> -->
	
<?php
	$nom_doc = isset($nom_doc)?$nom_doc:"Professeur";
	if($nom_doc=="Professeur") 
		echo("<td><a href=\"./doclasse.php\" title=\"Document $nom_doc\"><img src=\"./icon/doc.jpg\" height=\"15px\" style=\"border:solid 4px #fff\"></a></td>");
	else {
		$_SESSION['nom'] = $nom_doc;
		echo("<td><a href=\"./documents.php?doc=$nom_doc\" title=\"Document $nom_doc\"><img src=\"./icon/doc.jpg\" height=\"15px\" style=\"border:solid 4px #fff\"></a></td>");
	}		
?>

	<td><a href="./DSZone.php" title="DS Perso"><img src="./icon/quest.jpg" height="15px" style="border:solid 4px #fff"></a></td>	
	<td><a href="./index7.php" title="Accueil <?php echo($_COOKIE['nom']);?>"><img src="./icon/elv_web.jpg" height="15px" style="border:solid 4px #fff"></a></td>
<td><?php echo("$file2delete");?><td>
<td><?php if(isset($filecompare)) echo("$filecompare");?><td>	
</tr></table>
</center>
</body>
</html>