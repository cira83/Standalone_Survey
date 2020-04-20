<?php
	 /* On démarre la session AVANT d'écrire du code HTML*/ 
	 session_start();
?>
<script type="text/javascript" src="./routes.js"></script>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
	</head>
<body><center>
<?php
	/* 
		Chaque ligne du qcm contient Image_question:Réponse:Aide 
		Réponse = A+B+C+D+E+F
	*/
	
	function ordre_des_questions($nb2questions){//pour poser les questions dans un ordre aléatoire
		for($i=0;$i<$nb2questions;$i++) $ordre[$i]=$i;//Là on est dans l'ordre
		for($i=0;$i<$nb2questions;$i++){
			$alea = rand(0,$nb2questions-1);
			//Echange de la place avec une autre place aléatoire
			$pass = $ordre[$alea];
			$ordre[$alea]=$ordre[$i];
			$ordre[$i]=$pass;
		}
		return($ordre);
	}
	
	$heure = date("G");
	$minute = date("i");
	$seconde = date("s");
	
	$nom = $_COOKIE[elv];
	$password = $_COOKIE[password];
	$classe = $_COOKIE[laclasse];
	$numero = $_COOKIE[numero]+0; //echo("<p>-- numero=$numero </p>");
	$justes = $_COOKIE[justes]+0;	
	$filename = $_GET[filename];
	$rang = $_GET[rang];
	$cestlafin = false;
	
	include("./lesfonctions.php");//Attention définir $classe avant !!!!
	$routes = "<table><tr>$tabvert$tabbleu$taborange$tabjaune</tr>";
	$routes .="<tr><td colspan=\"2\"><font size=\"+1\">$nom</font></td><td colspan=\"2\"><font size=\"+2\">Test $filename</font></td></tr></table>";
	echo("$routes");
	
	//Ouverture du questionnaire
	$filenameL = "./files/$classe/_Tests/$filename.txt"; 
	if(!file_exists($filenameL)) affiche("$filenameL n'existe pas");
	else {
		$fp = fopen($filenameL, "r");
		$i=0;
		while(!feof($fp)){
			$question[$i]=fgets($fp);
			$i++;
		}
	}
	$nombre2questions = count($question);
	$imgfile = "./files/$classe/_Tests/img/";
	
	if(password($nom,$password,$classe)){
		if($rang==0){//__________________________________________DEPART
			$ordre = ordre_des_questions($nombre2questions);
			for($i=0;$i<$nombre2questions;$i++) $resultats[$i]="0";
			$_SESSION['$resultats']=$resultats;
			$_SESSION['ordre']=$ordre;
			$ligne1 = "\n<table><tr><td>Le test $filename contient $nombre2questions questions.</td></tr>"; echo($ligne1);
			$ligne1 = "\n<tr><td><a href=\"./questionnaire.php?filename=$filename&rang=1\">Je commence le test $filename.</a></td></tr></table>"; echo($ligne1);
			echo("<table><tr><td><img src=\"./img/depart.svg\"/></td></tr></table>");
			//for($i=0;$i<count($ordre);$i++) echo("$ordre[$i]-");
		}
		else {
			$resultats = $_SESSION['$resultats'];
			$ordre = $_SESSION['ordre'];
			if($rang==1){//__________________________________________QUESTION
				$rang2laquestion = $ordre[$numero];
				$numero_plus = $numero+1;
				
				//Mesure du temps
				if($numero_plus==1) {
					$_SESSION['depart']=microtime(true);
					$duree = 0;
				} else $duree = round(microtime(true)- $_SESSION['depart']);
				
				$ligne1 = "\n<table><tr><td>$duree s</td><td>Question $numero_plus sur $nombre2questions questions</td></tr></table>"; echo($ligne1);
				$tab = explode(":", $question[$rang2laquestion]);
				$image = $imgfile.$tab[0];
				
				//Recherche des questions dynamiques - Modif du 5 octobre 2016
				if(extension2($tab[0])=="din") {//Position de la réponse alèatoire
					$tab[1] = $LettreAB[rand(0,5)];
				}
				
				$_SESSION['nom2image']=$image;
				$_SESSION['reponse']=$tab[1];  //Definition de la bonne réponse - echo("?$tab[1]");
				
				$ligne2 = "\n<table><tr><td><img src=\"./image.php\"/></td></tr></table>"; echo($ligne2);
				$valider = "<input type=\"button\" value=\"Valider\" onclick=\"repondre('$filename','$numero_plus');\"/>";
				$ligne3 = "\n<table><tr><td>Pour le moment : $justes r&eacute;ponse(s) juste(s) sur $numero question(s)</td><td>$select_rep</td><td>$valider</td></tr></table>"; echo($ligne3);
				$ligne4 = "<table><tr>";
				$ligne4 .= "<td bgcolor=\"#CCFF65\" onclick=\"repondreA('$filename','$numero_plus','A');\" class=\"pointer\">A</td>";
				$ligne4 .= "<td bgcolor=\"#66FFFF\" onclick=\"repondreA('$filename','$numero_plus','B');\" class=\"pointer\">B</td>";
				$ligne4 .= "<td bgcolor=\"#FFCD66\" onclick=\"repondreA('$filename','$numero_plus','C');\" class=\"pointer\">C</td>";
				$ligne4 .= "<td bgcolor=\"#FFFE66\" onclick=\"repondreA('$filename','$numero_plus','D');\" class=\"pointer\">D</td>";
				$ligne4 .= "<td bgcolor=\"#CCFF65\" onclick=\"repondreA('$filename','$numero_plus','E');\" class=\"pointer\">E</td>";
				$ligne4 .= "<td bgcolor=\"#66FFFF\" onclick=\"repondreA('$filename','$numero_plus','F');\" class=\"pointer\">F</td>";
				$ligne4 .= "</tr></table>";echo($ligne4);
			}
			else {//__________________________________________________REPONSE
				$rang2laquestion = $ordre[$numero-1];
				$ligne1 = "\n<table><tr><td>Question $numero sur $nombre2questions questions</td></tr></table>"; 
				echo($ligne1);
				$tab = explode(":", $question[$rang2laquestion]);
				$image = $tab[0];
				$reponse = $_SESSION['reponse'];// avant $tab[1]; - Modif du 5 octobre 2016 - Validée
				$reponse2leleve = $_GET[rep];
				$duree = round(microtime(true)- $_SESSION['depart']);
				if($reponse2leleve==$reponse){//Reponse juste
					$ligne2 = "\n<table><tr><td>$duree s</td><td bgcolor=\"#00FF00\">Votre r&eacute;ponse est juste : $reponse</td></tr></table>";
					$resultats[$rang2laquestion]="1";
					$justes ++;
				}
				else {//Reponse fausse
					$ligne2 = "\n<table><tr><td>$duree s</td><td bgcolor=\"#FF3333\">Votre r&eacute;ponse est fausse</td></tr></table>";
					$resultats[$rang2laquestion]="$image($reponse2leleve!=$reponse)";
					$aide = $tab[2];
					if(strlen($aide)>2){
						echo("\n<table><tr><td>$aide</td></tr></table>");
					}
				}
				echo($ligne2);
				$_SESSION['$resultats']=$resultats;
				if($numero<count($question)){
					$valider = "<input type=\"button\" value=\"Question suivante\" onclick=\"suivante('$filename',$justes);\"/>";
				}
				else {//Dernière correction - Enregistrement du résultats
					
					$valider = "<input type=\"button\" value=\"Refaire le questionnaire\" onclick=\"raz('$filename');\"/>";
					$performances = "./files/$classe/_Tests/_Perfs/$filename.txt";
					$record = fopen($performances, "a");
					fprintf($record, "$nom:$justes:$numero:Erreurs");
					for($i=0;$i<$nombre2questions;$i++) fprintf($record,":$resultats[$i]");
					fprintf($record,":$date_heure [$ip_candidat]:$duree");
					fprintf($record, ":\n");
					fclose($record);
					
					$cestlafin = true; 
				}
				$ligne3 = "\n<table><tr><td>Pour le moment : $justes r&eacute;ponse(s) juste(s) sur $numero question(s)</td><td>$valider</td></tr></table>"; 
				echo($ligne3);
				if($cestlafin) echo("<table><tr><td><img src=\"./img/the_end.svg\"/></td></tr></table>");
			}
		}
	}
	else echo("\n<table><tr><td>Mot de passe incorrect</td></tr></table>");
	
?>
</center>
</body>
</html>