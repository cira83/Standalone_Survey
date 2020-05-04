<?php
	header ("Content-type: text/plain");//Pour le faire considérer par le système comme un fichier texte et non html
	
	$sem = $_GET['sem'];
	$classe = $_GET['classe'];
	$note = array_fill(0, 100, "");
	$couple = array_fill(0, 100, "");
	$txt_output = "";

	$directory = "./files/$classe";
	$repertoires = scandir($directory);
	foreach($repertoires as $rep) {
		if(!strpos(" $rep", "_")&&strpos($rep, $sem)) {
			$filename = "./files/$classe/_$rep.txt";
			if(file_exists($filename)) {
				$fp = fopen($filename, "r");
				$tabnote = fgets($fp);
				$note = explode(":", $tabnote);
				$tabnom =  fgets($fp);
				$nom = explode(":", $tabnom);
				fclose($fp);
				
				$couple[0] .= "nom\t$rep\t";
				$nb2note = count($nom);
				for($i=0;$i<$nb2note;$i++){
					$note[$i]=strtr($note[$i], ".", ",");
					$note[$i]=rtrim($note[$i]);
					$couple[1+$i] .= "$nom[$i]\t$note[$i]\t";
				}
			}
		}	
	}
	$nb2note = count($couple);
	for($i=0;$i<$nb2note;$i++) $txt_output.="$couple[$i]\n";
	
		
	header("Content-disposition: attachment; filename=$classe" ." Semestre $sem"." le ". date("d_m").".txt");
	print $txt_output;
	exit;
?>