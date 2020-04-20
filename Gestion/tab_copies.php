<?php
	$classe = $_COOKIE["laclasse"];
	$password = $_COOKIE["password"];
	$filename = "./files/$classe.txt";
	
	
	function age($date){
		$nombre = explode("/", $date);
		$age = date("Y")-$nombre[2];
		
		return $age;
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
		<link rel="icon" type="image/jpg" href="./icon/favicon.jpg">
		<title>Epreuves des <?php echo($classe);?></title>
	<style type="text/css"></style></head>
	<body>
		<center><h1>Epreuves des <?php echo($classe);?></h1></center>
		<table class="C100">
			
<?php
	function estfichier($filename){
		$drap = true;
		$data = explode(".", $filename);
		if($data[0]=="") $drap = false;
		if($filename[0]=="_") $drap = false;
		
		return $drap;
	}
	
	
	
	$repertoire = "./files/$classe";
	$lesfichiers = scandir($repertoire);
	$i=0;
	foreach($lesfichiers as $filename){
		$drap = estfichier($filename);
		if($drap) {
			$mat[$i]=$filename; //echo($filename);
			$i++;
		}	
	}
	echo("<table class=\"C100\"><tr bgcolor=\"#000\">");
	for($i=0;$i<count($mat);$i++) echo("<td><font color=\"#FFF\">$mat[$i]</font></td>");
	echo("</tr><tr>");
	for($i=0;$i<count($mat);$i++) {
		echo("<td>");
		$repertoire = "./files/$classe/$mat[$i]";
		$lesfichiers = scandir($repertoire);
		foreach($lesfichiers as $filename){
			$drap = estfichier($filename);
			if($drap) {
				$part = explode(".", $filename);
				$newfilename = "_$part[0].png";
				$link = "<a href=\"./epreuve.php?mat=$mat[$i]&epr=$filename\">";
				echo("$link<img src=\"$repertoire/$newfilename\"/ width=\"100%\"></a> <br/> $filename<br/>");
			}
		}
		echo("</td>");
	}
	

	echo("</tr>");
	echo("</table>");

?>		
		
		</table>
	</body>
</html>