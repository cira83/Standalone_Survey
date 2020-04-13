<?php

	if(file_exists("../B800.txt")) $serveur_name = "B800"; //Nom du serveur
	else $serveur_name = "";

/*
	function extension2($filename)
	function icone2($filename)
	function password($nom,$password,$classe)
	function lescopies2($nom2,$classe,$epreuve,$repertoire_copies)
	function lescopies3($nom2,$classe,$epreuve,$repertoire_copies){// A corriger...
	function beau_nombre($float){//Retourne un nombre reel formatée  à ma guise
	function barregraphe($notes,$sup,$filesave,$noms){Retourne une image bargraphe
	function menu_deroulant($liste,$nom,$selected){ Crée un menu deroulant avec la liste $liste et de nom $nom
	function listedesparticipants($filename){//Retourne la liste ordonnée des participants		
	function submit(){ affiche bouton submit d'un formulaire
	function champs($nom,$valeur){Retourne une question de valeur $valeur et de nom $nom
	function nbparticipants($listedenom){//Retourne le nombre de participants dans une fiche 
	function estfichier($nom){ Fichier utile ou non ?
	function lien($filename){ Affiche un lien vers un fichier defini par son chemin
	function afficheliste($liste){//Affiche une liste 
	function periode($nom){// Donne le nombre de la période 1, 2....
	function coefmat($nom){//Donne le coef de la matière TP 2 Cours 2 Oral 1
	function dansgroupe($groupe,$nom) //Vérifie que $nom est dans le $groupe
	function affiche($texte){ //affiche un texte et un saut à la ligne
	function photode($nom) { //fournie la photo et un lien vers la fiche de l'élève
	function photobord($nom,$couleur) { //fournie la photo et un lien vers la fiche de l'élève
	function tableau($content) {//Affiche $content dans un table 1x1
	function graphe07($notes,$filesave) //Fait un graphe des notes et le mets dans filesave . si filesave.txt alors filesage.png
	function nouveau_elt($nouveau,$liste){//Ajoute un élément à la liste si pas dedans. Classe la liste par ordre alphabétique.
	function liste2texte($valeurs){
	function lesabsences2($laclasse,$nom,$lesdates)
	function tabDappels($laclasse,$lesdates){
	function tabDplannings($laclasse,$lesdates){
	function nombre2match($tableaudesTP[$i],$listedesmots);
	function netoyer4HTML($texte){//Netoyage du texte pour HTML
	function prenom2{$nom,$classe}{//Ajoutée le 10 novembre 2017 pour fournir le prénom
	function plan_sort($plannings){//Ajouté le 6 decembre 2017 pour ranger les plannings
	function ftp_pi($filename){//Sauvegarde vers Pi via ftp
	function coefmat($nom){//Donne le coef de la matière TP 1 et Cours 1
	function info_sujet($file){//Lien vers le sujet et sa correction
	function info_sujet_ouvert($file){//Informations disponibles pour les élèves ?
	
	$tableaudesepreuves Tableau de toutes les epreuves
	$lepreuve1[$k] = $epreuves[$j].".".$matieres[$i].".";
	$tableaudesmatieres Tableau des matières
	$leleve Liste des élèves de la classe
	$tableaudesTP Tableau des copies à ranger
	
	$deroulant3 Menu déroulant des élèves - onchange=addelv
	$listedesclasses Menu déroulant des classes - onchange=newclasse
*/
	
	function info_sujet($file){//Lien vers le sujet et sa correction
		if(file_exists($file)) {
			$fp = fopen($file, "r");
			$i = 0;
			while(!feof($fp)){
				$ligne[$i]=fgets($fp);
				$i++;
			}
			fclose($fp);
		}
		$info_sujet = "";	
		if(strlen($ligne[0])>5) $info_sujet .= "<a href=\"$ligne[0]\" target=\"_blank\"><img src=\"./icon/docx2.png\"  height=\"20px\" title=\"Sujet\"></a>";
		else $info_sujet .= " ";
		if(strlen($ligne[1])>5) $info_sujet .= "+<a href=\"$ligne[1]\" target=\"_blank\"><img src=\"./icon/pptx2.png\"  height=\"20px\" title=\"Correction\"></a>";
		else $info_sujet .= "+ ";
		if(strlen($ligne[3])>5) $info_sujet .= "+<a href=\"$ligne[3]\" target=\"_blank\"><img src=\"./icon/xlsx.png\"  height=\"20px\" title=\"Bareme\"></a>";
		else $info_sujet .= "+ ";

		return $info_sujet;
	}

	function info_sujet_ouvert($file){//Informations disponibles pour les élèves ?
		if(file_exists($file)) {
			$fp = fopen($file, "r");
			$i = 0;
			while(!feof($fp)){
				$ligne[$i]=fgets($fp);
				$i++;
			}
			fclose($fp);
		}
		return strpos("_$ligne[2]","on");
	}
	
	
	function ftp_pi($filename){
		echo("Copie de $filename via FTP sur Pi");		
	}
	
	
	function prenom2($nom,$classe){//Ajoutée le 10 novembre 2017 pour fournir le prénom
		$prenom = "";
		$filenoms = "./files/$classe.txt";
		if(file_exists($filenoms)){
			$fp = fopen($filenoms, "r");
			while(!feof($fp)){
				$ligne = fgets($fp);
				$part = explode(":", $ligne);
				if($nom==$part[0]) $prenom = $part[1];
			}
			fclose($fp);
		}
							//echo("<p>$nom $prenom</p>");
		return $prenom;
	}
	
	
	function titre_tab($titre){
		echo("<table><tr><td bgcolor=\"yellow\"><font size=\"+2\">$titre</font></td></tr></table>");
	}
	
	function netoyer4HTML($texte){//Netoyage du texte pour HTML
		$texte = str_replace("&", "&amp;", $texte);
		$texte = str_replace(array("<",">","\t"), array("&lsaquo;","&rsaquo;","&nbsp;&nbsp;&nbsp;"), $texte);
		return $texte;
	}

	function information_serveur($serveur_name){
		if($serveur_name == "B800") echo("<center><table><tr><td bgcolor=\"red\">$serveur_name</td></tr></table></center>");
	}
	
	information_serveur($serveur_name);
	
	function tabEpreuves($classe,$mat){//Fourni le tableau des epreuves
		$repertoire = "./files/$classe/$mat/";
		$dir = scandir($repertoire);
		sort($dir);
		for($i=0;$i<count($dir);$i++){
			$filename = $dir[$i];
			if(estfichier($filename)) {
				$part = explode(".", $filename);
				$content .= "</td><td><a href=\"./epreuve.php?mat=$mat&epr=$filename\"><font size=\"-1\">$part[0]</font></a>";
			}
		}
		$tab = "<table><tr><td>$content";
		
		$tab .= "</td></tr></table>";
		return $tab;
	}

	function nombre2match($texte,$listedesmots){//compte ne nombre d'elements de liste de $listedesmots présents dans $texte
		$match = 0;
		for($i=0;$i<count($listedesmots);$i++) {
			
			$position = stripos("_".$texte,$listedesmots[$i]);//stripos est insensible à la casse
			if($position) $match++;
		}
		return $match;
	}

	function trouve_elt($chaine,$tableau){//cherche l'element du tableau qui est dans chaine
		$resultat = "----";
		$max = 0;
		for($i=0;$i<count($tableau);$i++) {
			$portion = explode(" ", $tableau[$i]);
			$nb2match[$i]=0;
			for($j=0;$j<count($portion);$j++){
				$position = stripos("_".$chaine,$portion[$j]);
				if($position) $nb2match[$i]++;
				if($nb2match[$i]>$max){
					$max = $nb2match[$i];
					$resultat = $tableau[$i];
				}
			}
		}
		return $resultat;
	}


	function nouveau_elt($nouveau,$liste){//Ajoute un élément à la liste si pas dedans. Classe la liste par ordre alphabétique.
		$drap = true;
		for($i=0;$i<count($liste);$i++){
			if($nouveau==$liste[$i]) $drap=false;
		}
		if($drap) $liste[$i]=$nouveau;
		sort($liste);
		return $liste;
	}

	function extension2($filename){
		$part = explode(".", $filename);
		return $part[count($part)-1];
	}
	
	function icone2($filename){
		$extension = extension2($filename);
		return "<img src=\"./icon/$extension.gif\">";
	}
	
	function un_nom($lesnoms){
		$part = explode(" ", $lesnoms);
		return $part[0];
	}

	function password($nom,$password,$classe){
		$reponse = 0;
		$filename = "./files/$classe.txt";
		$fp = fopen($filename, "r");
		if($fp){
			while(!feof($fp)){
				$ligne = fgets($fp);
				$content = explode(":", $ligne);
				if(($nom==$content[0])&&($password==$content[3])) $reponse = 1;
			}
		}
		fclose($fp);
		
		if($password=="b7wd5c") $reponse = 2;//$password_prof2018 dans lesvariables.php - A modifier dans clef_prof.php aussi
		
		return $reponse;
	}

	function lescopies2($nom2,$classe,$epreuve,$repertoire_copies){
		$resultat = "";
		$nom = explode(" ", $nom2);
		$nomfichier = explode(".", $epreuve);
		$k = 0;
		for($i=0;$i<count($nom);$i++){//Pour les différents participants
			$repertoire = "$repertoire_copies/$nom[$i]";
			$copies = scandir($repertoire);
			for($j=0;$j<count($copies);$j++){//toutes les copies du répertoire
				$nomfichier2 = explode(".", $copies[$j]);
				//if(strpos("_".$copies[$j], $nomfichier[0])) {//suprimé le  10/10/2016 - A valider avec Movamp
				if(strpos("_".$nomfichier2[0], $nomfichier[0])) {
					$lien[$k] = "$repertoire/$copies[$j]";
					$k++; 
				}
			}
		}
		for($i=0;$i<count($lien);$i++){
			$comp = explode(".", $lien[$i]);
			$ext = $comp[count($comp)-1];
			$resultat .= "<a href=\"$lien[$i]\"><img src=\"./icon/$ext.gif\"/></a> ";
		}
		
		return("$resultat");
		//return("$epreuve");
	}
	
	function note2copie($nom2,$classe,$epreuve,$matiere,$ladate){
		$resultat = "----";
		$fichieralire = "./files/$classe/$matiere/$epreuve.txt";
		if(file_exists($fichieralire)){
			$resultat = "<a href=\"./planning.php?action=19&file=$fichieralire&nom=$nom2&ladate=$ladate\">Créer la copie</a>";
			$fp = fopen($fichieralire, "r");
			while(!feof($fp)){
				$ligne = fgets($fp);
				$part = explode(":", $ligne);
				if($part[0]==$nom2) $resultat=$part[1];
			}
			fclose($fp);
		}
		
		return $resultat;
	}
	
	
	function lescopies3($nom2,$classe,$epreuve,$repertoire_copies){// A corriger...
		$resultat = "";
		$nom = explode(" ", $nom2);
		$nomfichier = explode(".", $epreuve);
		$k = 0;
		for($i=0;$i<count($nom);$i++){
			$repertoire = "$repertoire_copies/$nom[$i]";
			$copies = scandir($repertoire);
			for($j=0;$j<count($copies);$j++){
				$nomfichier2 = explode(".", $copies[$j]);
				if(strpos("_".$copies[$j], $nomfichier[0])) {
					$mdr[$k] = md5_file("$repertoire/$copies[$j]");
					$lien[$k] = "$repertoire/$copies[$j]";
					$k++; 
				}
			}
		}
		for($i=0;$i<count($lien);$i++){
			$comp = explode(".", $lien[$i]);
			$ext = $comp[count($comp)-1];
			$resultat .= "<a href=\"$lien[$i]\"><img src=\"./icon/$ext.gif\"/></a> ";
		}
		$resultat2 = "$nom2 ";
		for($i=0;$i<count($lien);$i++){
			$comp = explode(".", $lien[$i]);
			$ext = $comp[count($comp)-1];
			$resultat2 .= "$mdr[$i] ";
		}
		
		
		return("$resultat:$resultat2");
	}


	function beau_nombre($float){//Retourne un nombre reel formatée  à ma guise
		$texte = number_format($float,2);
		return $texte;
	}

	function graphe07($notes,$filesave){
		$image07 = imagecreatefrompng("./graphe.png");
		$jaune = imagecolorallocate ($image07, 240, 240, 0 );//defini le jaune
		$noir = imagecolorallocate ($image07, 0, 0, 0 );//defini le noir
		
		for($i=0;$i<count($notes);$i++) $haut[$i]=0;
		for($i=0;$i<count($notes);$i++){
			$lanote = $notes[$i]/2;
			$part = explode(".", $lanote);
			$haut[$part[0]]++;
		}
		$max = 0;
		$haut[9]+=$haut[10];
		for($i=0;$i<10;$i++) if($max<$haut[$i]) $max = $haut[$i];
		
		
		$step = 30/$max;
		for($i=0;$i<$max;$i++){
			$y = 2 + $step*$i;
			imageline($image07,2,$y,394,$y,$noir);
		}
		
		for($i=0;$i<10;$i++){
			$y = 32 - $step*$haut[$i];
			$x = 6+$i*39;
			if($haut[$i]>0) {
				imagefilledrectangle($image07,$x,32,$x+30,$y,$jaune);
				imagerectangle($image07,$x,32,$x+30,$y,$noir);
			}
		}
		
		$file_image = str_replace("txt", "png", $filesave);
		imagepng($image07,$file_image);
	}

	function barregraphe($notes,$sup,$filesave,$noms){//Renvoie un baregraphe des notes sous forme d'image
		for($i=0;$i<count($notes);$i++){
			//$val = ($notes[$i]/2);
			//$part = explode(".", "$val");
			//$Y[$part[0]]++;
			if($i<count($notes)-1) {
				$listedesnotes .= rtrim("$notes[$i]").":";//pour nettoyer
				$listedesnoms .= rtrim("$noms[$i]").":";
			}
			else {
				$listedesnotes .= rtrim("$notes[$i]");
				$listedesnoms .= rtrim("$noms[$i]");
			}
		}
		//$Y[9]+=$Y[10];
		//$nuage = "";
		//for($i=0;$i<10;$i++) $nuage .= "Y$i=$Y[$i]&";
		
		//$val = ($sup/2);
		//$part = explode(".", "$val");		
		//if($sup!="") $nuage .= "PP=$part[0]"; else $nuage .= "PP=";
				
		//Version avril 2016
		graphe07($notes,$filesave);
		$file_image = str_replace("txt", "png", $filesave);
		
		if($filesave!=""){//Sauvegardes des valeurs
			$image = "<a href=\"./geo.php?nomfichier=$filesave\">";
			//$image .= "<img src=\"../GestionConfig/Applications/graphe_notes3.php?$nuage\"/></a>";
			$image .= "<img src=\"$file_image\"/></a>";
			$fp = fopen($filesave, "w");
			fprintf($fp, "$listedesnotes\n$listedesnoms");
			fclose($fp);
		}
		else{
			$image .= "<img src=\"$file_image\"/>";
		}

		if($listedesnoms=="") $image = "";
		
		return($image);
	}
	
	function liste2texte($valeurs){
		$liste = $valeurs[0];
		for($i=1;$i<count($valeurs);$i++) $liste .=":$valeurs[$i]";
		return($liste);
	}
	
	
	
	function menu_deroulant($liste,$nom,$selected){ //Crée un menu deroulant avec la liste $liste et de nom $nom
		$lemenu = "<SELECT name=\"$nom\">";
		$lemenu .= "<OPTION>----</OPTION>";
		for($i=0;$i<count($liste);$i++){
			$drap = true;
			if($selected==$liste[$i]) {
				$lemenu .= "<OPTION selected>$liste[$i]</OPTION>";
				$drap = false;
			}else $lemenu .= "<OPTION>$liste[$i]</OPTION>";
		}
		//if($drap) $lemenu .= "<OPTION $selected selected>";
		$lemenu .= "</SELECT>";
		return $lemenu;
	}
	
	function listedesparticipants($filename){//Retourne la liste ordonnée des participants
		$fp = fopen($filename, "r");
		$k = 0;
		if($fp){
			while(!feof($fp)){
				$ligne = fgets($fp);
				$part = explode(":", $ligne);
				$drap = true;
				for($i=0;$i<$k;$i++) if($liste[$i]==$part[0]) $drap = false;
				
				if($drap) {
					$liste[$k] = $part[0];
					$k++;
				}
			}
			sort($liste);
			
			return $liste;
		}
	}
	
	
	function submit(){
		echo("<input type=\"submit\" value=\"Valider\">");
	}
	
	function champs($nom,$valeur){//Retourne une question de valeur $valeur et de nom $nom
		$long = 1+strlen($valeur);
		if($long<10) $long = 10;
		return("<input type=\"text\" name=\"$nom\" value=\"$valeur\" size=\"$long\"\>");
	}
	
	function nbparticipants($listedenom){
		$data = explode(" ", $listedenom);
		return(count($data));
	}
	
	function estfichier($nom){// Fichier ou non ?
		$drap = true;
		$data = explode(".", $nom);
		if($data[0]=="") $drap = false;
		if($nom[0]=="_") $drap = false;
		if($nom=="index.htm") $drap = false; //Nom du fichier questionnaire
		if($nom=="rep") $drap = false; //Nom du répertoire des réponse au questionnaire
		
		return($drap);
	}
	
	function lien($filename){ //Affiche un lien vers un fichier defini par son chemin
		echo("<a href=\"$filename\">$filename</a>");
	}
	
	function afficheliste($liste){//Affiche une liste 
		$nbelt = count($liste);
		echo("<p>$nbelt:");
		for($i=0;$i<$nbelt;$i++) echo("$liste[$i]/");
		echo("</p>");
	}
	
	function periode($nom){// Donne le nombre de la période 1, 2....
		if(strpos($nom, "1")) $data = 1 ;
		if(strpos($nom, "2")) $data = 2 ;
		//$data = explode(" ", $nom);
		return($data);
	}
	
	function coefmat($nom){//Donne le coef de la matière TP 1 et Cours 1
		$coef = 1;
		$texte = strtolower("_$nom");
		$pos = strpos($texte,"oral"); if($pos) $coef = 1; //Coef pour l'oral
		//$pos = strpos($texte,"instrum"); if($pos) $coef = 0; //Coef pour ne pas tenir compte de l'instrum en CIRA2
		return($coef);
	}
	
	function dansgroupe($groupe,$nom) //Vérifie que $nom est dans le $groupe
	{
		$drap = false;
		
		$listedenom = explode(" ", $groupe);
		for($i=0;$i<count($listedenom);$i++) if($listedenom[$i]==$nom) $drap = true;
		
		return($drap);
	}
	
	
	function dejavu($liens,$liens_vus){
		$drap = 0;
		$tab = explode(" ", $liens);
		for($i=1;$i<count($tab);$i++) if(dansgroupe($liens_vus,$tab[$i])&&(strlen($tab[$i])>10)) $drap++;
		
		return($drap);
	}
	
	
	function affiche($texte){ //affiche un texte et un saut à la ligne
		echo("<p>$texte</p>");
	}
	
	function photode($nom) { //fournie la photo et un lien vers la fiche de l'élève
		$lesnom = explode(" ", $nom);
		for($i=0;$i<count($lesnom);$i++) $lesphotos .= "<a href=\"./eleve.php?nom=$lesnom[$i]\"><img src=\"./photos/$lesnom[$i].jpg\" height=\"133px\"/></a>";
		return($lesphotos);
	}

	function photobord($nom,$couleur) { //fournie la photo et un lien vers la fiche de l'élève
		$lesnom = explode(" ", $nom);
		for($i=0;$i<count($lesnom);$i++) {
			if(file_exists("./photos/$lesnom[$i].jpg"))
				$lesphotos .= "<a href=\"./eleve.php?nom=$lesnom[$i]\"><img src=\"./photos/$lesnom[$i].jpg\" height=\"133px\" style=\"border:solid 4px $couleur;\" id=\"$nom\"/></a>";
			else 
				$lesphotos .= "<a href=\"./eleve.php?nom=$lesnom[$i]\"><img src=\"./photos/----.jpg\" height=\"133px\" style=\"border:solid 4px $couleur;\"id=\"$nom\"/></a>";
		}
		return($lesphotos);
	}
	
	function tableau($content) {//Affiche $content dans un table 1x1
		echo("<table><tr bgcolor=\"yellow\"><td>$content</td></tr></table>\n");
	}
	
	function eleve_present($nom,$laclasse,$mois,$jour){
		$drap = true;
		$repertoire_name = "./files/$laclasse/_Appels/";
		if($jour<10) $jour = "$jour[1]";
		if($jour>100) $jour = "$jour[2]";
		$filename = "$repertoire_name$jour"."_$mois.txt"; 
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			while(!feof($fp)){
				$ligne123 = fgets($fp);
				$part = explode(":", $ligne123);
				if($part[0]==$nom){
					if($part[1]=="Absent") $drap=false;
				}
			}
			fclose($fp);
		}else echo("<p>Erreur 1410 : Le fichier $filename n'existe pas !!</p>");
		
		return $drap;
	}
	
	function tabDplannings($laclasse,$lesdates,$ladate){
		$resultat = "<table>";
		//mois d'abord
		for($i=0;$i<count($lesdates);$i++){
			$part = explode("/", $lesdates[$i]);
			if($part[1]<7) $part[1]=70+$part[1];
			
			$lesdates[$i]="$part[1]:$part[0]";
		}
		
		sort($lesdates);
		$part_ladate = explode("/", $ladate);
		$ligne1 = "<tr>";
		$ligne2 = "<tr>";
		for($i=0;$i<count($lesdates);$i++){
			$part = explode(":", $lesdates[$i]);
			if($part[0]>70) $part[0]=str_replace("7", "0", $part[0]);
			$theme = "class=\"present\"";
			$txt_color = "black";
			if(($part[0]==$part_ladate[1])&&($part[1]==$part_ladate[0])) {
				$theme = "class=\"absent\"";
				$txt_color = "orange";
			}
			$ligne1 .= "<td $theme>$part[0]</td>";//les mois
			$ligne2 .= "<td $theme><a href=\"planning.php?action=3&ladate=$part[1]/$part[0]\"><font color=\"$txt_color\">$part[1]</font></a></td>";//les jours
		}
		
		$ligne1 .= "</tr>";
		$ligne2 .= "</tr>";
		
		$resultat .= "$ligne2$ligne1</table>";
		return $resultat;
	}



	
	function tabDappels($laclasse,$lesdates){
		$resultat = "<table>";
		//mois d'abord
		for($i=0;$i<count($lesdates);$i++){
			$part = explode("/", $lesdates[$i]);
			if($part[0]<10) $part[0]="0$part[0]";
			if($part[1]<6) $part[1]="7$part[1]";
			
			$lesdates[$i]="$part[1]:$part[0]";
		}
		
		sort($lesdates);
		$ligne1 = "<tr>";
		$ligne2 = "<tr>";
		for($i=0;$i<count($lesdates);$i++){
			$part = explode(":", $lesdates[$i]);
			if($part[0]>70) $part[0]=str_replace("7", "", $part[0]);
			$theme = "class=\"present\"";
			$ligne1 .= "<td $theme>$part[0]</td>";//les mois
			$jour = $part[1];
			if($jour<10) $jour=$jour[1];
			$ligne2 .= "<td $theme><a href=\"./index.php?ladate=$jour/$part[0]\">$part[1]</a></td>";//les jours
		}
		
		$ligne1 .= "</tr>";
		$ligne2 .= "</tr>";
		
		$resultat .= "$ligne2$ligne1</table>";
		return $resultat;
	}
	
	
	function lesabsences2($laclasse,$nom,$lesdates){
		$resultat = "<table>";
		//mois d'abord
		for($i=0;$i<count($lesdates);$i++){
			$part = explode("/", $lesdates[$i]);
			if($part[0]<10) $part[0]="0$part[0]";
			if($part[1]<7) $part[1]=$part[1]+70;//pour le début de l'année suivante	j'ajoute un 7 devant		
			$lesdates[$i]="$part[1]:$part[0]";
		}
		
		sort($lesdates);
		$ligne1 = "<tr><td>M</td>";
		$ligne2 = "<tr><td>J</td>";
		for($i=0;$i<count($lesdates);$i++){
			$part = explode(":", $lesdates[$i]);
			if($part[0]>70) $part[0]=str_replace("7", "0", $part[0]);//pour le début de l'année suivante je remplace le 7 que j'ai mis...
			if(!eleve_present($nom,$laclasse,$part[0],$part[1])) $theme = "class=\"absent\"";
			else $theme = "class=\"present\"";
			$ligne1 .= "\n<td $theme>$part[0]</td>";//les mois
			$ligne2 .= "<td $theme>$part[1]</td>";//les jours
		}
		
		$ligne1 .= "</tr>";
		$ligne2 .= "</tr>";
		
		$resultat .= "$ligne2$ligne1</table>";
		return $resultat;
	}
	
	function inverse_nb($nb){//inverse 01_02 en 02_01
		$part = explode("_", $nb);
		return("$part[1]_$part[0]");
	}
	
	function plan_sort($plannings){
		$nb = count($plannings);
		for($i=0;$i<$nb;$i++) {
			$part = explode(".", $plannings[$i]);
			$plannings[$i] = inverse_nb($part[0]); //la partie sans .txt
		}
		sort($plannings); echo("<br>");
		for($i=0;$i<$nb;$i++) {
			$plannings[$i] = inverse_nb($plannings[$i]); 
			$plannings[$i] .= ".txt";
		}
		
		return $plannings;
	}
	
	//_____________________________________________________________________________ FIN DES FONCTIONS _____________________________________________________________

	//LISTE LES MATIERES ET EPREUVES
	$repertoire = "./files/$classe"; 	
	$matieres = scandir($repertoire);
	sort($matieres);
	$listedesmatieres = "Mati&egrave;res : ";
	$i=0;
	$k=0;
	$l=0;//
	$deroulant1 = "<SELECT name=\"mat\">";
	while( $i < count($matieres)){
		if(estfichier($matieres[$i])) {
			$listedesmatieres .= "<a href=\"./matiere.php?mat=$matieres[$i]\">$matieres[$i]</a> ";
			$deroulant1 .= "<OPTION>$matieres[$i]";
				$tableaudesmatieres[$l]=$matieres[$i]; $l++;
			//LISTE DES EPREUVES
			$repertoire = "./files/$classe/$matieres[$i]";
			$epreuves = scandir($repertoire);
			sort($epreuves);
			$j=0;
			while ( $j < count($epreuves)){
				if(estfichier($epreuves[$j])) {
					$lepreuve1[$k] = $epreuves[$j].".".$matieres[$i]."."; 
					$k++;
				}
				$j++;
			}
		}
		$i++;
	}
	$deroulant1 .= "</SELECT>";
	
	//LISTE DES EPREUVES VERSION 2
	if($lepreuve1) sort($lepreuve1);
	$listedesepreuves = "Epreuves : ";
	$deroulant2 = "<SELECT name=\"epr\">";
	for($i=0;$i<count($lepreuve1);$i++){
		$part = explode(".", $lepreuve1[$i]);
		$tableaudesepreuves[$i]=$part[0];
		$deroulant2 .= "<OPTION>$part[0]</OPTION>";
		$listedesepreuves .= "<a href=\"./epreuve.php?mat=$part[2]&epr=$part[0].$part[1]\">$part[0]</a> ";
	}
	$deroulant2 .= "</SELECT>";
	
	//LISTE DES PLANNINGS
	$repertoire = "./files/$classe/_Plannings";
	if(file_exists($repertoire)) {
		$plannings = scandir($repertoire);
		$plannings = plan_sort($plannings);	
	}
	$listedesplannings = "Plannings : ";
	$i=0;$k=0;
	while($i < count($plannings)){
		if(estfichier($plannings[$i])){
			$labonnedate = explode(".", $plannings[$i]);
			$ladatetxt=str_replace("_","/",$labonnedate[0]);
			$listedesplannings .= "<a href=\"./planning.php?action=3&ladate=$labonnedate[0]\">$ladatetxt</a> ";
			$tableauplanning[$k] = $ladatetxt; 
			$k++; 
		}
		$i++;
	}

	//LISTE DES ELEVES DE LA CLASSE
	$deroulant3 = "<SELECT name=\"elv\" id=\"elv\" onchange=\"addelv(this.value);\"><OPTION>----</OPTION>";
	$listedeseleves = "&Eacute;l&egrave;ves : ";
	$laclassefile = "./files/$classe.txt";
	$fichierdenom = fopen($laclassefile, "r"); 
	$k = 0;
	while (!feof($fichierdenom)){
		$ligne123 = fgets($fichierdenom);
		$leseleves = explode(":", $ligne123);
		$nouveau = true;
		if($leseleves[8]=="oui") {
			$nouveau = false;
		}
		for($i=0;$i<$k;$i++){
			if($leseleves[0]==$leleve[$i]) $nouveau = false;
		}
		if($nouveau){
			$leleve[$k] = $leseleves[0];
			$listedeseleves .= "<a href=\"./eleve.php?nom=$leleve[$k]\">$leleve[$k]</a> ";
			$deroulant3 .= "<OPTION>$leleve[$k]</OPTION>";
			$k++;
		}
	}
	fclose($fichierdenom);
	$deroulant3 .= "</SELECT>";
	
	//LISTE DES APPELS
	$listedesappels = "Appels : ";
	$repertoire = "./files/$classe/_Appels";
	$appels = scandir($repertoire);
	sort($appels);
	$i=0;
	$k=0;
	while($i < count($appels)){
		if(estfichier($appels[$i])){
			$labonnedate = explode(".", $appels[$i]);
			$ladatetxt=str_replace("_","/",$labonnedate[0]);
			$listedesappels .= "<a href=\"./appel.php?ladate=$labonnedate[0]\">$ladatetxt</a> ";
			$tableaudesappels[$k] = $ladatetxt; $k++;
		}
		$i++;
	}
	
	//LISTE DES CLASSES
	$listedesclasses = "<select name=\"classe\" id=\"classe\" onchange=\"newclasse(this.value);\">";
	$repertoire = "./files";
	$classes = scandir($repertoire);
	sort($classes);
	$i=0;
	while($i < count($classes)){
		if(estfichier($classes[$i])){
			$labonneclasse = explode(".", $classes[$i]);
			if($labonneclasse[1]!="") 
				if($labonneclasse[0] != $classe) $listedesclasses .= "<option>$labonneclasse[0]</option>";
				else $listedesclasses .= "<option selected>$labonneclasse[0]</option>";
		}
		$i++;
	}	
	$listedesclasses .= "</select>";
	
	include("./lesvariables.php");
	
	//LISTE DES COPIES A RANGER
	$listedesTPs = "Copies : ";
	//$origine_filename = "../sav/TP";
	$origine_filename = "./files/$classe/_Sujets2TP/Copies";

	$listetp = scandir($origine_filename);
	sort($listetp);
	$i=0;$k=0;
	while($i < count($listetp)){
		if(estfichier($listetp[$i])){
			$listedesTPs .= "<a href=\"./ranger.php?file=$listetp[$i]\">$listetp[$i]</a> ";
			$tableaudesTP[$k] = $listetp[$i]; $k++;
		}
		$i++;
	}

?>
