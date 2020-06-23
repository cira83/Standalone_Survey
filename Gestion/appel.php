<?php    	
	$classe = $_COOKIE["laclasse"];
	$laclasserep = "./files/$classe";//Répertoire de la classe
	if(!file_exists($laclasserep)) {
		mkdir($laclasserep);
	}
		
	$laclassefile1 = "./files/$classe.txt";
	$laclassefile2 = "./files/$classe/_Profils.txt";
	include("./netoyage.php");
	netoyage($laclassefile2,$laclassefile2);

	include("./haut.php");

	if($passwordOK) include("./appel_ok.php");
?>