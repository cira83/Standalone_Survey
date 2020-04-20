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
	
	include("./haut.php");
	
	$i=0;
	if($passwordOK=1) {
		$filename = "./files/$classe.txt"; echo("<table><tr bgcolor=\"#ffffff\"><td><h1>$classe</h1></td></tr></table>");
		$fp = fopen($filename, "r");
		echo("<table><tr bgcolor=\"#ffffff\">");
		while (!feof($fp)){
			$ligne = fgets($fp);
			$part = explode(":", $ligne); 
			$lenom = $part[0]; //	echo($lenom);
			$photo = photobord($lenom,"#FFFFFF"); echo("<td align=\"center\">$photo<br/>$lenom</td>");
			$i++;
			if($i==5){
				$i=0;
				echo("</tr><tr bgcolor=\"#ffffff\">");
			}
		}	
		echo("</tr></table>");	
	}
?>