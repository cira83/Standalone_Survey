<?php
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	$action44 = "./DSZone.php?action=44";

	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets";
	$repertoire_DS = "./files/$classe/_Copies/";
	$lesrepertoires = scandir($repertoire_DS);
	$i = 0;
	$arrayjava = "var liste2nom = [";
    //Liste des sujets disponibles
	foreach($lesrepertoires as $nom01){
		$nomsujet2DS = "$repertoire_DS$nom01/rep/index.htm";
		if(file_exists($nomsujet2DS)){
			if($i) $arrayjava .= ",\"$nom01\"";
			else $arrayjava .= "\"$nom01\"";
			$i++;
		}
	}

	$arrayjava .= "];\n";

?>

<script>
	<?php echo($arrayjava); ?>
	function change_sujet(selection) {
		var xhr = null;
		var xhr = new XMLHttpRequest();
		if(selection.value) reponse = prompt("Charger le "+selection.value.split(" ")[0]+" de "+ selection.id.replace("nom_","") +" ? (O/N) ");
		if(reponse=="O") {
		    chemin = "./DSMove.php?valeurs="+selection.value+":"+ selection.id.replace("nom_","")+":";
		    xhr.open("GET", chemin, true);
		    xhr.send(null);

			location.reload() ;
		}
	}


	function miseajour(id_name) {
        var ip = document.getElementById(id_name);
        var etat = document.getElementById("etat_"+id_name);

        var xhr = null;
        var xhr = new XMLHttpRequest();
        var tab;

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                tab = xhr.responseText.split(":");
                ip.innerHTML = tab[0];
                etat.innerHTML = tab[1];
            }
        };

        //xhr.open("GET", "./chatES.php", true);
        chemin = "./DSReponses.php?elv="+id_name;
        xhr.open("GET", chemin, true);
        xhr.send(null);
    }

	function refresh_event() {
		for(i=0;i<liste2nom.length;i++) miseajour(liste2nom[i]);
	}

	// Appelle la fonction diminuerCompteur toutes les secondes (1000 millisecondes)
    setInterval(refresh_event, 1000);

	function logout(){
		document.cookie = 'elv=';
		document.cookie = 'password=';
		lien = './chat.php';
		window.location.replace(lien);
	}

	function login(){
		pwd = document.getElementById('password').value;
		elv = document.getElementById('elv').value;
		classe = document.getElementById('classe').value;

		document.cookie = 'elv='+elv;
		document.cookie = 'password='+pwd;
		document.cookie = 'laclasse='+classe;

		lien = './chat.php';
		window.location.replace(lien);
	}

</script>



