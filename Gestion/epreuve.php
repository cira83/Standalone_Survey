<?php 
	include("./haut.php");

	function nombre2icket($epr,$classe,$participants){
		$result = "";
		$filename = "./files/$classe/_$epr";
		if(file_exists($filename)) {
			$nom = explode(" ", $participants);
			$fp = fopen($filename, "r");
			while(!feof($fp)){
				$ligne=fgets($fp);
				foreach($nom as $elv) if(strpos($ligne, $elv)) $nb++;
			}
			fclose($fp);
			if($nb) $result = " <a href=\"$filename\">|$nb</a>";
		}
		return($result);
	}
	
	$mat = my_GET("mat");
	$epr = my_GET("epr");
	$modif = isset($_GET['modif']) ? $_GET['modif'] : "";
	$laliste = isset($_POST['laliste']) ? $_POST['laliste'] : "";
	$action = isset($_GET['action']) ? $_GET['action'] : "";
	$nb2copies = 0; //nb de copies rendues
	// rajouté le 18/04/2020
	$liens_vus = "";
	$drap_passe = "";
	$coef = "";
	$nombre_total2participants = 0;
	$somme_coef = 0;
	$moyenne = 0;
	//$lesnotes = "";
	//$lesnoms14[0] = ""; 
	
	
	$nbphotoslignes = 7.5;
	
	if($epr=="") $epr=$_POST['epreuve'].".txt";
	if($mat=="") $mat=$_POST['mat'];
	$lien_sujet = isset($_POST['lien']) ? $_POST['lien'] : "";//Lien http vers le sujet -- modif du 21 novembre 2017
	$nomdufichierlien = "$files$classe/$mat/_link$epr";

	//FTP 
	$ftp_filename = $nomdufichierlien;
	
	//Ouverture du fichier MDR
	$nomdufichiermdr = "$files$classe/$mat/_mdr$epr";
	$mdr_file = fopen($nomdufichiermdr, "w");

	
	$fichier = $files."$classe/$mat/$epr"; //echo($fichier."--".$laliste);
	//lien($fichier);
	
	
	//-- Entête de la page ---------------------------------------------------------------------
	$info_sujet = "";
	$danger = info_sujet_ouvert($nomdufichierlien);
	if($danger) $info_sujet = "<td width=\"25px\"><img src=\"./icon/danger.png\" height=\"20px\"></td>";
	$lien_vers_doc = info_sujet($nomdufichierlien);
	$part_correction_sujet = explode("+", $lien_vers_doc);
	$info_sujet .= "<td width=\"25px\">".$part_correction_sujet[0]."</td>";	
	$info_sujet .= "<td width=\"25px\">".$part_correction_sujet[1]."</td>";
	$info_sujet .= "<td width=\"25px\">".$part_correction_sujet[2]."</td>";
	$info_sujet .= "<td width=\"25px\"><a href=\"./info_sujet.php?file=$nomdufichierlien\" title=\"Infos sujet\"><img src=\"./icon/info_rond.png\" height=\"20px\"></a>";
	
	tableau("<b>$mat</b></td><td><a href=\"$fichier\">$epr</a> $info_sujet");
	
	
	//Création du fichier si il n'existe pas
	if(!file_exists($fichier)) {
		echo("<p>Le fichier est crée.</p>");
		$personne = explode(":", $laliste); //affiche("!!".$laliste);
		$handle = fopen($fichier, "w");
		for($i=0;$i<count($personne)-1;$i++) {
			fprintf($handle, "$personne[$i]::1:");
			if($i<count($personne)-2) fprintf($handle, "\n");
		}		
		fclose($handle);
	}
	
	//Ajout des nouvelles informations dans le fichier
	if($modif=="oui"){
		$newnote = str_replace(",", ".", $_POST['note']);
		$newnom = $_POST['nom'];
		$newcoef = $_POST['coef'];
		$newdate = $_POST['date']; if($newdate=="") $newdate = $date0212;
		$newcause = $_POST['cause'];
		$url = my_POST("url");
		$rq = $_POST['rq'];
		echo("<p>Nouvelle note pour $newnom : $newnote ($newcoef) le $newdate<p>");
		$handle = fopen($fichier, "a");
		fprintf($handle, "\n$newnom:$newnote:$newcoef:$newdate:$newcause:$url:$rq:");
		fclose($handle);
	}
	
	if($action==44){//insertion d'un fichie de note - ne sert plus
		$chemin = "./files/$classe/$mat/$epr";
		
		if(!empty($_FILES["fichier_choisi"]["name"])){
			//nom du fichier choisi:
			$nomFichier = $_FILES["fichier_choisi"]["name"] ;
			//nom temporaire sur le serveur:
			$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
			//type du fichier choisi:
			$typeFichier = $_FILES["fichier_choisi"]["type"] ;
			//poids en octets du fichier choisit:
			$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
			//code de l'erreur si jamais il y en a une:
			$codeErreur = $_FILES["fichier_choisi"]["error"] ;
	
			if(copy($nomTemporaire, $chemin)){
				$Message = "Votre fichier $chemin est import&eacute;" ;
				chmod("$chemin",0777);
			}
			else $Message = "La sauvegarde a &eacute;chou&eacute; !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<p>Action 44 : $Message</p>");
	}

	if($action==45){//Rangement d'une copie dans le dossier elv 
		$nom45 = my_POST("elv");
		$epr45 = explode(".", $epr);
		//Création du répertoire si nécéssaire
		$repertoire_elv = "$repertoire_copies";
		if(!file_exists($repertoire_elv)){
			mkdir($repertoire_elv, 0777);
			affiche("-- $repertoire_elv cr&eacute;e --");
		}
		$repertoire_elv = "$repertoire_copies/$nom45";
		if(!file_exists($repertoire_elv)){
			mkdir($repertoire_elv, 0777);
			affiche("-- $repertoire_elv cr&eacute;e --");
		}
		
		if(!empty($_FILES["fichier_choisi"]["name"])){
			//nom du fichier choisi:
			$nomFichier = $_FILES["fichier_choisi"]["name"] ;
			//nom temporaire sur le serveur:
			$nomTemporaire = $_FILES["fichier_choisi"]["tmp_name"] ;
			//type du fichier choisi:
			$typeFichier = $_FILES["fichier_choisi"]["type"] ;
			//poids en octets du fichier choisit:
			$poidsFichier = $_FILES["fichier_choisi"]["size"] ;
			//code de l'erreur si jamais il y en a une:
			$codeErreur = $_FILES["fichier_choisi"]["error"] ;

			//Recherche du nom de l'élève et le place dans $nom45 - Le 31/09/2016		
			for($j=0;$j<count($leleve);$j++){
				if(stripos($nomFichier,$leleve[$j])){
					$nom45 = $leleve[$j];
				}
			}
			$chemin = "$repertoire_copies/$nom45/";
			
			if(stripos($nomFichier, $nom45)){
				if(copy($nomTemporaire, $chemin.$nomFichier)){
					$Message = "Votre fichier $chemin$nomFichier est import&eacute;" ;
					chmod("$chemin$nomFichier",0777);
				}
				else $Message = "La sauvegarde a &eacute;chou&eacute; de $chemin$nomFichier !!" ;
			}
			else $Message = "Le fichier choisi [$nomFichier] ne contient pas le nom de l'&eacute;l&egrave;ve [$nom45] !!" ;
		}
		else $Message = "Vous n'avez pas choisit de fichier !!";
		echo("<p>Action 45 : $Message</p>");
	}
	
	//Lecture du fichier, toutes les lignes sont dans $ligne[] 
	if(file_exists($fichier)) $handle = fopen($fichier, "r");
	else $handle = "";
	if($handle){
		$i = 0;
		$j = 0;//nb d'élèves
		while (!feof($handle)){
			$ligne2020[$i] = fgets($handle);
			$data = explode(":", $ligne2020[$i]); // ligne[] remplacé par ligne2020[] 
			if($j==0){
				$listeofname[0]=$data[0];
				$j++;
			}
			$flag = true;
			for($k=0;$k<count($listeofname);$k++) if($data[0]==$listeofname[$k]) $flag = false;
			if($flag){
				$listeofname[$j] = $data[0];
				$j++;
			}
			$i++;
		}
	}
	fclose($handle);
	
	//afficheliste($listeofname);
	sort($listeofname); //Classes les noms dans l'ordre alphabétique

	//foreach($listeofname as $case) echo("<!-- $case -->");

	$j = 0;
	$n = 0;
	$date0212 = "";
	$note = "";
	$listedesnonfait = "";
	$somme_note = 0;
	echo("<table>");
	for($i=0;$i<count($listeofname);$i++){
		if(is_array($ligne2020)) $ligne_count = count($ligne2020);
		else $ligne_count = 0;
		for($k=0;$k<$ligne_count;$k++){
			$data = explode(":", $ligne2020[$k]);
			if($data[0]==$listeofname[$i]){
				$note = $data[1];
				$coef = $data[2]; if($coef=="") $coef=1;
				$date0212 = $data[3];//la date de modification de la note
				
				//compare la date et aujourd'hui - 09/2017
				$part0917_1 = explode(" ", $date0212);
				$part0917_2 = explode(" ", $date_heure);
				$drap_passe = false;
				$data4 = isset($data[4]) ? $data[4] : "";
				$signe = isset($data4[0]) ? $data4[0] : "";
				if(($part0917_2[0]==$part0917_1[0])&&($signe=="+")) $drap_passe = true;
			}
		}
		$nom = $listeofname[$i];
		$lien = "./modif.php?mat=$mat&epr=$epr&nom=$nom";
		$listedesparticipants = "";
		if($date0212!=$nonfait){
			$listedesparticipants .= $nom.":";//Necessaire à la création de nouvelles copies
			
			
			//GESTION DES TICKETS
			$nb2tickets = nombre2icket($epr,$classe,$nom);
			
			$somme_note += floatval($note); 
			if($note!="") {
				$somme_coef++;//ne prendre que les copies notées
				$lesnoms14[$n]=$listeofname[$i];
				$lesnotes[$n] = $note; $n++;
			}
																													//CREATION DU TABLEAU
			$pas = nbparticipants($nom);//pour les groupes de plusieurs personnes
								
			//Fichiers
			$lien_copies_tab = explode(":",lescopies3($nom,$classe,$epr,$repertoire_copies));//Liens vers les copies :+ codes md5 ###
			$lien_copies = $lien_copies_tab[0];// Les liens vers les copies rendues
			if($lien_copies) $nb2copies++; //compte le nombre de copie rendue
			fwrite($mdr_file, "$lien_copies_tab[1]\n");//
			$drap_dejavu = dejavu($lien_copies_tab[1],$liens_vus);
			$liens_vus .= $lien_copies_tab[1];
			
			
			$bgcolor = "#c0c0c0";
			if(!$note) $photo = photobord($nom,"#fff");
			else $photo = photobord($nom,"#00b900");
			if($lien_copies) {
				if(!$note) $photo = photobord($nom,"#fffb01");
			}
						
			//Dèjà passé au tableau - 18/09/2017
			if($drap_passe) $photo = photobord($nom,"#FF8000");
			//Copie déjà vue		
			if($drap_dejavu) $photo = photobord($nom,"#f00");
			
			$case_participants[$j] = "<td>$photo<br/>$lien_copies<a href=\"$lien\">$nom $note ($coef)</a>$nb2tickets</td>";
			$case_nb[$j] = $pas; 
			$nombre_total2participants += $pas; 
			$j++;

		}
		else {
			$listedesnonfait .= "<a href=\"$lien\">".$nom."</a> ";
		}
	}
	
	$nb2caseoptimum = 6;
	$nb_total2lignes = intdiv($nombre_total2participants,$nb2caseoptimum);
	if($nombre_total2participants%$nb2caseoptimum) $nb_total2lignes++; 
	//je cherche le maximum de participants
	$max_participant = 0;
	foreach($case_nb as $lenb) if($lenb>$max_participant) $max_participant=$lenb;
	
	$line1 = "<tr>";
	
	$lenb = $max_participant;
	$jj2020 = 0;
	while($lenb>0){	
		for($indice_case=0;$indice_case<count($case_nb);$indice_case++) if($case_nb[$indice_case]==$lenb) {
			$line1.=$case_participants[$indice_case];
			$jj2020 += $case_nb[$indice_case];
			$seuil = intdiv($nombre_total2participants,$nb_total2lignes);
			if($nombre_total2participants%$nb_total2lignes) $seuil++;

			if($jj2020>=$seuil) {
				$line1.="</tr></table><table><tr>";
				if($nb_total2lignes>2) {
					$nb_total2lignes--;
					$nombre_total2participants = $nombre_total2participants - $jj2020;
				}
				$jj2020 = 0;
			}
		}
		$lenb--;
	}
	
	$line1.="</tr></table>";
	echo($line1);	
	
	$action44 = "./epreuve.php?action=45&mat=$mat&epr=$epr";

