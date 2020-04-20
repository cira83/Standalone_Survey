<?php 
	include("./Setting/header.php");
?>
<table class="titre2"><tr><td>Diaporamas</td></tr></table>
<?php

	$repertoire = $chemin; 	
	$ListFiles = scandir($repertoire);
	sort($ListFiles);
	$i=0;
	$k=1;
	$nbfichier=0;
	echo("<table class=\"pied\">");
	while ( $i < count($ListFiles)){
       	$file = $ListFiles[$i];
		$array=explode('.',$file);
		$extension=$array[1];
        if(($array[1]!="php")&&($array[1]!="")){
            echo("<tr><td><a href=\"./$repertoire$file\">");
			echo($array[0]);
			echo("</a></td></tr>");
			$nbfichier++;
    	}
    	$i++;
	}
	echo("</table>");
	
?>
<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="./diaporamas.php">
<tr><td><input name="fichier_choisi" type="file"></td><td><input name="password" type="hidden" value="OK"</td>


<?php if($password=="yb8x7agz") echo("<td><input name=\"bouton\" value=\"Envoyer le fichier\" type=\"submit\"></td>"); ?>


</tr>
</form></table>	
<?php 	
	include("./Setting/footer.php");
?>
