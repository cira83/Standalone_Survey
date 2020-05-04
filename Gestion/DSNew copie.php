<?php
	$action = isset($_POST['action']) ? $_POST['action'] : NULL;
	//$action = $_POST[action];//1. Nouveau Sujet 2.Editer sujet 3.Supprimer Ligne 4.Editer Ligne 5. Ajouter ligne 6. Saut de page
	if($action==1) $TAG = $_POST['TAG'];//nouveau sujet
	//else $TAG = $_POST['td'];//edition sujet
	else $TAG = isset($_POST['td']) ? $_POST['td'] : NULL;
	
	$num2ligne = isset($_GET['ligne']) ? $_GET['ligne'] : NULL;
		//$num2ligne = $_GET['ligne'];

	$champs = isset($_POST['Champs']) ? $_POST['Champs'] : NULL; //$champs = str_replace("%", "p0ur100", $champs);
	//$champs = $_POST['Champs'];
	$message = "";
	
	if(!isset($action)) $action = isset($_GET['action']) ? $_GET['action'] : NULL;
	if(!isset($TAG)) $TAG = isset($_GET['TAG']) ? $_GET['TAG'] : NULL;
	$pageaafficher = isset($_GET['page']) ? $_GET['page'] : NULL;
	$requete = "./imagesES.php?TAG=$TAG";
	$lettres = array("C","Q","I","T","I","U","L");
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";
	$repertoire_Sujets = "./files/$classe/_Copies/_Sujets/";
	$repertoire_Images = "./files/$classe/_Copies/_Sujets/$TAG/img/";

	$titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;

	include("./haut_DS2.php");

	function add_event($events) {
		$filename = "./files/_enventDS.txt";
		$fp = fopen($filename, "a");
		fwrite($fp, "$events\n");
		fclose($fp);
	}

	function affiche_comment($comment) {
		echo("<!-- $comment -->");
	}


?>
<script>

	function miseajour() {
        ip = document.getElementById("images");

        var xhr = null;
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                ip.innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", "<?php echo($requete);?>", true);
        xhr.send(null);
    }

	// Appelle la fonction diminuerCompteur toutes les secondes (1000 millisecondes)
    setInterval(miseajour, 2000);

	function addimage(lavaleur){
		back = document.getElementById('Champs').value;
		tipe = document.getElementById('tipe').value;
		if(tipe!="I") new_valeur = "<img src=\"<?php echo($repertoire_Images);?>" + lavaleur + "\">";
		else new_valeur = "<?php echo($repertoire_Images);?>" + lavaleur;
		document.getElementById('Champs').value = back + new_valeur;
	}

	function addlien(){
		back = document.getElementById('Champs').value;
		lien = document.getElementById('lien').value;
		texte = document.getElementById('texte').value;
		new_valeur = "<a href=\""+ lien +"\" target=\"_blank\" >" + texte + "</a>";
		document.getElementById('Champs').value = back + new_valeur;
	}

	function addh(lavaleur){
		back = document.getElementById('Champs').value;
		document.getElementById('Champs').value = back + "<h"+lavaleur+">TITRE</h"+lavaleur+">";
	}

</script>