?>	

	<!-- 04-04 Ligne importation de fichiers -->
	<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo "$action44";?>">
		<tr><td>Rangement du fichier avec un nom valide</td>
		<td><input name="fichier_choisi" type="file"></td>
		<td><input name="bouton" value="Envoyer le fichier corrig&eacute;" type="submit">
		</td>
		</tr>
	</form></table>

<?php
	if($somme_coef>0) {
		$moyenne = number_format($somme_note/$somme_coef,2); //
		echo("<p>Moyenne de la classe : $moyenne ($somme_coef notes pour $nb2copies copies rendues)</p>");
	}
	
	$filesave = "./files/$classe/$mat/_$epr";
	//mars 2018
	$savefileicon = "<a href=\"exportxls.php?filesave=$filesave&file=$epr&moy=$moyenne\"><img src=\"./icon/backup.gif\" width=\"49px\" style=\"border:solid 1px #000000;\"></a>";
	
	if(isset($lesnotes)) $texte_notes = liste2texte($lesnotes);
	else $texte_notes = "";
	if(isset($lesnoms14)) $texte_noms = liste2texte($lesnoms14);
	else $texte_noms = "";

	// Graphe .svg avril 2020 ###
	// afficheliste($lesnoms14);
	echo("<table><tr><td>");
	if($texte_notes) $notes = explode(":", $texte_notes);
	else $notes = null;//si pas de notes
	$noms = explode(":", $texte_noms);
	echo("<a href=\"./geo.php?nomfichier=$filesave\">");
	include("grapheSVG_fct.php");
	include("grapheSVG.php");
	echo("</a>");	
	
	echo("</td><td><a href=\"./pub_notes.php?filesave=$filesave&file=$epr&moy=$moyenne\">Publier les statistiques</a></td>");

	echo("</tr></table>");

	//Fichier à supprimer
	$aeffacer = "./files/$classe/$mat/$epr";
	$file2delete = "<a href=\"delfile.php?name=$aeffacer&action=0\">Supprimer</a> $epr";
	
	//Fichier à comparer
	$filecompare = "<a href=\"compare.php?mat=$mat&epr=$epr&classe=$classe\">Comparer</a> $epr";
	
	
	fclose($mdr_file);
	
	/*echo("<center>");
	//Nouvelle épreuves
	include("newepreuve.php");
	echo("</center>");
	*/
	
	//les epreuves 3 janvier 2017
	$tabEpreuves = tabEpreuves($classe,$mat);
	echo($tabEpreuves);
	include("./bas.php");
?>
