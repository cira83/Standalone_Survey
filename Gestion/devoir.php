<?php
	include("./security.php");
	include("./DSFonctions.php");
	$numero2session = session_id();//Numero de session

	$fait = "&#9679;";
	$non_fait = "&#9675;";


	$nom = $_COOKIE['nom'];
	$password = $_COOKIE['password'];
	$files = "./files/";
	$classe = $_COOKIE['laclasse'];
	$nb2pages = 0;

	$pagenumber = $_GET[page];//numéro de la page
	$sujet_tag = $_GET[name];//_Sujets/$TAG
	//$touttag = explode("/", $sujet_tag);

	$ip_adresse = $_SERVER['REMOTE_ADDR'];

	$action = $_GET[action];
	$rep = $_POST[rep];
	$repertoire = "./files/$classe/_Copies/$nom";


	$sujet = $_GET[file];//Pour le professeur uniquement 01 fevrier 2017
	include("./quest_dyn.php");//Questions Dynamiques le 9 octobre 2017


	include("./DS_Securite.php");
	$DS_password = DSMDP($classe, $nom);
	$copie_password = $_COOKIE['code4'];
	$repertoire_rep = "./files/$classe/_Copies/$nom/rep/$copie_password";
	$repertoire_rep1 = "./files/$classe/_Copies/$nom/rep";
	$filename = "$repertoire/rep/index.htm";



?>

<script>
	function MDP1semaine(code) {
		var date = new Date(Date.now() + 86400000*7);//86400000 = 1 jour

		document.cookie = "code4="+code+"; expires="+date.toUTCString();
	}

	function ecritMDP() {
		code = prompt('Donner le code','');
		MDP1semaine(code);
		location.reload() ;
	}

	function premier(code) {
		if(code>999) alert("Copier le mot de passe document : " + code);
		MDP1semaine(code);
	}
</script>

