<?php
		//Les couleurs
		//$titre_page ..Titre de la page
	$lejaune = "#FFFE66";
	$levert = "#CCFF65";
	$lebleu = "#66FFFF";
	$leorange = "#FFCD66";
	$tabvert = "<td bgcolor=\"$levert\" onclick=\"direction(1);\" class=\"pointer\">Mes documents</td>";
	$tabbleu = "<td bgcolor=\"$lebleu\" onclick=\"direction(2);\" class=\"pointer\">Notes</td>";
	$taborange = "<td bgcolor=\"$leorange\" onclick=\"direction(3);\" class=\"pointer\">Cahier de texte</td>";
	$tabjaune = "<td bgcolor=\"$lejaune\" onclick=\"direction(4);\" class=\"pointer\">Tests</td>";
	$select_rep = "<select name=\"rep\" id=\"rep\"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option></select>";
	$repertoire_copies =  "./files/$classe/_Copies";
	$logindeseleves = "./files/$classe/_logindeseleves.txt";
	$LettreAB[0]="A";$LettreAB[1]="B";$LettreAB[2]="C";$LettreAB[3]="D";$LettreAB[4]="E";$LettreAB[5]="F";//Définitions des lettres pour les questionnaires
	$ip_candidat = $_SERVER["REMOTE_ADDR"];
	$date_heure = date("d/m - H")."h".date("i");
	$password_prof2018 = "b7wd5c";
	//$leleve[] Liste des élèves
?>