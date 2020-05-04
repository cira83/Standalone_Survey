<?php
	header ("Content-type: text/plain");//Pour le faire considérer par le système comme un fichier texte et non html
	
	$nom = $_GET[nom];	
	$classe = $_GET[classe];
	$nb2questions = $_GET[last];
	$txt_output = "";
	$rep_elv = "./files/$classe/_Copies/$nom/rep";;
	$liste = scandir($rep_elv);
	for($i=1;$i<$nb2questions+1;$i++){
		$lettre = "X\n";
		if(file_exists("$rep_elv/N$i.txt")) {
			$fp = fopen("$rep_elv/N$i.txt", "r");
			$lettre = fgets($fp);
		}
		$txt_output .= $lettre;
	}
	
	echo($txt_output);
	
	
	//header("Content-Type: application/csv-tab-delimited-table");
/*	header("Content-disposition: attachment; filename=$nom" . date(" d m").".txt");
	print $txt_output;
	exit;*/
?>