<?php
	//Créé pour les TP version 2021
	include("./security.php");
	include("./DSFonctions.php");
	include("./DS_Securite.php");
	$numero2session = session_id();

  $titredudocument = "$classe - $elv";
  $sujet2TP = isset($_GET['sujet']) ? $_GET['sujet'] : NULL;
  $TAG = $_GET['tag'];

	function start($nom, $classe){//---------------------------------------------- passe en mode ON
		$drap = false;
		$repertoire = "./files/$classe/_Copies/$nom/rep";
		if(!file_exists($repertoire)) mkdir($repertoire);
		chmod($repertoire,0777);

		$fichier_on = "$repertoire/on.txt";
		if(!file_exists($fichier_on)){//pour ne pas changer de code en cas de correction du sujet
			$fp = fopen($fichier_on, "w");
			$code = rand(1000,9999);//code unique
			fwrite($fp, "$code");
			fclose($fp);
			chmod($fichier_on,0777);
			$repertoire_reponses = "$repertoire/$code";
			mkdir($repertoire_reponses);
			chmod($repertoire_reponses,0777);
			$drap = true;
		}

		return $drap;
	}

	$depart = "./files/$classe/_Copies/$elv/sessions.txt";
	$arrive = "./files/$classe/_Copies/$elv/sessions.bak.txt";
	$copy_possible = file_exists($depart);
	if($copy_possible) copy($depart,$arrive);

	$depart = "./files/$classe/_Copies/_Sujets/$TAG/index.htm";
	$arrive = "./files/$classe/_Copies/$elv/rep/index.htm";
	$copy_possible = file_exists($depart);
	$drap = start($elv, $classe);
	if($copy_possible&&$drap) copy($depart,$arrive);
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
			<tr><td><font size="+5"><?php echo($titredudocument);?></font></td>
			</tr></table>

<?php
	$sujet2TP = TitreduTAG($TAG,$classe);
	if($copy_possible&&$drap) {
		$fp = fopen("./files/_Sujet_Ouvert.txt", "w");
		fwrite($fp, "$classe:$elv:$TAG:");
		fclose($fp);
		echo("<p>Le sujet $sujet2TP est disponible pour travailler.</p>");
		echo("<p><a href=\"./devoir.php\">$sujet2TP</a></p>");
	}
	if(!$copy_possible) echo("<p>Le sujet $sujet2TP : $depart n'existe pas.</p>");
	if(!$drap){
		echo("<p>Un sujet est déjà présent !!!</p>");
		echo("<p><a href=\"./devoir.php\">$sujet2TP</a></p>");
	}

?>


</center>
</body>
</html>
