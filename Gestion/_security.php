<?php
	//Partie connexion sécurisé - V00
	session_start();
	$classe_dispo = explode(":", "CIRA1:CIRA2:TS1CIRA 2018");
	$repertoire = "./files/";
	echo("<!-- Partie sécurité -->\n");
	
	$action1 = $_POST['action']; 
	if($action1==1){
		echo("<!-- action $action1 -->\n");
		$elv = $_POST['nom'];
		$_SESSION['nom'] = $elv;
		$classe = $_POST['classe'];
		$_SESSION['laclasse'] = $classe;
		$password = $_POST['password'];
		$_SESSION['password'] = $password;
		$_SESSION['essai']++;
	} 
	else {
		$classe = $_SESSION['laclasse'];
		if($classe!=$classe_dispo[0]) {
			$_SESSION['laclasse'] = $classe_dispo[0];
			$classe = $classe_dispo[0];
		}
		$elv = $_SESSION['nom'];
		$password = $_SESSION['password'];
	}
	
	
	if($_COOKIE['laclasse']) {
		$_SESSION['laclasse'] = $_COOKIE['laclasse'];
		$classe = $_SESSION['laclasse'];
	}
	
	
	//MENU DEROULANT CLASSES        -----------------------------------------------------------------------------------------------------
	$select_classe = "<select name=\"classe\" id=\"classe\" onchange=\"login();\">";
	foreach($classe_dispo as $classe14){
		if($classe==$classe14) $select_classe .= "<option selected>$classe14</option>";
		else $select_classe .= "<option>$classe14</option>";

	}
	$select_classe .= "</select>";
	$submit = "<input type=\"submit\" value=\"Login\">\n";
	
	//MENU DEROULANT ELEVES        ------------------------------------------------------------------------------------------------------
	$select_elv = "<select name=\"nom\" id=\"nom\">\n";
	$fichieralire = "$repertoire$classe.txt";
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
	
	
	
	//CLEF MOT DE PASSE        -----------------------------------------------------------------------------------------------------------
	$password_OK = $bon_password==$password;
	if(!$bon_password) $password_OK = 0;
	
	if($password_OK){
		$password_in = "<input type=\"hidden\" name=\"password\" value=\"##\">";
		$submit = "<input type=\"submit\" value=\"Logout\">\n";
		$select_classe = "<font color=\"yellow\" size=\"+2\">$elv</font><input type=\"hidden\" name=\"classe\" value=\"$classe\">";
		$select_elv = "<input type=\"hidden\" name=\"nom\" value=\"$elv\">";
	}
	
	
	
	$invite = "<form action=\"./index7.php\" method=\"post\"><input type=\"hidden\" value=\"1\" name=\"action\">\n";
	$invite .= "<table><tr><td align=\"left\">$select_classe $select_elv $password_in</td><td align=\"right\">$submit</td></tr></table>";
	$invite .= "</form>";
	//echo("<!-- infos : $classe $elv $password/$bon_password -->\n");
	
	
	//FICHIER LOG        -----------------------------------------------------------------------------------------------------------
	if($action1==1){
		$session_nb = session_id();
		$nbDssaies = $_SESSION['essai'];
		if($password_OK) $info_pwd = "Bon MdP";
		else $info_pwd = $password;
		$date_heure = date("d/m/y G:i");
		$logfilename = $repertoire."$classe/_logindeseleves.txt";
		$fp = fopen($logfilename, "a");
		fwrite($fp, "\n<td>$elv [$nbDssaies]</td><td>$info_pwd</td><td>$date_heure</td>");
		fclose($fp);
	}
	
	
	echo("<!-- FIN securité-->\n");
?>