<?php
  $prof_login = strpos($sujet,"Sujet"); //C'est le prof qui corrige le sujet
	if($prof_login) {
		$repertoire = "$sujet";
		$repertoire_rep = "$sujet/rep212";//pour éviter la fraude
		$_SESSION[sujet2DS]=$sujet;
		$nomdufichier = "$sujet/index.htm";
		if(file_exists($nomdufichier)) {
			$fp = fopen($nomdufichier, "r");
			$ligne1 = fgets($fp);
			$part = explode("#", $ligne1);
			fclose($fp);
		}
		$nom = "Correction";
		$filename = $nomdufichier;
	}

	function sujet_ouvert($sujet,$repertoire_rep,$passwordOK){
		$Message = "";
		if(!file_exists($sujet)) $Message .= "Pas de sujet $sujet.<br>";
		if(file_exists(str_replace("index.htm", "off.txt", $sujet)))  $Message .= "Sujet fermé.<br>";
		if(!$passwordOK) $Message .= "Mauvais mot de passe de candidat.<br>";
		//Si Message alors y'a un problème
		return $Message;
	}


	function trouve_image($nom,$rep){
		$drap = false;
		$files = scandir($rep);
		foreach($files as $txt) {
			$part = explode(".", $txt);
			if($part[0]==$nom) $drap = $txt;
		}
		return $drap;
	}

	function trouve_texte($nom,$repertoire_rep){
		$texte = "???";
		$filename = "$repertoire_rep/$nom.txt";
		if(file_exists($filename)) {
			$fp = fopen("$filename", "r");
			$texte = fgets($fp);
			fclose($fp);
		}
		return $texte;
	}

	function trouve_texte_long($nom,$repertoire_rep){
		$texte = "???";
		$filename = "$repertoire_rep/$nom.txt";
		if(file_exists($filename)) {
			$fp = fopen("$filename", "r");
			$texte = fgets($fp);
			while(!feof($fp)){
				$ligne = fgets($fp);
				if(strlen($ligne)>2) $texte .= "$ligne";//pour éliminer les trop nombreux saut de ligne
			}
			fclose($fp);
		}
		return $texte;
	}

	function trouve_programe($nom,$rep){
		$drap = false;
		$files = scandir($rep);
		foreach($files as $txt) {
			$part = explode(".", $txt);
			if($part[0]==$nom) $drap = $txt;
		}
		return $drap;
	}

	function question($nom,$page,$image_source){
		$link = "./devoir.php?action=1&page=$page";
		$sujet2DS = $_SESSION[sujet2DS];
		if($sujet2DS) {
			$link = "./devoir.php?action=1&file=$sujet2DS&page=$page";
		}
		echo("<table><tr><td>");
		if($image_source) echo("<a href=\"$image_source\">Image originale</a></td><td>");//
		echo("\n<form enctype=\"multipart/form-data\" method=\"post\" action=\"$link\">\n");
		echo("<input name=\"fichier\" type=\"file\">");
		echo("<input name=\"rep\" type=\"hidden\" value=\"$nom\">");
		echo("<input name=\"bouton\" value=\"Envoyer l'image jpg, gif ou png\" type=\"submit\">");
		echo("</form>");
		echo("</td></tr></table>");
	}

	function charge_programme($nom,$page){
		$link = "./devoir.php?action=2&page=$page";
		$sujet2DS = $_SESSION[sujet2DS];
		if($sujet2DS) {
			$link = "./devoir.php?action=2&file=$sujet2DS&page=$page";
		}
		echo("<table><tr><td>");
		echo("<form enctype=\"multipart/form-data\" method=\"post\" action=\"$link\">");
		echo("<input name=\"fichier\" type=\"file\">");
		echo("<input name=\"rep\" type=\"hidden\" value=\"$nom\">");
		echo("<input name=\"bouton\" value=\"Envoyer votre programme r&eacute;ponse\" type=\"submit\">");
		echo("</form>");
		echo("</td></tr></table>");
	}

	function extpat($filename){
		$part = explode(".", $filename);
		return($part[count($part)-1]);
	}

	function affiche_image($image,$size){
		//2 mars 2017
		$nosize = 0;
		if($size>700) $nosize = 1;
		$ext = explode(".", $image);
		if($ext[count($ext)-1]=="svg") $nosize = 1;

		if($nosize) $text = "<img src=\"$image\">";
		else $text = "<img src=\"$image\" width=\"$size px\">";
		echo("<table><tr><td><a href=\"$image\">$text</a></td></tr></table>");
	}

	function affiche_texte($texte,$name,$size,$page){
		$link = "./devoir.php?action=3&page=$page";
		$sujet2DS = $_SESSION[sujet2DS];
		if($sujet2DS) {
			$link = "./devoir.php?action=3&file=$sujet2DS&page=$page";
		}
		$text = "<form method=\"post\" action=\"$link\"><input type=\"text\" name=\"reponse\" value=\"$texte\" size=\"$size\"/>";
		$text .= "<input type=\"hidden\" name=\"question\" value=\"$name\"/>";
		$text .= "</td><td><input type=\"submit\" value=\"R&eacute;pondre\"></form>";
		echo("<table><tr><td>$text</td></tr></table>");
	}

	function affiche_long_texte($texte,$name,$size,$page){
		$link = "./devoir.php?action=3&page=$page";
		$sujet2DS = $_SESSION[sujet2DS];
		if($sujet2DS) {
			$link = "./devoir.php?action=3&file=$sujet2DS&page=$page";
		}
		$text = "<form method=\"post\" action=\"$link\">";
		$text .= "<textarea name=\"reponse\" cols=\"$size\" rows=\"5\">$texte</textarea>";
		$text .= "<input type=\"hidden\" name=\"question\" value=\"$name\"/>";
		$text .= "</td><td><input type=\"submit\" value=\"R&eacute;pondre\"></form>";
		echo("<table><tr><td>$text</td></tr></table>");
	}

	function affiche_programme($prg){
		$text = "<img src=\"./icon/codesys.png\">";
		echo("<table><tr><td><a href=\"$prg\">$text</a></td></tr></table>");
	}

	function chemin_relatif($bout2texte){
		$bout2texte = str_replace("http://gatt.fr/Gestion/", "./", $bout2texte);
		return $bout2texte;
	}

    //--------------------------------------------------------------------------------------       FIN DES FONCTIONS

	if($action>0){
		$fileonoff = "./files/$classe/_Copies/$nom/rep/off.txt";
		if(file_exists($fileonoff)) {
			$action = 0;
			$Message = "-- FIN de session --";
		}
	}


	if($action==1){//Enregistre la réponse image
		if(empty($_FILES["fichier"]["name"])) $Message = "Vous n'avez pas choisi d'image !!";
		else {
			$nomFichier = $_FILES["fichier"]["name"];
			$nomTemporaire = $_FILES["fichier"]["tmp_name"];
			$typeFichier = $_FILES["fichier"]["type"];
			$poidsFichier = $_FILES["fichier"]["size"];
			$codeErreur = $_FILES["fichier"]["error"];

			$ext = extpat($nomFichier);//extension du fichier - ma fonction
			if(est_image($nomFichier)) {
				$cible = "$repertoire_rep/$rep.$ext";
				if(copy($nomTemporaire, $cible)){
					$Message = "--> Votre image $nomFichier est sauvegard&eacute;e" ;
					chmod($cible,0777);
				}
				//Sauvegarde du nom du fichier avec l'extension - 16 janvier 2016
				$filename_reponse_text = "$repertoire_rep/$rep.txt";
				$fp = fopen($filename_reponse_text, "w");
				fwrite($fp, "$rep.$ext\n");
				fclose($fp);
			}
			else $Message = "--> Mauvais format de fichier !!" ;
		}
	}

	if($action==2){//Enregistre la réponse programme
		if(empty($_FILES["fichier"]["name"])) $Message = "Vous n'avez pas choisi de programme !!";
		else {
			$nomFichier = $_FILES["fichier"]["name"];
			$nomTemporaire = $_FILES["fichier"]["tmp_name"];
			$typeFichier = $_FILES["fichier"]["type"];
			$poidsFichier = $_FILES["fichier"]["size"];
			$codeErreur = $_FILES["fichier"]["error"];

			$ext = extpat($nomFichier);//extension du fichier - ma fonction
			$cible = "$repertoire_rep/$rep.$ext";//le 27 novembre 2017
			if($ext="pro"){
				if(copy($nomTemporaire, $cible)){
					$Message = "--> Votre programme $nomFichier est sauvegard&eacute;" ;
					chmod($cible,0777);
				}
			}
		}
	}

	if($action==3){//Enregistre la réponse texte
		$question = $_POST[question];
		$reponse = $_POST[reponse];
		$filename_reponse_text = "$repertoire_rep/$question.txt";
		$fp = fopen($filename_reponse_text, "w");
		fwrite($fp, "$reponse\n");
		fclose($fp);
		$Message = "--> Votre réponse '$reponse' est sauvegard&eacute;e" ;
	}

	if(!file_exists($repertoire_rep)) mkdir($repertoire_rep, 0777);//-------------------------------------------         Création du répertoire réponse si non existant

	//Gestion des sessions
	$date_ext = date("i/G/d/m");
	$sessions_file_name = "$repertoire_rep1/sessions.txt";
	if(!file_exists($sessions_file_name)) {
		echo("<script>premier(\"$DS_password\");</script>");
		$session_fp = fopen($sessions_file_name, "w");
		fwrite($session_fp, "$numero2session:$date_ext:$ip_adresse:");
		fclose($session_fp);
		$copie_password = $DS_password;
	}
	else {
		$session_fp = fopen($sessions_file_name, "r");
		$flag = false;
		while(!feof($session_fp)){
			$ligne_first = explode(":", fgets($session_fp));
			if($ligne_first[0]=="$numero2session") $flag = true;
		}
		fclose($session_fp);
		if(!$flag){//Nouveau numéro de session
			$session_fp = fopen($sessions_file_name, "a");
			fwrite($session_fp, "\n$numero2session:$date_ext:$ip_adresse");
			fclose($session_fp);
		}
	}
	$infos_file_name = "$repertoire_rep1/infos.txt";
	$infos_fp = fopen($infos_file_name, "w");
	$info_time = time();
	fwrite($infos_fp, "$info_time");
	fclose($infos_fp);

	//----------------------------------------------------------------------------         BULLE JAUNE
	if(file_exists($filename)) {
		$script_name = $_SERVER['SCRIPT_NAME'];
		$part3 = explode("/", $script_name);
		$script_name = $part3[count($part3)-1];
		//$script_name .= "&name=$sujet_tag";
		$script_name .= "?file=$sujet";

		$fp_2020 = fopen($filename, "r");
		$pagei = 1;
		$walli = 0;
		while(!feof($fp_2020)){
			$ligne = fgets($fp_2020);
			$part = explode("#", $ligne);
			if($part[0]=="Q") {
				$numerodepage[$walli]=$pagei;
				$walli++;
			}
			if($part[0]=="L") $pagei++;
		}
		for($wall=0;$wall<$walli;$wall++) {
			$numerodelaquestion = $wall+1;
			$bulle[$wall]="<a href=\"$script_name&page=$numerodepage[$wall]#Q$numerodelaquestion\" title=\"Q$numerodelaquestion\"><font color=\"black\">$non_fait</font></a>";//Par défaut les questions n'ont pas de réponse
		}

		//Liste des réponses
		$liste_fichier = scandir($repertoire_rep);
		foreach($liste_fichier as $reponse) {
			if(strpos("_$reponse", "I")) {
				$part1 = explode("I", $reponse);
				$part2 = explode(".", $part1[1]);
				//$bulle[$part2[0]-1]=$fait;
				$bulle[$part2[0]-1] = str_replace($non_fait, $fait, $bulle[$part2[0]-1]);
			}
		}

		//On construit les bulles
		for($wall=0;$wall<$walli;$wall++) {
			$le_bon_message .= $bulle[$wall];
			$wall2++;
			if($wall2==10) {
				$le_bon_message .= "<br>";
				$wall2 = 0;
			}
		}
		fclose($fp_2020);
	}

	$TAG = TAGdufichier($filename);//Récupération du TAG
	$titredudocument = "$TAG $nom";

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="print.css" media="print">
		<title><?php echo($titredudocument);?></title>
		<meta name="Description" content="<?php echo($numero2session);?>">
	</head>
	<body>
		<center>
		<table>
			<tr><td width="52px"></td><td><font size="+5"><?php echo($titredudocument);?></font></td>
			<td width="52px"><a href="../tui.image-editor/editor/" target="_blank">
			<img src="icon/image_editor.png" width="50px" title="Editeur d'image"\></a></td></tr></table>

