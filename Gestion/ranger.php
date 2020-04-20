<?php
	include("./haut.php");
	$lenomdufichier = my_GET("file");
	$action = my_GET("action");

	//Création Repertoire _Copies 
	if(!file_exists($repertoire_copies)){
		 mkdir($repertoire_copies, 0777);
		 affiche("-- $repertoire_copies cr&eacute;e --");
	}


?>
<hr/>
<form method="post" action="ranger.php?action=1&file=<?php echo($lenomdufichier);?>">
<?php
/* 
	$leleve listes des élèves
*/	
	$nom = my_POST("elv");
	$TP = my_POST("tp");
	$force = my_POST("force");
	
	//$lien ="<a href=\"../sav/TP/$lenomdufichier\">";
	//$url ="../sav/TP/$lenomdufichier";
	$lien ="<a href=\"$origine_filename/$lenomdufichier\">";
	$url ="$origine_filename/$lenomdufichier";
	
	
	if($action==1){
		// Création Repertoire Eleve 
		$repertoire_elv =  "$repertoire_copies/$nom";
		if(!file_exists($repertoire_elv)){
			mkdir($repertoire_elv, 0777);
			affiche("-- $repertoire_elv cr&eacute;e --");
		}

		//deplacement du fichier
		if($TP!="----") {
			$nouveaunom = "$TP $nom";//Ne pas changer le nom si ----
			$extension = substr(strrchr($url, '.'), 1);
			$newname = "$repertoire_elv/$nouveaunom.$extension";
			$num = 2;
			while((file_exists($newname))&&($num<10)){
				$newname = "$repertoire_elv/$nouveaunom $num.$extension";
				$num++;
			}
		}
		else {
			$nouveaunom = $lenomdufichier;
			$newname = "$repertoire_elv/$nouveaunom";
		}
		
		rename($url, $newname);
		
		for($i=0;$i<count($lepreuve1);$i++){
			$part = explode(".",$lepreuve1[$i]);
			if($part[0]==$TP) $matiere = $part[2];
		}
		
		echo("<table>");
		echo("<tr><td>Le fichier $lenomdufichier est déplacé dans le répertoire de $nom.</td></tr>");
		echo("<tr><td>Le fichier devient est : $newname.</td></tr>");
		
		echo("</table>\n");
	}
	else {
		//Recherche du nom de l'élève
		$lebonnom = "";
		$lenomdufichier2 = "_".strtolower($lenomdufichier);
		for($i=0;$i<count($leleve);$i++){
			$lenom2 = strtolower($leleve[$i]);
			$pos1 = stripos($lenomdufichier2, $lenom2);
			if($pos1>0) $lebonnom = $leleve[$i];
		}
		$lemenuelv = menu_deroulant($leleve,"elv",$lebonnom);
	
		//Recherche du nom du TP
		$lebonTP = "";
		for($i=0;$i<count($tableaudesepreuves);$i++){
			$lenom2 = strtolower($tableaudesepreuves[$i]);
			$pos1 = stripos($lenomdufichier2, $lenom2);
			if($pos1>0) $lebonTP = $tableaudesepreuves[$i];
		}
		$lemenueTP = menu_deroulant($tableaudesepreuves,"tp",$lebonTP);
	
		echo("<table><tr>");
		echo("<td>$lien$lenomdufichier</a></td>");
		echo("<td>$lemenuelv</td>");
		echo("<td>$lemenueTP</td>");
		echo("<td><input type=\"submit\"></td>");
		echo("<td><INPUT type=\"checkbox\" name=\"force\" value=\"true\">Forcer l'&eacute;criture</td>");
		echo("</tr></table>\n");
		
		$ligneTab1 = "";
		$rep_cible = "$repertoire_copies/$lebonnom";
		$liste_rendue = scandir($rep_cible);
		foreach($liste_rendue as $nom_fichier){
			if(stripos("_".$nom_fichier,$lebonTP)) $ligneTab1 .= "<tr><td>$nom_fichier</td></tr>";
		}
		
		if($ligneTab1<>"") echo("<table>$ligneTab1</table>\n");
	}
		
?>
</form>
<script>
	function lecture(){
		les_messages = document.getElementById("dynamique");
		var xhr = null;
		var xhr = new XMLHttpRequest();		
		
		xhr.onreadystatechange = function() {
        	if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
	        	les_messages.innerHTML = xhr.responseText;
        	}
    	};
    
		xhr.open("GET", "./list_files.php?file=<?php echo($origine_filename);?>", true);
		xhr.send(null);
				
	}
	setInterval(lecture, 4000);
</script>

<!-- Partie dynamique -->
<span id="dynamique">
</span>






<?php include("./bas.php");?>