<?php
	$nom = $_GET[nom];
	$nom_doc = $nom;
	$titre_page = "$nom";
	include("./haut.php");
	$fichierdesnoms = "./files/$classe.txt";
	
	$repertoireClasse= "./files/$classe/_Copies";
	if(!file_exists($repertoireClasse)){
		mkdir($repertoireClasse);
		affiche("Répertoire $repertoireClasse créé");
	}
	
	$repertoire2eleve = "./files/$classe/_Copies/$nom";
	if(!file_exists($repertoire2eleve)){
		//verifie que le nom est bien dans la classe 02-2019
		$fp2019 = fopen($fichierdesnoms, "r");
		while(!feof($fp2019)){
			$ligne = fgets($fp2019);
			$content = explode(":", $ligne);
			$listeptnom .= ":$content[0]";
		}
		fclose($fp2019);
		$present = strpos($listeptnom, $nom);
		if($present) {
			mkdir($repertoire2eleve);
			affiche("Répertoire $repertoire2eleve créé");
			mkdir("$repertoire2eleve/rep");			
		} 
		else {
			affiche("Répertoire $repertoire2eleve non créé");
		}

	}

function precedent_suivant($liste2nom,$nom){
	$names[0]="----";
	$names[1]="----";
	for($i=0;$i<count($liste2nom);$i++){
		if($nom==$liste2nom[$i]){
			if($i>0) $names[0]=$liste2nom[$i-1];
			if($i<count($liste2nom)-1) $names[1]=$liste2nom[$i+1];
		}
	}
	return $names;
}

//____________________________________________________________

	$tabsynth2 = "./geo.php?nomfichier=./files/$classe/_Semestre%202.txt";
	$tabsynth1 = "./geo.php?nomfichier=./files/$classe/_Semestre%201.txt";
	
	tableau("$accueil$classe</a> - <a href=\"$tabsynth1\">Semestre 1</a> - <a href=\"$tabsynth2\">Semestre 2</a>");	
	if($_GET[modif]==1){
		affiche("Fichier modifié");
		$nom = $_POST[nom];
		$handle = fopen($fichierdesnoms, "a");
		fprintf($handle, "\n$_POST[nom]:$_POST[Prenom]:$_POST[nez]:$_POST[Mot]:");
		fprintf($handle, "$_POST[Tel]:$_POST[Mail]:$_POST[Bac]:$_POST[Remarque]:");
		fprintf($handle, "$_POST[demission]:$_POST[Sem1]:$_POST[Sem2]:$_POST[Marine]:");
		fprintf($handle, "$_POST[BTS]:$_POST[Lycee]");
		fclose($handle);
	}
	
	
	if($_GET[modif]==2){
		$nom = $_POST[nom];
		$repertoire2eleve .= $nom."/";
		$chemin = $repertoire2eleve;
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
	
			if(copy($nomTemporaire, $chemin.$nomFichier)){
				$message_load = "$nomFichier sauvegard&eacute; dans $repertoire2eleve" ;
				chmod("$chemin$nomFichier",0777);
			}
			else $message_load = "La sauvegarde a &eacute;chou&eacute; !!" ;
		}
		else $message_load = "Vous n'avez pas choisi de fichier !!";
		
		affiche($message_load);
	}
	
	
	$laphoto = photobord($nom,"#fff");
	//Ouverture du fichier elèves
	$fp = fopen($fichierdesnoms, "r");
	if($fp){
		while(!feof($fp)){
			$ligne = fgets($fp);
			$nomlu = explode(":", $ligne);
			if($nomlu[0]==$nom){
				$prenom = $nomlu[1];
				$naissance = $nomlu[2];
				$passe = $nomlu[3];
				$tel = $nomlu[4];
				$mail = $nomlu[5];
				$origine = $nomlu[6];
				$remarque = $nomlu[7];
				$demission = $nomlu[8];
				$sem1 = $nomlu[9];
				$sem2 = $nomlu[10];
				$marine = $nomlu[11]; //if($marine="") $marine = "Non";
				$bts = $nomlu[12];
				$lycee = $nomlu[13];//lycée d'origine le 19/05/2019
			}
		}
	}else echo("Le fichier n'existe pas");
