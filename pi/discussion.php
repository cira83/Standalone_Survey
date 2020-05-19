<html>
<?php
	$nom = isset($_GET['nom'])?$_GET['nom']:"no-name";
	$classe = isset($_GET['classe'])?$_GET['classe']:"no-classe";
	$infos = "Discussion - $nom";
	$filename = "../Gestion/files/$classe/_Copies/$nom/rep/qs.txt";
	
	$discussion = "<table>";
	if(file_exists($filename)) {
		$fp = fopen($filename, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			$discussion .= "<tr bgcolor=\"#ffffff\"><td>$part[0]</td><td>$part[1]</td></tr>";
		}
		fclose($fp);
	}
	else $discussion .= "<tr><td>Pas de discussion avec $nom</td></tr>";
	$discussion .= "</table>";
?>
	<head>
		<link rel="icon" type="image/gif" href="../img/LOGO_Flamme.gif" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="../Gestion/styles_sujet.css"  />
		<title><?php echo($infos);?></title>
	</head>	
		
	<body>
		<table><tr><td><font size="+3"><?php echo($infos);?></font></td></tr></table>
		
		<?php echo($discussion);?>
		
	</body>
</html>		