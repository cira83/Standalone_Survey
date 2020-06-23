<?php
	$classe = $_COOKIE["laclasse"];
	$password = $_COOKIE["password"];
	$filename = "./files/$classe/_Profils.txt";
	include("./lesvariables.php");
	$color = "";
	
	function age($date){
		$nombre = explode("/", $date);
		$nombre_2 = isset($nombre[2])?$nombre[2]:0; 
		$age = date("Y")-$nombre_2;
		
		return $age;
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
		<link rel="icon" type="image/jpg" href="./icon/favicon.jpg">
		<title>Liste des <?php echo($classe);?></title>
	<style type="text/css"></style></head>
	<body>
		<center><h1><?php echo("<a href=\"./appel.php\">$classe</a>");?></h1></center>
		<table class="C100">
<?php
	$fp = fopen($filename, "r");
	$i = 1;
	while(!feof($fp)){
		$fline = fgets($fp);
		$info = explode(":", $fline);
		
		if($color!="#fff") {
			$color="#fff";
		} 
		else {
			$color="#ddd";
		}
		
		
		$file_photo = "./files/$classe/_Photos/$info[0].jpg";
		if(!file_exists($file_photo)) $file_photo = "./photos/----.jpg";
		
		if($info[11]=="oui") {
			$info[11]="Marine";
			$marine_color = "#2a93d2";
		}
		else {
			$info[11]="-----";
			$marine_color = "#aa7942";
		}
		$age = age($info[2]);
		
		$fiche_info = "./files/$classe/_Candidatures/$info[0].pdf";
		if(file_exists($fiche_info)) $candidature = "<a href=\"$fiche_info\"><img src=\"./icon/quest.gif\" height=\"20px\"></a>";
		else $candidature = "??";
		$M_NOM = strtoupper($info[0]);//pour mettre en majuscule
		echo("<tr bgcolor=\"$color\">");
		echo("<td width=\"10px\">$i</td><td><a href=\"./eleve.php?nom=$info[0]\"><img src=\"$file_photo\" title=\".files/$classe/_Photos/$info[0].jpg\" height=\"40px\" style=\"border:solid 4px $marine_color;\"></a>");
		echo("</td><td>$M_NOM $info[1]</td><td>$info[2] (<font color=\"blue\"><b>$age</b></font>)</td>");
		echo("<td>$candidature</td>");
		echo("<td><font color=\"$color\">$info[3]</font></td><td>$info[4]</td><td><a href=\"mailto:$info[5]\">$info[5]</a></td><td>$info[6]</td><td>$info[13]</td><td>$info[7]</td>");
		echo("</tr>");
		$i++;
	}
	
	fclose($fp);
?>		
		
		</table>
		<center><p>* Délégué(e) de classe - ⅓ Tiers Temps</p></center>
	</body>
</html>