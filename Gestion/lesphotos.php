<?php
	//Partie avec les photos
	echo("<table>");
	$i = 1;
	$k = 0;
	$listedesparticipants = "";
	while($k<count($leleve)){
		$nom = $leleve[$k];
		$photo = photobord($nom,"#fff");
		$listedesparticipants .= $nom.":";//Necessaire à la création de nouvelles copies
		if($i==1) echo("<tr>");
		if($i<$nbphotoslignes){
			echo "<td>$photo<br/>$nom</td>";
			$i++;
		}
		else {
			$i = 1;
			echo "<td>$photo<br/>$nom</td></tr>\n";
		}
		$k++;	
	}
	while(($i<$nbphotoslignes+1)&&($i!=1)){
			echo "<td>.</td>";
			$i++;
	}
	echo("</table>");
?>