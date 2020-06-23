<script>
	function changer_coef(div){
		var valeur = div.innerHTML;
		var filename = div.title;
		var question = 'Donner la nouvelle valeur du coefficient';
		var xhr = null;
	    var xhr = new XMLHttpRequest();	
	    		
		lareponse = prompt(question,valeur);
		div.innerHTML = lareponse;
	    
	    chemin = "./changer_coef.php?infos="+filename+":"+lareponse+":";	
		xhr.open("GET", chemin, true);
		xhr.send(null);		
	}
</script>
<?php
	$titre_page = "Les Matières";
	include("./haut.php");
	$new_mat = my_POST("mat");

	$tableau = "<table>";
	$repertoire = "./files/$classe"; echo("<!-- $repertoire -->");
	if($new_mat) mkdir("$repertoire/$new_mat");

	$matieres = scandir($repertoire);
	foreach($matieres as $mat){
		if(estfichier($mat)){
			$file_coef = "$repertoire/_Coef $mat.txt";
			if(file_exists($file_coef)){
				$fp = fopen($file_coef, "r");
				$ligne = fgets($fp);
				fclose($fp);				
			}
			else $ligne = "2:";
			$coef = explode(":", $ligne);
			$tableau .= "<tr>";
			$tableau .= "<td width=\"80px\"><a href=\"matiere.php?mat=$mat\">$mat</a></td><td width=\"10px\">$coef[0]</td><td align=\"left\">";
			$epreuves = scandir("$repertoire/$mat");
			foreach($epreuves as $epr){
				if(estfichier($epr)) {
					$lien = "./epreuve.php?mat=$mat&epr=$epr";
					$epr = str_replace(".txt", "", $epr);
					$tableau .= "<a href=\"$lien\">$epr</a> ";
				}
			}
			$tableau .= "</td></tr>";
			$tableau .= "<tr bgcolor=\"#d5d5d5\" height=\"5px\"><td colspan=\"3\"></td></tr>";			
		}

	}
	$tableau .= "<table>";


	echo($tableau);
?>
<form method="post" action="./matieres.php">
<table><tr><td><input type="text" name="mat"></td><td><input type="submit" value="Nouvelle Matière"> </td></tr></table>
</form>
<?php
	
	include("./bas.php");
?>