<?php
	// FONCTIONS
	include("./DSFonctions.php");

	function ligne($numero,$code,$contenu,$coef,$quest,$page,$TAG,$pageaafficher) {
		$SUP = "<a href=\"./DSNew.php?action=3&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"Supprimer\"><img src=\"icon/Moins.gif\"/></a>";
		$C = "<a href=\"./DSNew.php?action=5&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"Commentaire\"><img src=\"icon/C_vert.gif\"/></a>";
		$Mod = "<a href=\"./DSNew.php?action=4&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"Mofifier\"><img src=\"icon/Editer.gif\"/></a>";
		$Q = "<a href=\"./DSNew.php?action=51&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"Question\"><img src=\"icon/Q_vert.gif\"/></a>";
		$T = "<a href=\"./DSNew.php?action=52&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"R&eacute;ponse courte\"><img src=\"icon/T_vert.gif\"/></a>";
		$U = "<a href=\"./DSNew.php?action=53&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"R&eacute;ponse longue\"><img src=\"icon/Ligne.gif\"/></a>";
		$I = "<a href=\"./DSNew.php?action=54&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"R&eacute;ponse image\"><img src=\"icon/I_vert.gif\"/></a>";
		$L = "<a href=\"./DSNew.php?action=6&ligne=$numero&TAG=$TAG&page=$pageaafficher#Q$quest\" title=\"Saut de page\"><img src=\"icon/Page.gif\"/></a>";
		$BR = "";//plus besoin, style image changé en Block
		$HR = "<hr>";
		$bgcolor = "bgcolor=\"#e0e0e0\"";// Tableau = #c0c0c0
		switch($code) {
			case "C":
				echo("<table><tr><td align=\"left\"><p class=\"commentaires\">$contenu</p></td><td width=\"10px\"><img src=\"icon/C_vert.gif\" title=\"Commentaire\"/>$HR$SUP$BR$Mod$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "Q":
				echo("<table id=\"Q$quest\"><tr><td align=\"left\"><p class=\"question\"><font color=\"blue\"><b>Q$quest)</b></font> $contenu</p></td><td width=\"10px\"><img src=\"icon/Q_vert.gif\" title=\"Question\"/><br><b>$coef</b>$HR$SUP$BR$Mod$BR$C$BR$T$BR$U$BR$I</td><tr></table>");
				break;
			case "T":
				echo("<table><tr><td $bgcolor>Réponse texte sur une ligne</td><td width=\"10px\"><img src=\"icon/T_vert.gif\" title=\"R&eacute;ponse courte\"/>$HR$SUP$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "U":
				echo("<table><tr><td $bgcolor>Réponse texte<br>sur plusieurs lignes</td><td width=\"10px\"><img src=\"icon/Ligne.gif\" title=\"R&eacute;ponse longue\"/>$HR$SUP$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "I":
				if($contenu=="\n") $amettre = "Réponse image png, jpg ou gif.";
				else $amettre = "<img src=\"$contenu\">";
				//$amettre = "Réponse image png, jpg ou gif.";
				echo("<table><tr><td align=\"center\" $bgcolor>$amettre</td><td width=\"10px\"><img src=\"icon/I_vert.gif\" title=\"R&eacute;ponse image\"/>$HR$SUP$BR$Mod$BR$C$BR$Q$BR$L</td><tr></table>");
				break;
			case "L":
				$page4link = $page-1;
				$link4page = "<a href=\"DSNew.php?TAG=$TAG&page=$page4link\">";
				echo("<table><tr><td bgcolor=\"white\">$link4page Page $page</a></td><td width=\"10px\"><img src=\"icon/Page.gif\" title=\"Saut de page\"/>$HR$SUP$BR$C$BR$Q</td><tr></table>");
				break;
			case "X": // Ligne 0
				echo("<table id=\"Q$quest\"><tr bgcolor=\"yellow\"><td width=\"30px\">$contenu</td><td width=\"10px\">$Mod$BR$C</td><tr></table>");
				break;
		}
	}

	function lecture($filename, $numero) {
		add_event("lecture($filename, $numero)");
		$fp = fopen($filename, "r");
		$i = 0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$i++;
			$part = explode("#", $ligne);
			if($i==$numero) $partie = rtrim($ligne);
			//if($i==$numero) $partie = $ligne;
		}
		fclose($fp);
		return $partie;
	}

	function ecriture($chemin_du_sujet, $num2ligne,$champs) {
		add_event("ecriture($chemin_du_sujet, $num2ligne,$champs)");
		if(file_exists("$chemin_du_sujet.bak")) unlink("$chemin_du_sujet.bak");
		rename($chemin_du_sujet, "$chemin_du_sujet.bak");
		$source = fopen("$chemin_du_sujet.bak", "r");
		$cible = fopen($chemin_du_sujet, "w");
		$order   = array("\r\n", "\n", "\r");
		$replace = '<br/>';
		$champs1 = str_replace($order, $replace, $champs);// nettoie le champs à ajouter
		$champs1 = str_replace("\\","",$champs1);//pour enlever les \ ajouter par je ne sais qui
		$i=0;
		while(!feof($source)){
			$ligne = fgets($source);
			$i++;
			$part = explode("#", $ligne);
			if($num2ligne>1) {
				if($i==$num2ligne) {
					fwrite($cible, "$part[0]#$champs1\n");
				}
				else fwrite($cible, $ligne);
			}
			else {
				if($i==1) fwrite($cible, "$champs1\n");
				else fwrite($cible, $ligne);
			}
		}
	}

	function insert_ligne($chemin_du_sujet, $num2ligne,$champs) {
		add_event("insert_ligne($chemin_du_sujet, $num2ligne,$champs)");
		if(file_exists("$chemin_du_sujet.bak")) unlink("$chemin_du_sujet.bak");
		rename($chemin_du_sujet, "$chemin_du_sujet.bak");
		$source = fopen("$chemin_du_sujet.bak", "r");
		$cible = fopen($chemin_du_sujet, "w");
		$i=0;
		while(!feof($source)){
			$ligne = fgets($source);
			$i++;
			$part = explode("#", $ligne);
			if($i==$num2ligne+1) fwrite($cible, "$champs#\n");
			fwrite($cible, $ligne);
		}
		if($i==$num2ligne) fwrite($cible, "\n$champs#");
	}

	function del_ligne($chemin_du_sujet, $num2ligne) {
		add_event("del_ligne($chemin_du_sujet, $num2ligne)");
		if(file_exists("$chemin_du_sujet.bak")) unlink("$chemin_du_sujet.bak");
		rename($chemin_du_sujet, "$chemin_du_sujet.bak");
		$source = fopen("$chemin_du_sujet.bak", "r");
		$cible = fopen($chemin_du_sujet, "w");
		$i=0;
		while(!feof($source)){
			$ligne = fgets($source);
			$i++;
			$part = explode("#", $ligne);
			if($i!=$num2ligne) fwrite($cible, $ligne);
		}
	}

	function undo_modif($chemin_du_sujet)
	{
		add_event("undo_modif($chemin_du_sujet)");
		if(file_exists("$chemin_du_sujet.bak"))
			rename("$chemin_du_sujet.bak",$chemin_du_sujet);
	}


	//Création du répertoire
	$repertoire_du_sujet = $repertoire_Sujets."$TAG";
	if(!file_exists($repertoire_du_sujet)) {
		mkdir($repertoire_du_sujet);
		echo("<p>Dossier $TAG créer </p>");
		mkdir("$repertoire_du_sujet/img");
	}

	//Création du sujet
	$chemin_du_sujet = $repertoire_du_sujet."/index.htm";
	if(!file_exists($chemin_du_sujet)) {
		$fp = fopen($chemin_du_sujet, "a");
		fwrite($fp, "$titre#$TAG\n");
		fwrite($fp, "C#");
		echo("<p>Sujet créer </p>");
		fclose($fp);
	}

	//Liste des images
	$Deroulant_image = "<select name=\"image\" onchange=\"addimage(this.value);\">";
	$Deroulant_image .= "<option>+ Image</option>";
	if(file_exists($repertoire_Images)){
		$LaListeDesImages = scandir($repertoire_Images);
		foreach($LaListeDesImages as $img) //echo("$img<br>");
		if(est_image($img)) $Deroulant_image .= "<option value=\"$img\">$img</option>";
		$Deroulant_image .= "</select>";
	}
	else echo("<font color=\"red\">Fichier non standard !!</font>");

	if($action==3) {//------------------------------------------------------------------- X : Suppression
		$contenu = lecture($chemin_du_sujet, $num2ligne);
		$part2ligne = explode("#", $contenu);
		$message = "<table>";
		$message .= "<tr><td bgcolor=\"white\">$part2ligne[1]</td><td>";
		$message .= "<tr></form></table>";
		$message .= "<table><form method=\"POST\" action=\"./DSNew.php?action=31&ligne=$num2ligne&TAG=$TAG&page=$pageaafficher\">";
		$message .= "<tr bgcolor=\"red\"><td><b>Supprimer ligne $num2ligne ??</b></td><td><input type=\"submit\"></td><tr></form></table>";
	}

	if($action==31) {
		del_ligne($chemin_du_sujet,$num2ligne);
	}

	if($action==4) {//------------------------------------------------------------------- M : Edition
		$contenu = lecture($chemin_du_sujet, $num2ligne);
		$part2ligne = explode("#", $contenu);
		$icone = icone4lettre($part2ligne[0]);
		$h2 = "<input type=\"button\"value=\"+ Titre 2\" onclick=\"addh(2);\"> ";
		$h3 = "<input type=\"button\"value=\"+ Titre 3\" onclick=\"addh(3);\"> ";
		$part2ligne1 = isset($part2ligne[1]) ? $part2ligne[1] : "";
		$part2ligne2 = isset($part2ligne[2]) ? $part2ligne[2] : "";
		if($num2ligne==1) $part2ligne[1] = $part2ligne[0]."#".$part2ligne1."#".$part2ligne2;
		$part2ligne2 = isset($part2ligne[2])?$part2ligne[2]:"";
		if($part2ligne[0]=="Q") $part2ligne[1] = $part2ligne[1]."#".$part2ligne2;

		$message = "<table id=\"Edition\"><form method=\"POST\" action=\"./DSNew.php?action=41&ligne=$num2ligne&TAG=$TAG&page=$pageaafficher\">";
		$message .= "<tr><td bgcolor=\"white\"><textarea cols=\"90\" rows=\"5\" name=\"Champs\" id=\"Champs\">$part2ligne[1]</textarea></td><td>";
		$message .= "$icone<br>$Deroulant_image<br>$h2<br>$h3<hr><input type=\"submit\"><input type=\"hidden\" id=\"tipe\" value=\"$part2ligne[0]\"></td><tr></form></table>";

		$message .= "<table><tr><td>Lien vers <input type=\"text\" id=\"lien\" size=\"70px\"> sur texte <input type=\"text\" id=\"texte\">";
		$message .= " <input type=\"submit\" onclick=\"addlien();\" value=\"+ Lien\"></td><tr></table>";
		if($part2ligne[0]=="Q") $message .= "<table><tr bgcolor=\"yellow\"><td>Mettre le nombre de points de la question après le # (séparateur décimal = .)</td><tr></table>";
		//$message .= "<table><tr><td bgcolor=\"#0085cf\"><b>Edition ligne $num2ligne</b></td><tr></table>";

		//$racourcie = "<table><tr><td bgcolor=\"#0085cf\"><b><a href=\"#Edition\">Edition ligne $num2ligne</a></b></td><tr></table>";
	}

	if($action==41) {
		ecriture($chemin_du_sujet, $num2ligne,$champs);
	}

	if($action==5) {
		insert_ligne($chemin_du_sujet, $num2ligne,"C");
	}

	if($action==51) {
		$contenu = insert_ligne($chemin_du_sujet, $num2ligne,"Q");
	}

	if($action==52) {
		insert_ligne($chemin_du_sujet, $num2ligne,"T");
	}

	if($action==53) {
		insert_ligne($chemin_du_sujet, $num2ligne,"U");
	}

	if($action==54) {
		insert_ligne($chemin_du_sujet, $num2ligne,"I");
	}

	if($action==6) {
		insert_ligne($chemin_du_sujet, $num2ligne,"L");
	}

	if($action==100) {//------------------------------------------------------------------- CHARGE IMAGES
		//on vérifie que le champ est bien rempli:
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

			if(!file_exists($repertoire_Images)) {
				mkdir($repertoire_Images);
				$message .= "<table><tr><td>Répertoire image créé.</td><tr></table>";
			}

			if(est_image($nomFichier)) {
				if(copy($nomTemporaire, $repertoire_Images.$nomFichier)){
					chmod("$repertoire_Images$nomFichier",0777);
					$extension = substr(strrchr($nomFichier, '.'), 1);
					$LDIMAGE = scandir($repertoire_Images);
					$nbimageplus1 = count($LDIMAGE) - 2;
					if($nbimageplus1<10) $nbimageplus1 = "0$nbimageplus1";//pour commencer par 01, 02 .....
					$nomFichier_propre = "$nbimageplus1.$extension";
					rename("$repertoire_Images$nomFichier", "$repertoire_Images$nomFichier_propre");
					$message .= "<table><tr><td>Votre fichier <font color=\"blue\">$nomFichier</font> est sauvegardé.</td><tr></table>" ;
				}
				else $message .= "<table><tr><td>La sauvegarde a échouée !!</td><tr></table>" ;
			}
			else $message .= "<table><tr><td>Format non supporté</td><tr></table>" ;
		}
		else $message .= "<table><tr><td>Pas de fichier choisi !!!</td><tr></table>" ;

	}

	if($action==101) {//------------------------------------------------------------------- UNDO
		undo_modif($chemin_du_sujet);
	}

	affiche_comment("action = $action");
	affiche_comment("champs = $champs");

	$i=0;
	$quest=0; $quest_page=0;
	$page=0;
	$fp = fopen($chemin_du_sujet, "r");
	$ligne = fgets($fp);
	$i++;
	$part = explode("#", $ligne);
	$sur = 0; $sur_page=0;


//------------------------------------------------------------------------------------------------------ AFFICHAGE
	$pageaafficher_vu = intval($pageaafficher) + 1;
	$vu_eleve = "</td><td><a href=\"./devoir.php?name=_Sujets/$TAG&file=./files/$classe/_Copies/_Sujets/$TAG&page=$pageaafficher_vu\" target=\"_blank\"><img src=\"./icon/sujet_mod.png\" height=\"40px\" title=\"Vu candidat\"/></a>";
	// Première Ligne avec le Titre
	ligne($i,"X","<a href=\"./DSZone.php\"><img src=\"./icon/home.png\" height=\"20px\" title=\"Home\"/></a></td><td width=\"30px\"><a href=\"./DSNew.php?TAG=$TAG&action=101&page=$pageaafficher\"><img src=\"./icon/reload.png\" height=\"20px\" title=\"Annuler la derni&egrave;re modification\"/></a></td><td><font size=\"+3\">$TAG - $part[0]</font>$vu_eleve",$part[1],$quest,$page,$TAG,$pageaafficher);
	if($i==$num2ligne) echo($message);

	//if($i==$num2ligne-1) echo($message);
	//if($racourcie) echo($racourcie);
	$sur = 0;
	while(!feof($fp)){
		$ligne = fgets($fp);
		$i++;
		$part = explode("#", $ligne);
		if($part[0]=="Q") {
			$quest++;
			$sur = $sur + floatval(isset($part[2])?$part[2]:0);
		}
		if($part[0]=="L") $page++;
		if($pageaafficher==$page) {
			if($part[0]=="Q") {
				$quest_page++;
				$sur_page = $sur_page + floatval(isset($part[2])?$part[2]:0);
			}
			if(in_array($part[0],$lettres)) {
				ligne($i,$part[0],$part[1],isset($part[2])?$part[2]:"",$quest,$page,$TAG,$pageaafficher);//= isset($_POST['action']) ? $_POST['action'] : NULL;
			}
		}
		if($i==$num2ligne) echo($message);//informations et edition

		if(($part[0]=="L")&&($pageaafficher==$page-1)) ligne($i,$part[0],$part[1],isset($part[2])?$part[2]:"",$quest,$page,$TAG,$pageaafficher);//dernière ligne avec numèro de page
	}
	fclose($fp);

	//Lien vers les pages
	$bas2page = "<table><tr>";
	for($i=0;$i<$page;$i++) {
		$numero2page = $i+1;
		if($pageaafficher==$i) $bas2page .= "<td bgcolor=\"white\"><a href=\"DSNew.php?TAG=$TAG&page=$i\">Page $numero2page</a></td>";
		else $bas2page .= "<td><a href=\"DSNew.php?TAG=$TAG&page=$i\">Page $numero2page</a></td>";
	}
	$numero2page = $i+1;
	if($pageaafficher==$i) $bas2page .= "<td bgcolor=\"white\"><a href=\"DSNew.php?TAG=$TAG&page=$i\">Page $numero2page</a></td>";
	else $bas2page .= "<td><a href=\"DSNew.php?TAG=$TAG&page=$i\">Page $numero2page</a></td>";
	$bas2page .= "</tr></table>";
	echo($bas2page);

	$lien4retour = "DSNew.php?page=$pageaafficher";
	$pageaafficher++; //Pour afficher plus loin
	$page++;//Pour afficher plus loin
?>

<!-- Partie à droite -->
</td><td valign="top" width="210px">
<b>Document</b><br>
Nb de questions : <?php echo($quest); ?><br>
Nb de points : <?php echo($sur); ?><hr>
<b>Page <?php echo("$pageaafficher/$page"); ?></b><br>
Nb de questions : <?php echo($quest_page); ?><br>
Nb de points : <?php echo($sur_page); ?><hr>
<b>Images disponibles</b><br>
(Largeur Max 750 px)<hr>
<form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo($lien4retour);?>">
<input name="td" type="hidden" value="<?php echo($TAG);?>">
<input name="action" type="hidden" value="100">
<input name="fichier_choisi" type="file"><br>
<input type="submit" value="Enregistrer"><br><hr>
</form>
<span id="images"></span>
</td></tr></table>