<?php
	include("./haut_DS3.php");
	include("./DS_Securite.php");// function DSMDP($classe, $elv)

	function start($nom, $classe){//---------------------------------------------- passe en mode ON
		$drap = false;
		$repertoire = "./files/$classe/_Copies/$nom/rep";
		if(!file_exists($repertoire)) mkdir($repertoire);
		chmod($repertoire,0777);

		$fichier_on = "$repertoire/on.txt";
		if(!file_exists($fichier_on)){//pour ne pas changer de code en cas de correction du sujet
			$fp = fopen($fichier_on, "w");
			$code = rand(1000,9999);//code unique
			fwrite($fp, "$code");
			fclose($fp);
			chmod($fichier_on,0777);
			$repertoire_reponses = "$repertoire/$code";
			mkdir($repertoire_reponses);
			chmod($repertoire_reponses,0777);
		}



		echo("ON pour $nom, code $code<br>");
		return $drap;
	}


	//Le 11 novembre 2017
	function start_stop($nom, $classe){//-------------------------------------------  inversion mode on/off et retour de l'état
		$drap = false;
		$repertoire = "./files/$classe/_Copies/$nom/rep";
		$fichier_on = "$repertoire/on.txt";
		$fichier_off = "$repertoire/off.txt";

		if(file_exists($fichier_on)) rename($fichier_on, $fichier_off);
		else rename($fichier_off, $fichier_on);
	}


	function state_onoff($nom, $classe){//-------------------------------------------  retour de l'état on/off
		$filename ="./files/$classe/_Copies/$nom/rep/on.txt";
		return(file_exists($filename));
	}

	function bouton_onoff($nom, $classe){//-------------------------------------------  bouton on/off
		$etat = state_onoff($nom, $classe);
		if($etat) $bouton = "<a href=\"./DSZone.php?action=OnOff&name=$nom\">Marche</a>";
		else $bouton = "<a href=\"./DSZone.php?action=OnOff&name=$nom\">Arrêt</a>";
		return $bouton;
	}

	function file_liste2($dir){
		$session_file_name = "$dir/sessions.txt";
		$synthese_session = "./files/_liste2session.txt";

		$fp_liste = fopen($synthese_session, "a");
		fwrite($fp_liste, "#$dir:");

		if(file_exists($session_file_name)) {
			$fp2020 = fopen($session_file_name, "r");
			while(!feof($fp2020)) {
				$ligne = fgets($fp2020);
				$part = explode(":", $ligne);
				$part3 = explode("/", $part[1]);
				$id .= "<font color=\"green\">$part3[2]/$part3[3] $part3[1]h$part3[0]</font>$br<font size=\"-1\">$part2[2]</font><br>$part[0]<br>";
				fwrite($fp_liste, "$part[0]:");
			}
			fclose($fp2020);
		}

		fclose($fp_liste);
		return "$id";
	}

	function analyse_log() {
		$synthese_session = "./files/_liste2session.txt";
		$fp_liste = fopen($synthese_session, "r");
		$ligne = fgets($fp_liste);
		$elts = explode("#", $ligne);
		for($i=0;$i<count($elts)-1;$i++) {
			$codes = explode(":", $elts[$i]);
			foreach($codes as $code) {
				for($k=$i+1;$k<count($elts);$k++) {
					$codes2 = explode(":", $elts[$k]);
					if(in_array($code, $codes2)&&$code) $jumeau .= "$code<br>";
				}
			}
		}
		fclose($fp_liste);
		return $jumeau;
	}

	function file_liste($dir){
		$lesrepertoires = scandir($dir);
		$laliste = "";
		$bak = "";
		$br = "";
		foreach($lesrepertoires as $nom17){
			$part = explode(".", $nom17);
			if($part[1]=="txt") {
				$link = "<a href=\"./DSZone.php?action=51&dir=$dir/$nom17\">";
				if(strpos("_$nom17", "sessions")) {
					$link = "<a href=\"$dir/$nom17\">";
					$fp = fopen("$dir/$nom17", "r");
					while(!feof($fp)) $ligne2020 = fgets($fp);
					$part2 = explode(":", $ligne2020);
					$part3 = explode("/", $part2[1]);
					fclose($fp);
					$laliste = "<font color=\"green\">$part3[2]/$part3[3] $part3[1]h$part3[0]</font>$br<font size=\"-1\">$part2[2]</font>$br$laliste";
				}
				else $laliste .= "$br<font size=\"-1\">$link$nom17</a></font>";
				$br = "<br/>";
			}
			$bak = $part[0];
		}
		return $laliste;
	}

	function deroulant_sujet($nom,$classe,$actuel){
		$deroulant = "<select id=\"nom_$nom\" onchange=\"change_sujet(this);\">";
		if($actuel) $deroulant .= "<option value=\"\">$actuel</option>";
		else $deroulant .= "<option value=\"\">----</option>";
		$repertoire_reponses = "./files/$classe/_Copies/$nom/rep";
		if(file_exists($repertoire_reponses)) {
			$listedu = scandir($repertoire_reponses);
			foreach($listedu as $fichier) {
				$part = explode(".", $fichier);
				if((ord($part[0])>64)&&(!$part[1])) {
					$deroulant .= "<option value=\"$part[0]\">$part[0]</option>";
				}
			}

		}


		$deroulant .= "</select>";
		return $deroulant;
	}

	//  ________________________________________________________________________________________      FIN DES FONCTIONS

	//-------------------------------------------------------------         Création du menu pour la liste des répertoires
	$repertoireDcopies = "./files/$classe/_Copies";
	$listeDrepondants = scandir($repertoireDcopies); //echo(count($listeDrepondants));
	$menu_nom = "<select name=\"nom\">";
	$menu_nom .= "<option selected>Tous</option>";
	$u=0;
	foreach($listeDrepondants as $txt){
		if(($txt[0]!="_")&&($txt[0]!=".")&&($txt[0]!="-")&&($txt!="rep")) {
			$menu_nom .= "<option>$txt</option>";
			$leleve2020[$u]=$txt;
			$u++;
		}
	}
	$menu_nom .= "</select>";
	$u=0;


	if($action=="OnOff"){
		$name17 = $_GET[name];
		affiche("OnOff -- $name17");
		start_stop($name17, $classe);
	}

	if($creation_repertoire) affiche($creation_repertoire);


	if($action==44){//--------------------------------------------------------------------------------------- Distribue les sujets
		$lebonnom = $_POST[nom];
		$lebontd = $_POST[td];
		$nomTemporaire = "$repertoire_Sujets/$lebontd/index.htm";

		if($lebonnom=="Tous"){
			foreach($leleve2020 as $txt){//Distribution du sujet à chaque élève
                if(!file_exists("./files/$classe/_Copies/$txt/rep"))  mkdir("./files/$classe/_Copies/$txt/rep");
				$chemin = "./files/$classe/_Copies/$txt/rep/index.htm";
				if(copy($nomTemporaire, $chemin)){
					$Message .= "Votre fichier $chemin est distribué à $txt<br>" ;
					chmod("$chemin",0777);
				}
				else $Message .= "La sauvegarde vers $chemin a échouée !!<br>" ;
				start($txt, $classe);
			}
		}
		else {
            if(!file_exists("./files/$classe/_Copies/$txt/rep"))  mkdir("./files/$classe/_Copies/$txt/rep");
			$chemin = "./files/$classe/_Copies/$lebonnom/rep/index.htm";
			if(copy($nomTemporaire, $chemin)){
				$Message .= "Votre fichier $chemin est distribué à $lebonnom<br>" ;
				chmod("$chemin",0777);
			}
			else $Message .= "La sauvegarde vers $chemin a échouée !!<br>" ;
			start($lebonnom, $classe);
		}
		echo("<p>Action 44 : $Message</p>");
	}


	if($action==111){//----------------------------------------------------------------------------------------    Efface les réponses de nom111 et le sujet - demande de confirmation
		$nom111 = $_GET[nom];
		$td111 = $_GET[td];
		echo("<form method=\"post\" action=\"DSZone.php?action=110&nom=$nom111&td=$td111\">");
		echo("<table><tr><td>Archiver le $td111 de $nom111 ? <input type=\"submit\" value=\"OUI\"> ");
		echo("<input type=\"button\" value=\"NON\" onclick=\"gotolien('./DSZone.php')\"></td></tr></table>");
		echo("</form>");
	}

	if($action==110){//-------------------------------------------------------------------------------------------------     Déplace les réponses de nom111 et le sujet dans rep/$TAG
		$nom111 = $_GET[nom]; //###
		$td111 = $_GET[td];
		$DS_password = DSMDP($classe, $nom111);

		$dossier_rep = "./files/$classe/_Copies/$nom111/rep/$DS_password";
		$dossier_bak = "./files/$classe/_Copies/$nom111/rep/$td111 $DS_password/";
		if(file_exists($dossier_rep)) rename($dossier_rep, $dossier_bak);

		$dossier_rep = "./files/$classe/_Copies/$nom111/rep";
		if(file_exists($dossier_rep)){
			$listeDreponses = scandir($dossier_rep);
			if(!file_exists($dossier_bak)) {
				echo("<p>Création dossier $dossier_bak</p>");
				mkdir($dossier_bak);
			}
			foreach($listeDreponses as $filename){
				$partiesdunom2020 = explode(".", $filename);
				if($partiesdunom2020[1]) {// tous les fichiers sauf .. et .
					$avant = "./files/$classe/_Copies/$nom111/rep/$filename";
					$apres = "$dossier_bak$filename";
					rename($avant, $apres);
				}
			}
			$avant = "./files/$classe/_Copies/$nom111/rep/index.htm";
			$apres = $dossier_bak."index.htm";
			if(file_exists($avant)) rename($avant, $apres);
		}
		$Message = "$td111 de $nom111 archivé";

		echo("<p>Action 110 : $Message</p>");
	}

	if($action==51){
		$file2delete = $_GET[dir];
		echo("<form method=\"post\" action=\"DSZone.php?action=52&dir=$file2delete\">");
		echo("<table><tr><td>Effacer la réponse $file2delete ? <input type=\"submit\" value=\"OUI\"> ");
		echo("<input type=\"button\" value=\"NON\" onclick=\"gotolien('./DSZone.php')\"></td></tr></table>");
		echo("</form>");
	}

	if($action==52){//Efface la réponse
		$poubelle = "./files/$classe/_Copies/_Poubelle";
		if(!file_exists($poubelle)) {
			mkdir($poubelle);
			affiche("$poubelle crée");
		}
		$file2delete = $_GET[dir];
		if(file_exists($file2delete)){
			$apres = "./files/$classe/_Copies/_Poubelle/trash.txt";
			rename($file2delete, $apres);
		}

		$Message = "Réponse $file2delete supprimée";
		echo("<p>Action 52 : $Message</p>");
	}



	if($action==32){//----------------------------------------------------------------------------------------------          Efface les réponses
		$repertoireDcopies = "./files/$classe/_Copies";
		$listeDrepondants = scandir($repertoireDcopies);
		$poubelle = "./files/$classe/_Copies/_Poubelle";
		if(!file_exists($poubelle)) {
			mkdir($poubelle);
			affiche("$poubelle crée");
		}

		foreach($listeDrepondants as $txt){
			$dossier_rep = "./files/$classe/_Copies/$txt/rep/";
			$dossier_poubelle = $dossier_rep."Poubelle/";
			if(!file($dossier_poubelle)) mkdir($dossier_poubelle); //Créé une poubelle par élève

			if(file_exists($dossier_rep)){
				$listeDreponses = scandir($dossier_rep);
				foreach($listeDreponses as $filename){
					if(($filename[0]=="I")||($filename[0]=="R")||($filename[0]=="Q")||($filename[0]=="s")) {
						$avant = "./files/$classe/_Copies/$txt/rep/$filename";
						$apres = "$dossier_poubelle$filename";
						rename($avant, $apres);
					}
				}
			}
		}
		$Message = "Réponses supprimées";
		echo("<p>Action 32 : $Message</p>");
	}




	// -----------------------------------------------------------------------------------------------------------------------------   LES COPIES
	titre_tab("<a href=\"./DSZone.php\"><img src=\"./icon/reload.png\" height=\"20px\"/></a> Les copies");
	$violet_t = "#8d1682";//violet 27min
	$rouge_t = "#fd0002";//rouge 9min
	$orange_t = "#ff8b01";//orange 3min
	$jaune_t = "#ffed02";//jaune 1min
	$vert_t = "#02fe00";//vert 20s
	echo("<table><tr>");

	echo("<td bgcolor=\"black\"></td>");
	echo("<td bgcolor=\"white\" width=\"35px\"><font size=\"-2\">27 min</font></td><td bgcolor=\"$violet_t\"></td>");
	echo("<td bgcolor=\"white\" width=\"30px\"><font size=\"-2\">9 min</font></td><td bgcolor=\"$rouge_t\"></td>");
	echo("<td bgcolor=\"white\" width=\"30px\"><font size=\"-2\">3 min</font></td><td bgcolor=\"$orange_t\"></td>");
	echo("<td bgcolor=\"white\" width=\"30px\"><font size=\"-2\">1 min</font></td><td bgcolor=\"$jaune_t\"></td>");
	echo("<td bgcolor=\"white\" width=\"30px\"><font size=\"-2\">20 s</font></td><td bgcolor=\"$vert_t\"></td>");
	echo("<td bgcolor=\"white\" width=\"10px\"><font size=\"-2\">0</font></td><td bgcolor=\"#CCC\"></td>");
	echo("</tr></table>");


	$i=0;
	echo("<table><tr valign=\"Bottom\">");
	foreach($lesrepertoires as $nom17){
		$nomsujet2DS = "$repertoire_DS$nom17/rep/index.htm";
		if(($nom17[0]!="_")&&($nom17[0]!=".")){
			// Lecture du nom du sujet
			$titre_sujet = 0;
			$sujet_present = file_exists($nomsujet2DS);
			if($sujet_present) {
				$fp_sujet1 = fopen($nomsujet2DS, "r");
				$ligne1 = fgets($fp_sujet1);
				fclose($fp_sujet1);
				$part_ligne1 = explode("#", $ligne1);
				$titre_sujet = $part_ligne1[1];
			}
			$deroulant_disponibles = deroulant_sujet($nom17,$classe,$titre_sujet);
			$i++;
			$photo = "./files/$classe/_Photos/$nom17.jpg";
			if(!file_exists($photo)) $photo = "./photos/----.jpg";
			$bouton = bouton_onoff($nom17,$classe);
			$etatonoff = state_onoff($nom17, $classe);
			if($etatonoff) $classetd =" bgcolor=\"#0f9d58\" ";
			else $classetd =" bgcolor=\"#FF4000\" ";
			if(!$sujet_present) $classetd =" bgcolor=\"#c0c0c0\" ";
			$info_session = "<span id=\"etat_$nom17\"></span>";
			$hauteur_photo = "80px";
			if($nb2sessions) $info_session = "<span id=\"etat_$nom17\"></span>";
			if($sujet_present) $imp = "<a href=\"./copie2DS.php?name=$nom17&file=$nomsujet2DS\" target=\"_blank\" title=\"imprimer\"><img src=\"icon/imp.gif\" height=\"13px\"></a>";
			else $imp = "";
			$efface = "<a href=\"./DSZone.php?action=111&nom=$nom17&td=$titre_sujet\" color=\"red\"><img src=\"./icon/effacer.jpg\" height=\"15px\" align=\"bottom\"></a>";
			echo("<td $classetd><b>$nom17</b>");
			echo("<br>$deroulant_disponibles $imp<br><a href=\"./devoir_comp.php?name=$nom17\" target=\"_blank\"><img src=\"$photo\" height=\"$hauteur_photo\"></a>");
			echo("<br>$info_session $bouton $efface</a><br><div id=\"$nom17\"></div></td>");
			$Nom_et_sujet[$k] = "$nom17:$titre_sujet:"; $k++; //La liste de nom et du sujet associé
			if($i==7){
				echo("</tr><tr valign=\"Bottom\">");
				$i=0;
			}
		}

	}
	echo("</tr></table>");
