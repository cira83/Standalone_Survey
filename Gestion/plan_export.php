<?php
	$ladate = $_GET[ladate];
	$laclasse = $_GET[laclasse];
	$ladate2 = str_replace("/", "_", $ladate);
	$filename = "./files/$laclasse/_Plannings/$ladate2.txt";
	
	//Fait la liste des noms et des prenoms de élèves de la classe
	$filenoms = "./files/$laclasse.txt";
	$fp = fopen($filenoms, "r");
	$i = 0;
	while(!feof($fp)){
		$ligne = fgets($fp);
		$part = explode(":", $ligne);
		$nom[$i] = $part[0];
		$prenom[$i] = $part[1];
		$i++;
	}
	fclose($fp);
?>


<html>
	
	<body>
		<?php
			if(!file_exists($filename)){
				echo("Le fichier $filename n'existe pas !!!");
			}
			else {
				$listing = "<p>";
				$file = fopen($filename, "r");
				while(!feof($file)){
					$ligne = fgets($file);
					$part2 = explode(":", $ligne);
					$part2[1] = str_replace(" ", " et ", $part2[1]);
					$listing .= "• $part2[1] sur $part2[0] ;<br>";
				}
				$listing .= "</p>";
				fclose($file);
				
				echo("<p>Planning des $laclasse du $ladate </p>");
				
				$listing = str_replace($nom, $prenom, $listing);
				
				echo($listing);

			}
		?>
	</body>
</html>