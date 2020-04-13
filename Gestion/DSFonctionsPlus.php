<!-- DSFonctionPlus -->
<?php

function sommaire_document($sujet2DS){
		$fp = fopen($sujet2DS, "r");
		$ligne = fgets($fp);
		$i=0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			if($part[0]=="Q") {//Question
				$i++;
				if($i==1) $sommaire_td = "<a href=\"#Q$i\" ><font size=\"-2\">Q$i</font></a>";
				else $sommaire_td .= "</td><td><a href=\"#Q$i\"><font size=\"-2\">Q$i</font></a>";
			}
		}
		fclose($fp);
		
		return $sommaire_td;
}

function ligne2tableauOcentre($texte1,$texte2) {
	echo("<table><tr><td>$texte1</td></tr>");
	echo("<tr><td>$texte2</td></tr></table>");
}

function bandeau($repertoire_elv,$code) {
	$sujet2DS = "$repertoire_elv/rep/index.htm";
	if(file_exists($sujet2DS)) {
		$fp = fopen($sujet2DS, "r");
		$ligne = fgets($fp);
		$i=0;
		$total = 0;
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode("#", $ligne);
			if($part[0]=="Q") {//Question
				$i++;
				$coef[$i]= $part[2];
				$total = $total+$coef[$i];			
			}
		}
		fclose($fp);		
	}
	else $total = "non trouvé";
	echo("<!-- $sujet2DS : NB de points du DS : $total -->");
	
	$note_C = 0;
	$repertoireDreponses = "$repertoire_elv/rep/$code";
	$elements = scandir($repertoireDreponses);
	for($i=1;$i<count($coef)+1;$i++) {
		$note_L = "<a href=\"#Q$i\" ><img src=\"./icon/X.gif\" title=\"Q$i\"></a>";
		if(in_array("N$i.txt", $elements)) {
			$fp = fopen("$repertoireDreponses/N$i.txt", "r");
			$note_Lu = fgets($fp);
			fclose($fp);
			if($note_Lu=="A\n") {
				$note_L = "<a href=\"#Q$i\" ><img src=\"./icon/A.gif\" title=\"Q$i\"></a>";
				$note_C += $coef[$i];
			}
			if($note_Lu=="B\n") {
				$note_L = "<a href=\"#Q$i\" ><img src=\"./icon/B.gif\" title=\"Q$i\"></a>";
				$note_C += 0.75*$coef[$i];
			}
			if($note_Lu=="C\n") {
				$note_L = "<a href=\"#Q$i\" ><img src=\"./icon/C.gif\" title=\"Q$i\"></a>";
				$note_C += 0.35*$coef[$i];
			}
			if($note_Lu=="D\n") {
				$note_L = "<a href=\"#Q$i\" ><img src=\"./icon/D.gif\" title=\"Q$i\"></a>";
				$note_C += 0.05*$coef[$i];
			}
			
		}
		if($i==1) $sommaire_td .= "$note_L";
		else $sommaire_td .= "</td><td>$note_L";
	}
	$retour[1] = "<font size=\"+3\" color=\"red\">$note_C/$total</font>";
	$retour[0] = $sommaire_td;
	return $retour;
}


function lettre($repertoire_rep,$question){
	$filename = "$repertoire_rep/N$question.txt";
	$note_L = "<img src=\"./icon/X.gif\" title=\"Q$question\">";
	if(file_exists($filename)) {
		$fp = fopen($filename, "r");
		$note_Lu = fgets($fp);
		fclose($fp);
		if($note_Lu=="A\n") $note_L = "<img src=\"./icon/A.gif\" title=\"Q$question\">";
		if($note_Lu=="B\n") $note_L = "<img src=\"./icon/B.gif\" title=\"Q$question\">";
		if($note_Lu=="C\n") $note_L = "<img src=\"./icon/C.gif\" title=\"Q$question\">";
		if($note_Lu=="D\n") $note_L = "<img src=\"./icon/D.gif\" title=\"Q$question\">";
		if($note_Lu=="X\n") $note_L = "<img src=\"./icon/X.gif\" title=\"Q$question\">";
	}
	return "<td width=\"20px\">$note_L</td>";
}

?>
<!-- /DSFonctionPlus -->