?>




<?php
	titre_tab("Les sujets");//---------------------------------------------------------------------------------------------------------    LES SUJETS
	echo("<!-- LES SUJETS -->");
	echo("<table><tr><td>");
	$lessujets = scandir($repertoire_Sujets);
	$menu_td = "<select name=\"td\">";
	foreach($lessujets as $nom01){
		if(estfichier($nom01)) {
			$filename = "$repertoire_Sujets/$nom01/index.htm";
			$repsujet = "$repertoire_Sujets/$nom01";
			$menu_td .= "<option>$nom01</option>";
			if(file_exists($filename)){
				$fp = fopen($filename, "r");
				$titre2ds = fgets($fp);
				$partiesdunom = explode("#", $titre2ds);
				fclose($fp);
				$hauteur = "15px";
				echo("<td><font size=\"+1\"><b>$nom01</b> - $partiesdunom[0] - <font color=\"blue\">$partiesdunom[2]</font></font></td>");
				echo("<td><a href=\"./devoir.php?name=_Sujets/$nom01&file=$repsujet\" target=\"_blank\" Title=\"Corriger\"><img src=\"./icon/sujet_mod.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"./copie2DS.php?name=_Sujets/$nom01&file2=$repsujet\" target=\"_blank\" Title=\"Correction\"><img src=\"./icon/sujet.png\" height=\"$hauteur\"></a></td>");
				echo("<td><a href=\"./sujet2DS.php?name=_Sujets/$nom01&file2=$repsujet\" target=\"_blank\" Title=\"Sujet\"><img src=\"./icon/distrib.png\" height=\"$hauteur\"></a></td>");
				echo("</tr><tr><td>\n");
			}

		}
	}
	echo("</td></tr></table>");
	$menu_td .= "</select>";