?>


<form method="post" action="./eleve.php?modif=1">
<?php
	//Fiche de l'élève
	echo("<table>");
	echo("<tr><td>$laphoto<br/></td>");
	$champs = champs("nom",$nom);
	echo("<td align=\"left\">[0] Nom : $champs<br/>");
	$champs = champs("Prenom",$prenom);
	echo("\n[1] Prenom : $champs<br/>");
	$champs = champs("nez",$naissance);
	echo("\n[2] N&eacute;(e) le : $champs<br/>");
	$champs = champs("Mot",$passe);
	echo("\n[3] Mot de passe : $champs<br/>");
	$champs = champs("Tel",$tel);
	echo("\n[4] Tel. : $champs<br/>");
	$champs = champs("Mail",$mail);
	if(file_exists("./Candidatures/$nom.pdf"))
		echo("\n[5] <a href=\"mailto:$mail\">Mail</a> : $champs<br/><a href=\"./Candidatures/$nom.pdf\">[X]</a> Fiche Parcoursup</td><td align=\"left\">");
	else 
		echo("\n[5] <a href=\"mailto:$mail\">Mail</a> : $champs<br/></td><td align=\"left\">");
	$champs = champs("Bac",$origine);
	echo("\n[6] Bac : $champs<br/>");
	
	$champs = champs("Lycee",$lycee);
	echo("\n[13] Lyc&eacute;e : $champs<br/>");	
	
	$champs = champs("Remarque",$remarque);	
	echo("\n[7] RQ [rang] : $champs<br/>");
	$champs = "<select name=\"demission\">";
	if($demission=="oui") $oui = "selected"; else $non = "selected";
	$champs .= "<option value=\"non\" $non>Non</option>";
	$champs .= "<option value=\"oui\" $oui>Oui</option>";
	$champs .= "</select>";
	echo("\n[8] Demission : $champs<br/>");
	$champs = champs("Sem1",$sem1);
	//echo("[9] Avis semestre 1<br/>");
	$champs = champs("Sem2",$sem2);
	//echo("[10] Avis semestre 2<br/>");
	
	$champs = "<select name=\"Marine\">";
	if($marine=="oui") $oui = "selected"; else $non = "selected";
	$champs .= "<option value=\"non\" $non>Non</option>";
	$champs .= "<option value=\"oui\" $oui>Oui</option>";
	$champs .= "</select>";
	echo("\n[11] Marine : $champs<br/>");
	
	$champs_BTS = "<select name=\"BTS\">";
	$oui = ""; $non = "";
	if($bts=="OUI") $oui = "selected"; 
	else $non = "selected";
	$champs_BTS .= "<option value=\"NON\" $non>Non</option>";
	$champs_BTS .= "<option value=\"OUI\" $oui>Oui</option>";
	$champs_BTS .= "</select>";	
	echo("\n[12] BTS : $champs_BTS<br/>");

	echo("<br/><input type=\"submit\" value=\"Modifier\">");
	echo("</td></tr></table>");
	
	//Suivant et précédent
	$PS = precedent_suivant($leleve,$nom);	
	tableau("<a href=\"./eleve.php?nom=$PS[0]\">$PS[0]</a></td><td width=\"50%\"><a href=\"./eleve.php?nom=$PS[1]\">$PS[1]</a>");
	
	echo("<table>");
	echo("<tr><td>\n[9] :<input type=\"text\" name=\"Sem1\" value=\"$sem1\" size=\"100\"></td></tr>");
	echo("<tr><td>\n[10] :<input type=\"text\" name=\"Sem2\" value=\"$sem2\" size=\"100\"></td></tr>");
	echo("</table>");
?>
</form>
<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="./eleve.php?modif=2">
<tr><td><input name="fichier_choisi" type="file"><input type="hidden" name="nom" value="<?php echo($nom);?>"></td>
<td><input name="bouton" value="Envoyer le fichier" type="submit"></td></tr>
</form></table>

<?php 
	include("./eleve4all.php");
?>

<?php include("./bas.php");?>