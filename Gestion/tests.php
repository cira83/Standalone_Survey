<script type="text/javascript" src="./routes.js"></script>
<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119274440-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-119274440-1');
		</script>
		<!-- End -->

		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
	</head>
<body onload="raz2();">
<center>
<?php		
	$nom = $_COOKIE[elv];
	$password = $_COOKIE[password];
	$files = "./files/";
	$classe = $_COOKIE[laclasse];
	
		//Accés aux données pour le professeur
	$getnom = $_GET[nomelv];
	if($getnom!="") {
		$nom=$getnom;
		$_COOKIE["elv"] = $nom;
	}
	
	
	
	include("./lesfonctions.php");//Attention définir $classe avant !!!!	
	$routes = "<table><tr>$tabvert$tabbleu$taborange</tr>";
	
	
	//Gestions des Fichiers
	$racine = "./files/$classe/_Tests";
	if(!is_dir($racine)){
		mkdir($racine, 0777);
		echo("<p>Création du dossier $racine</p>");
	}
	
	//Liste des questionnaires
	$ListFiles = scandir($racine);
	sort($ListFiles);
	
	echo($routes);
	
	function performances($filename,$classe,$nom){
		$performances = "./files/$classe/_Tests/_Perfs/$filename.txt";
		$nb = 0;
		$max = 0;
		if(file_exists($performances)){
			$fp = fopen($performances, "r");
			while(!feof($fp)){
				$line = fgets($fp);
				$tab = explode(":", $line);
				if($nom==$tab[0]){
					$nb++;
					$note=$tab[1]; if($max<$note) $max=$note;
					$quest=$tab[2];
				}
			}
			fclose($fp);
		}
		return("<td>$nb</td><td>$note/$quest</td><td>$max/$quest</td>");
	}
	

?>
<tr bgcolor="<?php echo($lejaune);?>">
<?php
	//$logout = "<input type=\"button\" value=\"Se deconnecter\" onclick=\"logout();\">";
	$logout = "<td onclick=\"direction(0);\" class=\"pointer\"><b>Retour</b></td>";
	if(password($nom,$password,$classe)){
		echo("<td colspan=2>$nom</td>$logout</tr></table>");
		echo("<table><tr><td>Tests disponibles</td><td>Essais</td><td>Derni&egrave;re note</td><td>Meilleure note</td>");
		for($i=2;$i<count($ListFiles);$i++){
			$elts = explode(".", $ListFiles[$i]);
			if((strlen($elts[0])>1)&&(count($elts)>1)){
				$performances = performances($elts[0],$classe,$nom);
				$ligne = "<tr><td><a href=\"./questionnaire.php?filename=$elts[0]&rang=0\">$elts[0]</a></td>$performances</tr>";
				echo("$ligne");
			}
		}
		echo("</table>");
		$sujet2DS = "./files/$classe/_Copies/$nom/index.htm";
		$zone2dspersonnel = "<a href=\"./devoir.php\">Zone de DS personnalis&eacute;e</a>";
		if(file_exists($sujet2DS)) titre_tab($zone2dspersonnel);
		//echo("<table><tr><td><a href=\"./devoir.php\">Zone de DS personnalis&eacute;e</a></td></tr></table>");
		
			
	}
	else{
		echo("<td colspan=2>Vous n'&ecirc;tes pas connect&eacute;(e) !!</td>$logout</tr></table>");
	}
?>
</center>
</body>
</html>