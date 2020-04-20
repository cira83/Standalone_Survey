<?php include("./haut.php");?>

<?php //LES FONCTIONS SPECIFIQUES
	
	function numero_mois($number){ //Retourne le rang du mois dans l'année
		if($number>8) $num = $number-9;
		else $num = $number+3;
		
		return $num;
	}

	function numero_semaine($number29,$mois){//Retourne le rang de la semaine dans le mois
		$num = -1;//Dernier semaine du mois précédent
		$number = intval($number29);
		for($i=1;$i<count($mois);$i++){
			if($number>=$mois[$i]){
				$num = $i;
			}
		}
		return $num;
	}
	
	$couleur = "yellow";
	
	function menu_deroulant_calendrier($liste,$nom,$selected){ //Crée un menu deroulant avec la liste $liste et de nom $nom
		$lemenu = "<SELECT name=\"$nom\">";
		$lemenu .= "<OPTION>----</OPTION>";
		for($i=0;$i<count($liste);$i++){
			$drap = true;
			if($selected==$liste[$i]) {
				$lemenu .= "<OPTION selected>$liste[$i]</OPTION>";
				$drap = false;
			}else $lemenu .= "<OPTION>$liste[$i]</OPTION>";
		}
		$lemenu .= "</SELECT>";
		return $lemenu;
	}
	
	function mois_en_nombre($str){
		$nb = "07";
		$mois = strtolower($str);
		if($mois=="septembre") $nb = "09";
		if($mois=="octobre") $nb = "10";
		if($mois=="novembre") $nb = "11";
		if($mois=="decembre") $nb = "12";
		if($mois=="janvier") $nb = "01";
		if($mois=="fevrier") $nb = "02";
		if($mois=="mars") $nb = "03";
		if($mois=="avril") $nb = "04";		
		if($mois=="mai") $nb = "05";
		if($mois=="juin") $nb = "06";
		
		return $nb;
	}

	//DECLARATION DES FICHIERS - NE PAS MODIFIER
	$progression_file = "./files/$classe/_progression.txt";
	$calendrier_file = "./files/_annee.txt"; 
	
	if(!file_exists("$progression_file")) {
		$fp = fopen("$progression_file", "w");
		fclose($fp);
		echo("<p>Creation du fichier de progression [$progression_file]</p>");
	}
	
	//On ouvre le calendrier de l'année
	if(!file_exists("$calendrier_file")) echo("<p>Il manque le calendrier [$calendrier_file] !!</p>");
	$fp = fopen("$calendrier_file","r");//L'année par date
	$i=0;
	while(!feof($fp)){
		$ligne[$i]=fgets($fp);
		$i++;
	}
	fclose($fp);
	for($i=0;$i<count($ligne);$i++)	{
		$case[$i] = explode(":", $ligne[$i]);
		$lesmois[$i]=$case[$i][0];
	}


	//Ajout d'une date dans le calendrier
	if($_GET[action]==1){
		$drap_action1 = true;
		$mois1 = numero_mois(mois_en_nombre($_POST[mois1]));
		$mois2 = numero_mois(mois_en_nombre($_POST[mois2])); 
		$jour1 = $_POST[jour1];
		$jour2 = $_POST[jour2];
		if($_POST[mois2]=="----") {
			$mois2 = $mois1;
			$jour2 = $jour1;
		}
		if($mois1>$mois2) $drap_action1 = false;
		if($mois1<10) $mois1="0$mois1";
		if($mois2<10) $mois2="0$mois2";
		if($jour1<10) $jour1="0$jour1";
		if($jour2<10) $jour2="0$jour2";
		if($drap_action1){
			$activite = $_POST[activite];
			$ligne_action1 = "$mois1:$jour1:$mois2:$jour2:$activite"; //echo("<p>$ligne_action1</p>");
			$fp = fopen($progression_file, "a");
			fwrite($fp, "$ligne_action1\n");
			fclose($fp);
		}
		
	}




	
	//Aujourd'hui, en jaune
	$mois = numero_mois(date(m)); 
	$jour = numero_semaine(date(d),$case[$mois]);
	
	
	echo("<table class=\"C100\">");
	//Première ligne - Les mois
	echo("<tr><td class=\"C100\">Mois</td>");
	for($i=0;$i<count($ligne);$i++) {
		$nbb = count($case[$i])-1;
		echo("<td colspan=$nbb class=\"C100\">".$case[$i][0]."</td>");
	}
	echo("</tr>");
	//Deuxième ligne - Les lundis
	echo("<tr><td class=\"C100\">Sem.</td>");
	for($i=0;$i<count($ligne);$i++) {
		for($j=1;$j<count($case[$i]);$j++){
			if(($mois==$i)&&($jour==$j)) echo("<td bgcolor=\"$couleur\" class=\"C100\">".$case[$i][$j]."</td>");
			else echo("<td class=\"C100\">".$case[$i][$j]."</td>");
		}
	}
	echo("</tr>");
	
	
	//Ouverture du fichier
	$fp = fopen($progression_file, "r");
	$i=0;
	while(!feof($fp)){
		$laligne = fgets($fp);
		if(!feof($fp)) $prog[$i]=$laligne;
		$i++;
	}
	$nb_ligne = $i - 1;
	sort($prog);
	fclose($fp);
	//fin de l'ouverture et classement
	
	$cls = 0;
	$color2[0] = "#00FFFF";
	$color2[1] = "#9EFD38";
	for($k=0;$k<$nb_ligne;$k++){
		$cls = 1-$cls;
		$color = $color2[$cls];
		$case_color = "<td class=\"C100\"></td>";
		$data26 = explode(":", $prog[$k]);
		$mois1 = $data26[0];
		$jour1 = numero_semaine($data26[1],$case[intval($mois1)]); 
		if($jour1==-1) {
			$mois1 = $mois1-1;
			$jour1 = count($case[intval($mois1)])-1;
		}
		$mois2 = $data26[2];
		$jour2 = numero_semaine($data26[3],$case[intval($mois2)]);
		if($jour2==-1) {
			$mois2 = $mois2-1;
			$jour2 = count($case[intval($mois2)])-1;
		}	
			
		echo("<tr><td bgcolor=\"$color\" class=\"C100\"><font size=\"-2\">$data26[4]</font></td>");
		for($i=0;$i<count($ligne);$i++) {
			for($j=1;$j<count($case[$i]);$j++){
				if(($mois1==$i)&&($jour1==$j)) $case_color = "<td bgcolor=\"$color\" class=\"C100\"></td>";
				echo("$case_color");
				if(($mois2==$i)&&($jour2==$j)) $case_color = "<td class=\"C100\"></td>";
			}
		}
	}

	

	
	echo("</table>");
	
?>

<?php	
	echo("<table><form method=\"POST\" action=\"./calendrier.php?action=1\"><tr>");
	echo("<td><input type=\"text\" name=\"activite\"></td>");
	$menu_mois1 = menu_deroulant_calendrier($lesmois,"mois1");
	echo("<td><input type=\"text\" name=\"jour1\" size=\"4\">$menu_mois1</td>");
	$menu_mois2 = menu_deroulant_calendrier($lesmois,"mois2");
	echo("<td><input type=\"text\" name=\"jour2\" size=\"4\">$menu_mois2</td>");
	echo("<td><input type=\"submit\">");
	echo("</tr></form></table>");
?>



<?php include("./bas.php");?>