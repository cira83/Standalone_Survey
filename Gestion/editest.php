<?php
	$classe = $_COOKIE["laclasse"]; if($classe=="") $classe="CIRA1";

	
	
	include("./haut.php");
	$testname = $_GET['file'];
	
	$test_file = "./files/$classe/_Tests/$testname.txt";
	$performances_file = "./files/$classe/_Tests/_Perfs/$testname.txt";
	
	
	function nombre_erreur($imgname,$correction){
		$nombre = 0;
		for($i=0;$i<count($correction);$i++){
			if(strpos($correction[$i], $imgname)) $nombre++;
		}
		return($nombre);
	}
?>
<table><tr><td><?php echo("<font size=\"+2\">$testname</font>");?></td></tr></table>

<?php
	if(file_exists($performances_file)){
		$fp = fopen($performances_file, "r");
		$i = 0;
		while(!feof($fp)){
			$correction[$i] = fgets($fp);
			$i++;
		}
		fclose($fp);
	}
	
	
	$fp = fopen($test_file, "r");
	echo("<table>");
	while(!feof($fp)){
		$nb = nombre_erreur($part[0],$correction);
		$ligne = fgets($fp);
		$part = explode(":", $ligne);
		$image = "./files/$classe/_Tests/img/$part[0]";
		$font = "<font color=\"#0000dd\">";
		echo("<tr bgcolor=\"#FFFFFF\"><td>$font$image</font></td><td>$font$nb</font></td><td>$font$part[1]</font></td></tr>");
		echo("<tr><td colspan=3><img src=\"$image\"/></td></tr>");
	}
	echo("</table>");
	
	fclose($fp);
	include("./bas.php");
?>