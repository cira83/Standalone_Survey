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
	
	$file_log = "./files/$classe/_logindeseleves.txt";
	$date = date('l jS \of F Y h:i:s A');
	$ip = $_SERVER['REMOTE_ADDR'];
	$phrase = "\n<td>$classe</td><td>$elv</td><td>$drap</td><td>$date</td><td>$ip</td>";
	$fp2 = fopen($file_log, "a");
	fwrite($fp2, $phrase);
	fclose($fp2);
	//Mauvais login = 0 ; Bon login = 1 ; Prof login = 2 ;
	echo("$drap");	
?>