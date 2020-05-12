<?php
	header ("Content-type: text/plain");//Pour le faire considérer par le système comme un fichier texte et non html
	
	$filesave = $_GET['filesave'];
	$file = $_GET['file']; $part = explode(".", $file);
	
	if(file_exists($filesave)){
		$fp = fopen($filesave, "r");
		$tabnote = fgets($fp);
		$note = explode(":", $tabnote);
		$tabnom =  fgets($fp);
		$nom = explode(":", $tabnom);
		fclose($fp);
	}
	
	$txt_output = "Nom\t$part[0]\n";
	
	$nb2note = count($nom);
	for($i=0;$i<$nb2note;$i++){
		$note[$i]=strtr($note[$i], ".", ",");
		$txt_output .= "$nom[$i]\t$note[$i]\n";
	}
	
	
	//echo($txt_output);
	
	//header("Content-Type: application/csv-tab-delimited-table");
	header("Content-disposition: attachment; filename=$part[0]_" . date("d_m").".txt");
	print $txt_output;
	exit;
?>