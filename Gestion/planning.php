<?php 
	$action = isset($_GET['action']) ? $_GET['action'] : "";	
	include("./haut.php");
	
	if($action=="1911"){
		affiche("Action 1911");
		$action = 3;
	}
	
	
	if($action==19){
		affiche("Action 19");
		$file19 = $_GET[file];
		$nom19 = $_GET[nom];
		echo("<!-- Ajout de :$nom19: dans $file19 -->");
		
		if(file_exists($file19)) {
			$fp19 = fopen($file19,"a");
			fprintf($fp19, "\n$nom19::1:");
			fclose($fp19);
		}
		$action = 3;
	}
	
	// Création Repertoire _Plannings  
	$lerepertoire =  "./files/$classe/_Plannings";
	if(!file_exists($lerepertoire)){
		 echo("<p>Création du repertoire des Plannings</p>");
		 mkdir($lerepertoire, 0777);
	}
	
	//$deroulant2 : liste des epreuves name=epr
	
	function tp_actif($classe) {
		$filename = "./files/$classe/_Sujets2TP/liste.txt";
		echo("<!-- TP list file : $filename -->");
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$i = 0;
			while(!feof($fp)) {
				$ligne = fgets($fp);
				$part = explode(",", $ligne);
				if($part[0][0]!="[") {
					$listeTPactifs[$i] = $part[0];
					$i++;
				}
			}
			fclose($fp);
		}
		else $listeTPactifs[0] = "No active TP";
			
		return $listeTPactifs;	
	}
	
	$tp_actif = menu_deroulant(tp_actif($classe),"epr","??");
	

	function tab_activite($classe,$ladate,$lepreuve1){
		for($l=0;$l<count($lepreuve1);$l++){
			$data1 = explode(".", $lepreuve1[$l]);
			$tableaudesepreuves[$l] = $data1[0]; 
		}
				
		$ladate=str_replace("/","_",$ladate);
		$filename = "./files/$classe/_Plannings/$ladate.txt"; //affiche("$filename");
		$filename2 = "./files/$classe/_Plannotes$ladate.txt";
		if(file_exists($filename)) {
			$fp = fopen($filename,"r");
			$i = 0;
			while (!feof($fp)){
				$ligne_planning[$i] = fgets($fp);
				$i++;
			}
			fclose($fp);
		}
		
		$tableau = "\n<form method=\"post\" action=\"./planning.php?action=4\">";
		$tableau .= "<table>";
		$ligne1 = 0;
		$liste_des_notes = "";
		for($i=0;$i<count($ligne_planning);$i++){
			$case = explode(":", $ligne_planning[$i]);
			$deroulant = menu_deroulant($tableaudesepreuves,"epr$i",$case[0]);
			//Verif 
			$deroulant = menu_deroulant(tp_actif($classe),"epr$i",$case[0]);

			//Recherche du fichier
			for($l=0;$l<count($lepreuve1);$l++){
				$data1 = explode(".", $lepreuve1[$l]);
				if($case[0]==$data1[0]) {
					$filename = "./files/$classe/$data1[2]/$case[0].txt"; 
					$lien = "./epreuve.php?mat=$data1[2]&epr=$case[0].txt";
					$lien2 = "./modif.php?mat=$data1[2]&epr=$case[0].txt&nom=$case[1]";
					$matiere10 = $data1[2];
				}
			}
			$lesparticipants11 = listedesparticipants($filename);
			$deroulant2 = menu_deroulant($lesparticipants11,"elv$i",$case[1]);
																			//11 septembre
			$repertoire_copies = "./files/$classe/_Copies";
			$lescopies = lescopies2($case[1],$classe,$case[0],$repertoire_copies);
			$lanoteobtenue = note2copie($case[1],$classe,$case[0],$matiere10,$ladate);//
			$photo = photobord($case[1],"#fff");
			if($lescopies) {
				$photo = photobord($case[1],"#090");//Si copie rendue
			}
			if($ligne1==0) $tableau .= "<tr>";
			$tableau .= "<td><a href=\"$lien\">$case[0]</a><br/>$deroulant<br/>";//Nom de l'epreuve
			$tableau .= "<a href=\"$lien2\">$case[1]</a><br/>$deroulant2<br/>";//Nom des participants
			$tableau .= "$lescopies<br/>$lanoteobtenue<br/>";//lien vers copie
			$linkmodif = "./modif.php?mat=$data1[2]&epr=$case[0].txt&nom=$case[1]";
			$tableau .= "<a href=\"$linkmodif\" title=\"Note\"><img src=\"./icon/note.png\" height=\"15px\" style=\"border:solid 4px #fff\"></a></td>";
			
			if($liste_des_notes) $liste_des_notes .= ":$lanoteobtenue";
			else $liste_des_notes = "$lanoteobtenue";
			
			$tableau .= "<td>$photo</td>";//Nom des participants
			$ligne1 = 1 - $ligne1;
			if($ligne1==0)$tableau .= "</tr>";
		}
		$ligne1 = 1 - $ligne1;
		if($ligne1==0)$tableau .= "<td></td><td></td><td></td></tr>";
		
		$tableau .= "</table>\n";
		$tableau .= "<input type=\"hidden\" name=\"nombre\" value=\"$i\">";
		$tableau .= "<input type=\"hidden\" name=\"classe\" value=\"$classe\">";
		$tableau .= "<input type=\"hidden\" name=\"ladate\" value=\"$ladate\" size=\"5\">";
		$ladate=str_replace("_","/",$ladate);
		$tableau .= "<input type=\"text\" name=\"nouvelledate\" value=\"$ladate\" size=\"5\">";
		$tableau .= "<input type=\"submit\" value=\"Valider les modifications\">";
		$tableau .= "<input type=\"reset\">";
		$tableau .= "</form>\n";
		
		
		if(file_exists($filename)) {
			$fp2 = fopen($filename2,"w");
			fprintf($fp2, $liste_des_notes);
			fclose($fp2);//fermeture des notes du plannings
		}
		
		return $tableau;
	}

	
	
	
	
	//FIN DES FONCTIONS ----------------------------------------------------------------
	$tableaudesTP = null;
	if($action==4){
		$classe = $_POST[classe];
		$ladate = $_POST[ladate];
		$lanouvelle = $_POST[nouvelledate];
		$nombre = $_POST[nombre];
		
		$lanouvelle=str_replace("/","_",$lanouvelle);
		$ladate=str_replace("/","_",$ladate);
		$filename = "./files/$classe/_Plannings/$lanouvelle.txt";
		$fp = fopen($filename, "w");
		
		
		if($lanouvelle==$ladate){
			$i = 0;
			$premiereligne = true;
			while(($i<$nombre)&&($premiereligne)){//PREMIERE LIGNE
				$epr4 = $_POST["epr$i"];
				$elv4 = $_POST["elv$i"];
				if($epr4!="----") {
					fprintf($fp, "$epr4:$elv4:");
					$premiereligne = $false;
				}
				$i++;
			}
			while($i<$nombre){//LES AUTRES LIGNES
				$epr4 = $_POST["epr$i"];
				$elv4 = $_POST["elv$i"];
				if($epr4!="----") fprintf($fp, "\n$epr4:$elv4:");
				$i++;
			}
		}
		
		if($lanouvelle!=$ladate){
			$i = 0;$j=1;
			$epr4 = $_POST["epr$i"];
			$elv4 = $_POST["elv$j"];
			fprintf($fp, "$epr4:$elv4:");//PREMIERE LIGNE
			$i++;$j++;
			while($i<$nombre){//LES AUTRES LIGNES
				$epr4 = $_POST["epr$i"];
				if($j==$nombre) $elv4 = $_POST["elv0"]; else $elv4 = $_POST["elv$j"];
				fprintf($fp, "\n$epr4:$elv4:");
				$i++;$j++;
			}
			$nouvelletxt=str_replace("_","/",$lanouvelle);
			$listedesplannings .= "<a href=\"./planning.php?action=3&ladate=$lanouvelle&laclasse=$classe\">$nouvelletxt</a> ";
		}		
		
		fclose($fp);
		
		$labeldate = str_replace("_", "/", $lanouvelle);
		echo("<h2>Planning du $labeldate</h2>");	
		$letableau = tab_activite($classe,$lanouvelle,$lepreuve1);
		echo($letableau);
	}
	
	if($action==0){
		echo("<form method=\"post\" action=\"./planning.php?action=1\">");
		echo("<p>Donnez une date pour le premier planning :");
		$question = champs("ladate",$date);
		echo("$question ");
		submit();
		echo("</form>");
	}
	
	if($action>0) {
		$ladate = isset($_POST['ladate']) ? $_POST['ladate'] : "";// 		echo("<p>Action = $action</p>");
		$ladate=str_replace("/","_",$ladate);
		$filename = "./files/$classe/_Plannings/$ladate.txt"; //affiche("$filename");
	}

	if($action==1){	
		echo("<h2>Planning du $ladate</h2>");	
		$letableau = tab_activite($classe,$ladate,$lepreuve1);
		echo($letableau);
	}

	if($action==2)  {
		echo("<h2>Planning du $ladate</h2>");
		$laligne1 = $_POST[epr].":";
		if(!file_exists($filename)) {
			$fp = fopen($filename,"w");
			fprintf($fp, $laligne1);
		}
		else {
			$fp = fopen($filename,"a");
			fprintf($fp, "\n".$laligne1);
		}
		fclose($fp);

		$letableau = tab_activite($classe,$ladate,$lepreuve1);
		echo($letableau);
	}

	if($action==3)  {
		if($ladate=="") $ladate = isset($_GET['ladate']) ? $_GET['ladate'] : "";
		$labeldate = str_replace("_", "/", $ladate);
		echo("<h2>Planning du $labeldate</h2>");
		$letableau = tab_activite($classe,$ladate,$lepreuve1);
		echo($letableau);	
	}

	if($action>0){
		//--------------- Graphe .svg avril 2020 ###
		$labeldate_2018 = str_replace("/", "_", $labeldate);
		$filename2 = "./files/$classe/_Plannotes$labeldate_2018.txt";		
		if(file_exists($filename2)){
			$fp3 = fopen($filename2, "r");
			$ligne2note = fgets($fp3);
			fclose($fp3);

			$Zone_image = "<img src=\"./graphe.php?notes=$ligne2note\">";
		}
		$noms = null;//pas de nom dans le fichier
		$notes = explode(":", $ligne2note);
		$filesave = $filename2;
		include("grapheSVG_fct.php");
		include("grapheSVG.php");		
		
		echo("<form method=\"post\" action=\"./planning.php?action=2\">");
		echo("<table><tr><td>Ajouter une activit&eacute;e : $tp_actif");
		$ladate=str_replace("_","/",$ladate);
		echo("<input type=\"hidden\" name=\"ladate\" value=\"$ladate\">");
		submit();
		echo("</td></form>");
		echo("<form method=\"post\" action=\"./plan_export.php?ladate=$ladate&laclasse=$classe\"><td>Exporter le planning du $ladate ");
		submit();
		echo("</td></form></tr></table>");
		
		$ladate15=str_replace("/", "_", $ladate);
		$aeffacer = "./files/$classe/_Plannings/$ladate15.txt";
		$file2delete = "<a href=\"delfile.php?name=$aeffacer&action=0\">Supprimer</a> le planning du $ladate";
	}

	//-------------------------------------------------------------------------------------------------------------  Proposition de Rangement des fichiers -----------------------
	$ladate19=str_replace("/","_",$ladate);
	$filename = "./files/$classe/_Plannings/$ladate19.txt"; //affiche("$filename");
	if(file_exists($filename)) {
		$fp = fopen($filename,"r");//lecture du fichier de planning
		$i = 0; $ii = 0;
		while (!feof($fp)){// oncherche le max de match
			$ligne_planning0112[$i] = fgets($fp);
			$partof = explode(":", $ligne_planning0112[$i]);
			$planning_epreuves_tab[$i] = $partof[0];//liste des TP
			$partof2 = explode(" ", $partof[1]);//liste des élèves
			$planning_acteurs_one[$i] = $partof2[0];//Garde le premier nom
			for($k=0;$k<count($partof2);$k++){
				$planning_acteurs_tab[$ii] = $partof2[$k];
				$ii++;
			}			
			$i++;
		}
		fclose($fp);
	}
	for($i=0;$i<count($ligne_planning0112);$i++) {
		 $newligne_planning = str_replace(":", " ", $ligne_planning0112[$i]); //mets des espaces pour séparer tous les éléments 
		 
		 //Ajout du 10 nov 2017 -  pour prendre en concidération les prénoms
		 $listedesmots107 = explode(" ", $newligne_planning); // Donne la liste des mots pour ajouter les prénoms
		 for($ik107=0;$ik107<count($listedesmots107);$ik107++){//Ajoute les prénoms si ils existe à la ligne 
			 $leprenom = prenom2($listedesmots107[$ik107],$classe);
			 if($leprenom) $ligne_planning0112[$i] = "$leprenom:$ligne_planning0112[$i]";
		 }
		 $ligne_planning0112[$i] = str_replace("*", "", $ligne_planning0112[$i]);//Pour enlever la marque des délégués *
		 //Fin Ajout
		 
		 
		 $newligne_planning = str_replace(":", " ", $ligne_planning0112[$i]);
		 $listedesmots[$i] = explode(" ", $newligne_planning);
	}
	if(is_array($tableaudesTP)) $tableaudesTP_count = count($tableaudesTP);
	else $tableaudesTP_count = 0;
	if($tableaudesTP_count>0){
		echo("<table>");
		for($i=0;$i<count($tableaudesTP);$i++){
			$matchnb = 0;
			for($k=0;$k<count($listedesmots);$k++){
				$nb2match = nombre2match($tableaudesTP[$i],$listedesmots[$k]); //echo("<p>T $i:$k -- $nb2match </p>");
				if($nb2match>$matchnb){
					$matchnb = $nb2match;
					$epreuves_prop = $planning_epreuves_tab[$k];
					$acteurs_prop = $planning_acteurs_one[$k];
				}
			}
			$planning_epreuves_menu = menu_deroulant($planning_epreuves_tab,"tp","$epreuves_prop");
			$planning_acteurs_menu = menu_deroulant($planning_acteurs_tab,"elv","$acteurs_prop");
			echo("<form method=\"post\" action=\"ranger.php?action=1&file=$tableaudesTP[$i]\">");
			echo("<tr><td><a href=\"$origine_filename/$tableaudesTP[$i]\">$tableaudesTP[$i]</a></td>");
			echo("<td>$planning_epreuves_menu</td><td>$planning_acteurs_menu</td>");
			echo("<td><input type=\"submit\" value=\"Ranger\"\"></td></tr>");
			echo("</form>");
		}
		echo("</table>");	
	}	
?>

<?php 
	//les plannings 1 decembre 2016
	$tabDplannings = tabDplannings($classe,$tableauplanning,$ladate);
	echo($tabDplannings);
	include("./bas.php");
?>