<?php
	//Dans le fichier sujet.txt qui est dans le répertoire de l'élève
	//La première ligne est le titre
	//Code Q = Question
	//Code I = Image réponse - Mettre l'adresse de l'image par défaut si nécéssaire
	//Code C = Commentaires
	//Code P = Programme à rendre
	//Code T = Réponse texte sur une ligne
	//Code U = Réponse texte sur plusieurs lignes
	//Code D = Question dynamique !!
	//Code L = Saut de page
	//Code H ??

    echo("<!-- script_name $script_name -->");
    echo("<!-- filename $filename  -->");
    echo("<!-- repertoire_rep $repertoire_rep  -->");

$_SESSION[sujet2DS] = $filename;
if($DS_password == $copie_password) {
	echo("<p><font color=\"#0000FF\">$Message</font></p>");

	if(sujet_ouvert($filename,$repertoire_rep,$password_OK)) echo(sujet_ouvert($filename,$repertoire_rep,$password_OK));
	else {
		$fp = fopen($filename, "r");
		$titre = fgets($fp);
		$code_rep = explode("#", $titre);
		echo("<table><tr><td><h1>$code_rep[0]</h1></td><td><div class=\"bulles\">$le_bon_message</div></td></tr></table>");
		$i=0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$part[1] = chemin_relatif($part[1]);

			if($pagenumber){
				$affiche = 0;
				if($nb2pages+1==$pagenumber) $affiche = 1;
			}else {
				$affiche = 1;
				$pagenumber = 1;
			}


			if($affiche){
				if($part[0]=="Q") {//Code Q = Question
					$i++;
					$bareme = "";
					if($part[2]) $bareme = "</td><td class=\"pt\">$part[2]";
					echo("<table id=\"Q$i\"><tr><td align=\"left\">\n<font color=\"#0000FF\">Q$i :</font> $part[1] $bareme</td></tr></table>");
				}


				if($part[0]=="D") {//Code D = Question dynamique !! le 9 octobre 2017
					$i++;
					$bareme = "";
					if($part[2]) $bareme = "</td><td class=\"pt\">$part[2]";

					if($part[1]=="BCD") $laquest = BCDQ("$repertoire_rep",$i);
					if($part[1]=="DCB") $laquest = DCBQ("$repertoire_rep",$i);
					if($part[1]=="Float") $laquest = float_2017("$repertoire_rep",$i);
					if($part[1]=="Decimal") $laquest = decimal_2017("$repertoire_rep",$i);
					if($part[1]=="Integer") $laquest = int_2017("$repertoire_rep",$i);
					if($part[1]=="CC2") $laquest = cc2_2017("$repertoire_rep",$i);
					if($part[1]=="HEXINT") $laquest = entier_2017("$repertoire_rep",$i);
					if($part[1]=="INTHEX") $laquest = hexa_2017("$repertoire_rep",$i);

					echo("<table><tr><td align=\"left\">\n<font color=\"#0000FF\">Q$i : </font> $laquest $bareme</td></tr></table>");
				}


				if($part[0]=="C") {//Code C = Commentaires
					echo("<table><tr><td align=\"left\"><i>$part[1]</i></td></tr></table>");
				}
				if($part[0]=="H") {
					echo("<table><tr><td align=\"left\">$part[1]</td></tr></table>");
				}
				if($part[0]=="I") {//Code I = Image réponse - Mettre l'adresse de l'image par défaut si nécéssaire
					if(!file_exists("$repertoire_rep/I$i.txt")){// Pas de réponse
						$image_link = "./icon/interro.png";
						if(strpos("_$part[1]","./files/")) $image_link = "$part[1]";
						if(file_exists($image_link)) $dimensions = getimagesize($image_link);
						if($dimensions[0]>700) affiche_image($image_link,700);//Pour les petites images
						else affiche_image($image_link,$dimensions[0]);
						question("I$i",$nb2pages+1,"");
					}
					else {//Il existe une réponse
						$filetexte16 = fopen("$repertoire_rep/I$i.txt", "r");
						$image = fgets($filetexte16);
						$image_link = trim("$repertoire_rep/$image");//Pour enlever les espaces !!!
						$dimensions = getimagesize($image_link);
						if(($dimensions[0]>700) or ($dimensions[0]+1==1)) affiche_image($image_link,700);//Pour les petites images
						else affiche_image($image_link,$dimensions[0]);
						if(strpos("_$part[1]","./files/")) $image_source = "$part[1]"; else $image_source = "";
						question("I$i",$nb2pages+1,$image_source);
						fclose($filetexte16);
					}

				}
				if($part[0]=="P"){//Code P = Programme à rendre
					$programme = trouve_programe($part[1],$repertoire_rep);
					if(!$programme){
						echo("<table><tr><td><font color=\"#0000FF\">Votre programme répondant aux questions du $part[1]</font></td></tr></table>");
						affiche_image("./icon/interro.png",50);
						charge_programme($part[1],$nb2pages+1);
					}
					else {
						affiche_programme("$repertoire/$part[1].pro");
						charge_programme($part[1],$nb2pages+1);
					}
				}
				if($part[0]=="T") {// Code T = Réponse texte sur une ligne - le 12 janvier 2017
					$texte = trouve_texte("I$i",$repertoire_rep);
					affiche_texte($texte,"I$i",80,$nb2pages+1);
				}
				if($part[0]=="U") {// Code U = Réponse texte sur plusieurs lignes - le 18 février 2017
					$texte = trouve_texte_long("I$i",$repertoire_rep);
					affiche_long_texte($texte,"I$i",80,$nb2pages+1);
				}
			}
			else {
				if(($part[0]=="Q")||($part[0]=="D")) $i++;
			}

			if($part[0]=="L") {//Code L = Saut de page
				$nb2pages++;
				echo("<p></p>");
				echo("<div class=\"breakafter\"></div>\n");
			}
		}

	}

	echo("<table><tr>");
	for($i=0;$i<$nb2pages+1;$i++){
		$pagenumber2 = $i+1;
		$color = "";
		if($pagenumber2==$pagenumber) $color = "bgcolor=\"#ffffff\"";
		echo("<td $color><a href=\"./devoir.php?file=$sujet&page=$pagenumber2\">Page $pagenumber2</a></td>");
	}
	echo("</tr></table>");
}
else {
	echo("<p><font color=\"#ff0000\" size=\"+2\">Mauvais mot de passe de sujet.</font></p>");
	echo("<input type=\"button\" value=\"Cliquer pour donner le mot de passe\" onclick=\"ecritMDP()\">");
}


?>
		</center>
	</body>
</html>
