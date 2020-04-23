<?php
	include("./_Clef_Prof.php");//$prof_password
	$drap = 0;
	$classe = isset($_COOKIE['laclasse'])?$_COOKIE['laclasse']:"";
	$elv = isset($_COOKIE['nom'])?$_COOKIE['nom']:"";
	$Mdp = isset($_COOKIE['password'])?$_COOKIE['password']:"";
	
	
	$fichieralire = "./files/$classe.txt";
	if(file_exists($fichieralire)){
		$fp = fopen($fichieralire, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode(":", $ligne);
			if(($part[0]==$elv)&&($part[3]==$Mdp)) $drap = 1;
		}
		fclose($fp);
	}
	
	if($Mdp==$prof_password) $drap = 2;
	
	//Mauvais login = 0 ; Bon login = 1 ; Prof login = 2 ;
	echo("$drap");	
?>