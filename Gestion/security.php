<?php
	include("./_Clef_Prof.php");
	$elv = isset($_COOKIE['nom']) ? $_COOKIE['nom'] : "";
	$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : "";
	$classe = isset($_COOKIE['laclasse'])?$_COOKIE['laclasse']:"";
	
	function est2dossier($nom){//###
		$data = explode(".", $nom);
		return(!isset($data[1]));
	}	
	
	function estfichier2($nom){// Fichier ou non ?
		$drap = true;
		$data = explode(".", $nom);
		if($data[0]=="") $drap = false;
		if($nom[0]=="_") $drap = false;
		if($nom=="index.htm") $drap = false; //Nom du fichier questionnaire
		if($nom=="rep") $drap = false; //Nom du répertoire des réponse au questionnaire

		return($drap);
	}

	function les_classes(){
		$repertoire = "./files";
		$classes = scandir($repertoire);
		sort($classes);
		$i=0;
		foreach($classes as $classe) {
			if(est2dossier($classe)){
				if($i) $classe_text .= ":$classe";
				else $classe_text = "$classe";
				$i++;
			}
		}
		return $classe_text;
	}

	//Partie connexion sécurisé - V01 2020
	$classe_text = les_classes();
	$classe_dispo = explode(":", $classe_text);
	$repertoire = "./files/";

	//MENU DEROULANT CLASSES        -----------------------------------------------------------------------------------------------------
	$select_classe = "<select name=\"classe\" id=\"classe\" onchange=\"login();\">";
	$select_classe .= "<option>Selectionner votre classe</option>";
	foreach($classe_dispo as $classe14){
		if($classe==$classe14) $select_classe .= "<option selected>$classe14</option>";
		else $select_classe .= "<option>$classe14</option>";

	}
	$select_classe .= "</select>";
	$submit = "<input type=\"submit\" value=\"Login\">\n";

	//MENU DEROULANT ELEVES        ------------------------------------------------------------------------------------------------------
	$select_elv = "<select name=\"nom\" id=\"nom\">\n";
	$fichieralire = "$repertoire$classe/_Profils.txt";
	$bon_password = "";
	if(file_exists($fichieralire)){
		$fp = fopen($fichieralire, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode(":", $ligne);
			if($part[0]==$elv) {
				$select_elv .= "<option selected>$part[0]</option>\n";
				$bon_password = $part[3];
			}
			else $select_elv .= "<option>$part[0]</option>\n";
		}
		fclose($fp);
	}
	$select_elv .= "</select>";

	$password_in = "<input type=\"password\" name=\"password\">";



	//CLEF MOT DE PASSE        ----------------------------------------------------------------------------------------------------------
	$password_OK = $bon_password==$password;
	if(!$bon_password) $password_OK = 0;

	//LOGIN DU PROF
	$prof_login = 0;
	if($password==$prof_password){
		$password_OK = 1;
		$prof_login = 1;
	}
	$passwordOK = $password_OK;




	// invite logout
	$submit = "<input type=\"submit\" value=\"Logout\" onclick=\"logout();\" >\n";
	$select_classe = "<font color=\"yellow\" size=\"+2\">$elv</font>";
	$invite = "<table><tr><td align=\"center\">$select_classe</td><td align=\"right\">$submit</td></tr></table>";

	//FICHIER LOG        -----------------------------------------------------------------------------------------------------------
	$session_nb = session_id();
	$nbDssaies = isset($_SESSION['essai']) ? $_SESSION['essai'] : NULL;
	$ip_client = $_SERVER['REMOTE_ADDR'];
	if($password_OK) $info_pwd = "Bon MdP";
	else $info_pwd = $password;
	$date_heure = date("d/m/y G:i");
	$write = "MaJ";
	
	if(!$password_OK) stop();
?>
