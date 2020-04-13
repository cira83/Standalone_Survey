<?php
	session_start();
	$numero = session_id();
	$action = $_GET[action];
	
	
	if($action=="tableau"){
		$Ligne = explode("#",$_SESSION['black']);
		$avecvirgules = str_replace(".", ",", $_SESSION['black']);
	
		$csv_output = "Pulsation;Module;Argument\n";
		$csv_output .= str_replace("#", "\n", $avecvirgules);
	}
	
	if($action=="tableau2"){
		$Ligne = explode("#",$_SESSION['temps']);
		$avecvirgules = str_replace(".", ",", $_SESSION['temps']);
	
		$csv_output = "Temps;Erreur;Mesure\n";
		$csv_output .= str_replace("#", "\n", $avecvirgules);
	}
		
	header("“Content-Type: application/csv-tab-delimited-table");
	header("Content-disposition: attachment; filename=Data_" . date("his").".csv");
	print $csv_output;
	exit;

?>