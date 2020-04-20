<?php
	$filename = "./SQL/base.sql";
	$table_eleves = "eleves";
	$ordre_eleves = "0:1:2:13:4:11";
	$table_copies = "evaluations";
	
	function ligne($ligne,$sep){
		$part1 = explode("(", $ligne);
		$part2 = explode(")", $part1[1]);
		$part3 = explode(",", $part2[0]);
		for($i=0;$i<count($part3);$i++){
			$part4 = explode($sep, $part3[$i]);
			$phrase[$i] = $part4[1];
		}
		return $phrase;
	}
?>
<html>
<head>
	<script type="text/javascript" src="./script.js"></script>
	<style type="text/css"></style>
	<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
	<link rel="icon" type="image/jpg" href="./icon/favicon.jpg">
	<title>Input SQL</title>
</head>
<body>
	<center><h2>Import d'une table SQL de CIRA</h2></center>
	<p>Le nom du fichier lu est : <?php echo($filename);?></p>
	<form action="./inputSQL.php?action=1" method="post">
		<p>Le nom de la classe <input type="text" name="classe" value="TS1CIRA 2000"><br>
		Le nom de la table des élèves <?php echo($table_eleves);?><br>
		Ordre des données élèves <?php echo($ordre_eleves);?></p>
		
		<input type="submit">
	</form>
	<hr/>
<?php
	$action = $_GET[action];
	$base = $table_eleves ;
	$get_ordre = $ordre_eleves; 
	$laclasse = $_POST[classe];
	if($action){
		echo("-- Lecture de la base --<br/>");
		if(file_exists($filename)) {
			$repclasse = "./SQL/$laclasse";
			mkdir($repclasse);
			echo("Création du répertoire $repclasse <br/>");
						
			$fp = fopen($filename, "r");
			while(!feof($fp)){
				$ligne = fgets($fp);
				$position = stripos("_$ligne", "INSERT INTO `$base`");
				if($position) {//liste des élèves
					$ligne = fgets($fp);//première ligne de données
					while($ligne[0]=="("){
						$phrase = ligne($ligne,"'");
						$ligne2fichier = "";
						$classefile = "./SQL/$laclasse.txt";
						$ordre = explode(":", $get_ordre);
						for($j=0;$j<count($ordre);$j++) {
							$adresse = $ordre[$j];
							$ligne2fichier .= "$phrase[$adresse]:";
						}
						if(!file_exists($classefile)){
							$fp2=fopen($classefile, "w");//Premier nom
							fwrite($fp2,"$ligne2fichier");
							echo("Création du fichier $classefile <br/>");
						}
						else {
							$fp2=fopen($classefile, "a");//Les suivants
							fwrite($fp2,"\n$ligne2fichier");
						}
						fclose($fp2);
						echo("$ligne2fichier<br/>");
						$ligne = fgets($fp);
					}
				}
				$position = stripos("_$ligne", "INSERT INTO `$table_copies`");
				if($position) {//liste des copies
					$ligne = fgets($fp);//première ligne de données
					while($ligne[0]=="("){
						$phrase = ligne($ligne,"'");//fourni la ligne du tableau
						$ligne2fichier = "";
						$matrep = "$repclasse/$phrase[1]";
						if(!file_exists($matrep)){
							mkdir($matrep);
							echo("Création du répertoire $matrep <br/>");
						}
						$eprep = "$matrep/$phrase[2].txt";
						if(!file_exists($eprep)){
							$fp2=fopen($eprep, "w");
							$ligne2fichier = "$phrase[3]:$phrase[7]:$phrase[6]:$phrase[4]";
							fwrite($fp2,$ligne2fichier);
							echo("Création du fichier $eprep <br/>");
						}
						else {
							$fp2=fopen($eprep, "a");
							$ligne2fichier = "$phrase[3]:$phrase[7]:$phrase[6]:$phrase[4]";
							fwrite($fp2,"\n$ligne2fichier");
						}
						fclose($fp2);
						$ligne = fgets($fp);
					}
				}
			}
			fclose($fp);
			
		}
		else {
			echo("Le fichier $filename n'existe pas !!");
		}
	}
	
?>
</body>
</html>