?>
	<table>
		<form name="envoi fichier 2" enctype="multipart/form-data" method="post" action="<?php echo("$action44");?>">
		<tr><td>Envoi d'un sujet à</td>
		<td><?php echo($menu_nom);?></td>
		<td><?php echo($menu_td);?></td>
		<!-- <td><input name="fichier_choisi" type="file"></td> -->
		<td><input name="bouton" value="Envoyer" type="submit">
		</td>
		</tr>
		</form>
	</table>

<?php
	titre_tab("Création & Édition");
	//--------------------------------------------------------------------------------------------------------------------                NOUVEAU SUJET
?>
<table><tr>
	<form method="post" action="DSNew.php">
	<td>
		<input type="hidden" value="1" name="action">
		TAG du sujet : <input type="text" name="TAG" size="10px"></td><td>
		Titre du sujet : <input type="text" name="titre" size="50px"></td><td>
		<input name="bouton" value="Nouveau sujet" type="submit">
	</td>
	</form>
	</tr>
	<tr>
	<form method="post" action="DSNew.php">
	<td>
		<input type="hidden" value="2" name="action">
		TAG du sujet : <?php echo($menu_td);?></td><td>
		</td><td>
		<input name="bouton" value="Editer" type="submit">
	</td>
	</tr>
</table>


