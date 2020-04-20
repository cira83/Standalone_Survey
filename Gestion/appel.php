<?php    	
	$classe = $_COOKIE["laclasse"];
	$laclassefile = "./files/$classe.txt";
	
	$laclasserep = "./files/$classe/";//Création du répertoire de la classe
	if(!file_exists($laclasserep)) {
		mkdir($laclasserep);
	}
	
	
	if(!file_exists($laclassefile)) {
		$files_list_tab = scandir("./files");
		sort($files_list_tab);
		$i=0;
		$name_elts = explode(".", $files_list_tab[$i]);
		while($name_elts[1]!="txt") {
			$i++;
			$name_elts = explode(".", $files_list_tab[$i]);
		}
		$classe="$name_elts[0]";
		setcookie("laclasse", $classe);
		$laclassefile = "./files/$classe.txt";
	}

	include("./netoyage.php");
	netoyage($laclassefile);

	include("./haut.php");
	//if($nb2lignes>$nb2lignes2+1) echo("<p><a href=\"$fichierdenom\">Nettoyage effectu&eacute;</a>  $chmod</p>");	

	if($passwordOK) include("./appel_ok.php");
?>