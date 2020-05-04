<?php include("./haut.php");?>
<form method="post" action="epreuve.php?modif=oui">
<?php
	//22 juin 2019
	//Menu des sanctions et promotions
	$menu_cause = "<select name=\"cause\" onchange = \"newvalue(this.value);\">";
	$menu_cause .= "<option value=\"0 Correction\">Correction</option>";
	$menu_cause .= "<option value=\"-0.5 Telephone\">-0,5 Telephone</option>";
	$menu_cause .= "<option value=\"-1 Retard\">-1 Retard</option>";
	$menu_cause .= "<option value=\"-1 WC\">-1 WC</option>";
	$menu_cause .= "<option value=\"-1 Cahier\">-1 Cahier</option>";
	$menu_cause .= "<option value=\"-1 Rangement TP\">-1 Rangement TP</option>";

	$menu_cause .= "<option value=\"+0.25 Tableau\">+0,25 Tableau</option>";
	$menu_cause .= "<option value=\"+0.5 Tableau\">+0,5 Tableau</option>";
	$menu_cause .= "<option value=\"+1 Tableau\">+1 Tableau</option>";	
	$menu_cause .= "<option value=\"+2 Tableau\">+2 Tableau*</option>";
	$menu_cause .= "</select>";
	
	$nom = $_GET['nom'];
	$epr = $_GET['epr']; $epreuve = explode(".", $epr);
	$mat = $_GET['mat'];
	
	$ligne = array_fill(0, 200, "");

	
	tableau("$accueil$classe</a></td><td><a href=\"./epreuve.php?mat=$mat&epr=$epr\">$epreuve[0]</a></td>");

	//Upload d'une copie dans le repertoire de l'elève
	if(my_GET("action")==54){
		
		// Création Repertoire de l'élève
		$nom = un_nom($nom);
		$repertoire_elv =  "$repertoire_copies/$nom";
		if(!file_exists($repertoire_elv)){
			mkdir($repertoire_elv, 0777);
			affiche("-- $repertoire_elv cr&eacute;e --");
		}
		
		if(!empty($_FILES["fichier_choisi"]["name"])){
			//nom du fichier choisi:
			$nomFichier = $_FILES["fichier_choisi"]["name"] ;
			$extension = substr(strrchr($nomFichier, '.'), 1);
			$newname = "$epreuve[0] $nom.$extension";
			$chemin = $repertoire_elv."/".$newname;
			
			if(file_exists($chemin)) $Message = "Fichier existant</br>";
			else $Message = "";
			
			//nom temporaire sur le serveur:
			$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
			//type du fichier choisi:
			$typeFichier = $_FILES["fichier_choisi"]["type"] ;
			//poids en octets du fichier choisit:
			$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
			//code de l'erreur si jamais il y en a une:
			$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
			if(copy($nomTemporaire, $chemin)){
				$Message .= "Votre fichier $chemin est import&eacute;" ;
				chmod("$chemin",0777);
			}
			else $Message .= "La sauvegarde de $chemin a &eacute;chou&eacute; !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<p>Action 54 : $Message</p>");
	}




	
	$fichier = "./files/$classe/$mat/$epr"; //echo($fichier);
	$handle = fopen($fichier, "r");
	if($handle){
		$nb_ligne2020 = 0;//nb de ligne du fichier
		while (!feof($handle)){
			$ligne[$nb_ligne2020] = fgets($handle); echo("<!-- $ligne[$i] -->");
			$nb_ligne2020++;
		}
	}
	fclose($handle);
	
	$histo = "<table class=\"Px300G\">";
	$note = "";////
	$coef = "";
	$rq = "";
	for($i=0;$i<$nb_ligne2020;$i++){
		$data = explode(":", $ligne[$i]);
		echo("<!-- $data[0]==$nom -->\n"); 
		if($data[0]==$nom){
			$note = $data[1];
			$coef = $data[2]; if($coef=="") $coef = 1;
			$ladate = $data[3];
			$url = my_array_value($data,5);//$data[5];
			$rq = my_array_value($data,6);//$data[6];
			$cause = my_array_value($data,4);//$data[4];
			
			$histo .= "<tr><td>$note</td><td>$cause</td><td>$ladate</td></tr>";
		}
	}
	$histo .= "</table>";
	$laphoto = photobord($nom,"#fff");//photode($nom);
	
	//12 septembre pour ajouter la liste des fichiers
	$lescopies = lescopies2($nom,$classe,$epr,$repertoire_copies);
	
	
	
	echo("<table><tr><td>");//Debut du tableau
	echo("$laphoto");
	echo("<br/>[Repertoire] Mati&egrave;re :<input type=\"txt\" name=\"mat\" value=\"$mat\">");
	echo("<br/>[Fichier] Epreuve :<input type=\"txt\" name=\"epr\" value=\"$epr\">");
	echo("<br/>[0] Nom :<input type=\"txt\" name=\"nom\" value=\"$nom\" id=\"nom\"> + $deroulant3");
	echo("<br/>[1] Note :<input type=\"txt\" name=\"note\" value=\"$note\" id=\"note\" size=\"7\"> [4] Cause :$menu_cause");
	echo("<br/>[2] Coef :<input type=\"txt\" name=\"coef\" value=\"$coef\" size=\"3\">");
	echo("<br/>[3] Date :<input type=\"txt\" name=\"date\" value=\"$date_heure\" id=\"date\">");
	echo("<input type=\"button\" value = \"$nonfait\" onclick = \"nonfait();\">");
	//echo("<br/>[4] Cause :$menu_cause");
	//echo("<br/>[5] <a href=\"$url\">URL</a> :<input type=\"txt\" name=\"url\" value=\"$url\" size=\"50\">"); Plus d'actualité le 5 avril 2016
	echo("<br/>[6] Remarque :<input type=\"txt\" name=\"rq\" value=\"$rq\">");
	echo("<br/><br/><input type=\"reset\">");
	echo("\n<input type=\"hidden\" name=\"epreuve\" value=\"$epreuve[0]\">");
	echo("\n<input type=\"hidden\" name=\"mat\" value=\"$mat\">");
	echo("</td><td>$histo");
	//echo("<br/><input type=\"reset\"> - <input type=\"submit\" value=\"Enregistrer\" style=\"height:150px\" >");
	echo("<br/><input type=\"image\" src=\"./icon/valider.png\"alt=\"Submit Form\" />");
	echo("</form></td></tr></table>");
?>
<!-- script -->
<script type="text/javascript">
function newvalue(lavaleur){
	back = document.getElementById('note').value;
	document.getElementById('note').value = parseFloat(lavaleur)+parseFloat(back);
}
function nonfait() {
	document.getElementById('date').value = "<?php echo($nonfait);?>";
}
function addelv(valeur){
	actuelle = document.getElementById('nom').value;
	document.getElementById('nom').value = actuelle + valeur;
}
</script>
<?php
		$action54 = "./modif.php?action=54&mat=$mat&epr=$epr&nom=$nom";
?>	

	<!-- 05-04 Ligne importation d'une copie -->
	<table>
		<form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo "$action54";?>">
		<tr><td>D&eacute;j&agrave; import&eacute;e(s) : <?php echo("$lescopies"); ?></td>
		<td><input name="fichier_choisi" type="file"></td>
		<td><input name="bouton" value="Mettre dans le r&eacute;pertoire de l'&eacute;l&egrave;ve" type="submit">
		</td>
		</tr>
	</form></table>


<?php include("./bas.php");?>