<?php
	//----------------------------------------------------------------------------------------    Liste des fichiers .txt des répertoires réponses
	titre_tab("Informations");

	$synthese_session = "./files/_liste2session.txt";
	$fp_liste = fopen($synthese_session, "w");
	fclose($fp_liste);

	echo("<table>");
	$i=0;
	$contenu_case1 = "";
	$contenu_case2 = "";
	foreach($Nom_et_sujet as $nom1_sujet1){
		$part_of1 = explode(":", $nom1_sujet1);
		$nom17 = $part_of1[0];
		$code2DS = DSMDP($classe, $nom17);
		$code2DS = "<font color=\"#000000\" title=\"$code2DS\">----</font>";

		$lesreponses = "$repertoire_DS$nom17/rep";
		if(file_exists($lesreponses)&&($nom17!=".")){
			$i++;
			$contenu_case1 .= "<td><font color=\"black\" size=\"+1\">$nom17</font> $code2DS </td>";
			$contenu_case2 .= "<td>".file_liste2($lesreponses)."</td>";
			if($i==3){
				echo("<tr valign=\"top\" bgcolor=\"white\">$contenu_case1</tr>");
				echo("<tr valign=\"top\">$contenu_case2</tr>");
				$contenu_case1 = "";
				$contenu_case2 = "";
				$i=0;
			}
		}
	}
	echo("<tr valign=\"top\" bgcolor=\"white\">$contenu_case1</tr>");
	echo("<tr valign=\"top\">$contenu_case2</tr>");
	echo("</table>");

	$pirate = analyse_log();
	echo("<table><tr><td><font color=\"red\">$pirate</font></td></tr></table>");

	include("./bas_DS.php");
?>
