<?php
	$classe = $_COOKIE["laclasse"];
	$filename_cahier = "./files/$classe/_Cahier.txt";

	function number2($nombre){
		if($nombre<10) $resultat = "0$nombre";
		else $resultat = "$nombre";
		return $resultat;
	}

	if(!file_exists($filename_cahier)){
		$fp=fopen($filename_cahier, "w");
		fprintf($fp, "<td colspan=\"3\"><h2>Cahier de texte des $classe</h2></td>");
		fprintf($fp, "\n<td width=\"50px\"><b>Jour</b></td><td width=\"50px\"><b>Mois</b></td><td><b>Activit&eacute;s</b></td>");
		fclose($fp);
	}
	
	$tableau = "<table>";
	$fp = fopen($filename_cahier, "r");
	$ligne00 = fgets($fp);
	$tableau .= "<tr>$ligne00</tr>";
	$ligne00 = fgets($fp);
	$tableau .= "<tr>$ligne00</tr>";
	
	
	$tableau .= "<form action=\"./cahier.php?action=1\" method=\"POST\">";
	
	$date12 = "<select name=\"jour\">";
	$nb = date("d");
	$date12 .= "<option>$nb</option>";
	for($i=1;$i<32;$i++) {
		$nb = number2($i);
		$date12 .= "<option>$nb</option>";
	}
	$date12 .= "</select>";


	$mois12 = "<select name=\"mois\">";
	$nb = date("m");
	$mois12 .= "<option>$nb</option>";	
	for($i=1;$i<13;$i++) {
		$nb = number2($i);
		$mois12 .= "<option>$nb</option>";
	}
	$mois12 .= "</select>";
	
	$tableau .= "<tr><td>$date12</td><td>$mois12</td><td><input type=\"text\" size=\"80\" name=\"texte\"><input type=\"submit\"></td></tr>";
	$tableau .= "</form>";

	
	$i=0;
	while(!feof($fp)){
		$ligne12[$i] = fgets($fp);
		$i++; 
	}
	fclose($fp);
	
	
	if($_GET[action]==1){
		$data1 = $_POST[jour];
		$data2 = $_POST[mois];
		$data3 = $_POST[texte];
		if($data2<8) $codedate="2$data2$data1";
		else $codedate="1$data2$data1";
		$ligne12[$i]="<td><input type=\"hidden\" value=\"$codedate\">$data1</td><td>$data2</td><td>$data3</td>"; 
		
		
		$fp = fopen($filename_cahier, "a");
		fprintf($fp, "\n$ligne12[$i]");
		fclose($fp);
		
		$i++;
	}
	
	
	
	sort($ligne12);
	for($j=$i-1;$j>-1;$j--) $tableau .= "<tr>$ligne12[$j]</tr>";
	
	
	$tableau .= "</table>";
	
	
	echo($tableau);
?>