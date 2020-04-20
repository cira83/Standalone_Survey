<?php    	
	$classe = $_COOKIE["laclasse"];
	$laclassefile = "./files/$classe.txt";
	$action = $_GET[action];
	
	
	
	
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
	
	if($action==1){
		$nb_elv = $_POST[nb];
		$fp = fopen($laclassefile, "w");
		//echo("nb_elv = $nb_elv");
		for($i=0;$i<$nb_elv;$i++){
				$bts = $_POST["elv$i"];
				$modif = $_POST["ligne$i"];
				$modif = trim($modif);
				$part = explode(":", $modif);
				$part[12]=$bts;
				if($i+1<$nb_elv) $modification = "$part[0]:$part[1]:$part[2]:$part[3]:$part[4]:$part[5]:$part[6]:$part[7]:$part[8]:$part[9]:$part[10]:$part[11]:$part[12]:\n";
				else $modification = "$part[0]:$part[1]:$part[2]:$part[3]:$part[4]:$part[5]:$part[6]:$part[7]:$part[8]:$part[9]:$part[10]:$part[11]:$part[12]:";
				
				fprintf($fp, $modification);//echo("$modification<br>");
		}
		fclose($fp);
	}
	
	
	
	
	
	function menu_bts($i,$val){
		//$menu = "$i -$val-";
		if($val=="OUI") $menu = "<select name=\"elv$i\"><option>OUI</option><option>NON</option></select>";
		else $menu = "<select name=\"elv$i\"><option>NON</option><option>OUI</option></select>";
		return $menu;
	}
	
	function vignette($ligne,$i){
		$part = explode(":", $ligne);
		$bts = menu_bts($i,$part[12]);
		
		if(stripos("_$part[12]", "OUI")) $photo = photobord($part[0],"#0f0");
		else $photo = photobord($part[0],"#f00");
		
		$vignette = "$part[0]<br/>$photo<br/>$bts\n";
		
		return($vignette);
	}
	
	
	
	if($passwordOK){
		$filename = "./files/$classe.txt"; //echo($filename);
		if(file_exists($filename)){
			$fp = fopen($filename, "r");
			$i = 0;
			while(!feof($fp)){
				$ligne[$i]=fgets($fp);
				$tab[$i] = explode(":", $ligne[$i]);
				$i++;
			}
			fclose($fp);
			$nb_elv = $i;
		}
?>	
		<table><tr><td><a href="./"><?php echo($classe);?></a></td></tr></table>
		
<?php		
		echo("<form method=\"POST\" action=\"./bts.php?action=1\">");
		echo("<table><tr>");
		
		for($i=0;$i<$nb_elv;$i++){			
			$vignette = vignette($ligne[$i],$i);
			if($k<5) echo("<td>$vignette</td>");
			else {
				$k=0;
				echo("</tr><tr>");
				echo("<td>$vignette</td>");
			}
			$k++;
		}
		echo("</tr></table>");
		for($i=0;$i<$nb_elv;$i++) echo("<input type=\"hidden\" name=\"ligne$i\" value=\"$ligne[$i]\">\n");
		echo("<input type=\"hidden\" name=\"nb\" value=\"$nb_elv\">");
		
		echo("<table>");
		echo("<tr><td><input type=\"submit\"></td></tr>");
		echo("</table><form>");
		
		
		echo("<table><tr><td>");
		
		$nouvelle = "Félicitations à ";
		$k=0;
		for($i=0;$i<$nb_elv;$i++){
			$info = explode(":", $ligne[$i]);
			if($info[12]=="OUI") {
				$Laureat[$k]=$info[1];
				$k++;
			}
			
			
		}
		sort($Laureat);
		foreach($Laureat as $elt) $nouvelle .= "$elt, ";
		
		
		$nouvelle .= "pour avoir obtenu le BTS CIRA cette année.";
		echo("$nouvelle</td></tr></table>");
		
		$fp = fopen("./_laureats.htm", "w");
		fprintf($fp,"<html><head>");
		fprintf($fp,"<style type=\"text/css\">body {width: 800px;margin-right: auto;margin-left: auto;}</style>");
		fprintf($fp,"<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">");
		fprintf($fp,"</head>");
		fprintf($fp, "<h1>$nouvelle</h1>");
		fprintf($fp,"</html>");
		fclose($fp);
		
	}	
	
?>


<table><tr><td><a href="./_laureats.htm">Nouvelle</a></td></tr></table>
