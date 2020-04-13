<?php 
	//Recherche du mot de passe du DS
	function DSMDP($classe, $elv) {
		$filename = "./files/$classe/_Copies/$elv/rep/on.txt";
		$password = "";
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			$password = fgets($fp);
			fclose($fp);
		}
		$filename = "./files/$classe/_Copies/$elv/rep/off.txt";
		if(file_exists($filename)) {
			$fp = fopen($filename, "r");
			if(!$password) $password = fgets($fp);
			fclose($fp);
		}	
				
		$password++;
		$password--;
		return $password;
	}
	//echo("DS_securite loaded");
?>
