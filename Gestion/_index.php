<?php
	
	$files = "./files/";
	$classe = $_COOKIE["laclasse"]; 
	$password = $_COOKIE["password"];
	$nom = $_COOKIE["elv"];
	$action = $_GET[action];
	
	
	if(!file_exists("$files$classe.txt")) {
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
	}
	$repertoire_copies =  "./files/$classe/_Copies";
	
	//Accés aux données pour le professeur
	$getnom = $_GET[nomelv];
	if($getnom!="") {
		$nom=$getnom;
		$_COOKIE["elv"] = $nom;
	}
	
	
	include("./lesfonctions.php");
	
	
	
	if($action==4){
		$fp = fopen($logindeseleves, "a");
		$ip_candidat = "<a href=\"http://fr.geoipview.com/?q=$ip_candidat&x=0&y=0\">$ip_candidat</a>";
		if(password($nom,$password,$classe)){
			fwrite($fp, "\n<td>$nom [$ip_candidat]</td><td>$date_heure</td>");
		}else {
			fwrite($fp, "\n<td>$nom ? [$ip_candidat]</td><td>$date_heure</td>");
		}
		
		fclose($fp);		
	}
?>

<script type="text/javascript" src="./routes.js"></script>

<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119274440-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-119274440-1');
		</script>
		<!-- End -->
		
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
	</head>
<body>
<center>

<?php
	
	if(!file_exists($logindeseleves)) {
		$fp = fopen($logindeseleves, "w");
		fwrite($fp, "Login des eleves");
		fclose($fp);
	}
	
	if(password($nom,$password,$classe)) {
		$passwordOK = true;
		echo("<table class=\"Px400G\">");
		echo("<tr><td>$classe</td>");
		echo("<td><font color=\"#000000\" size=\"+1\">$nom</font></td>");
		echo("<td><input type=\"button\" value=\"Logout\" onclick=\"logout();\"></td>");
	}else {
			$passwordOK = false;
			echo("<table class=\"Px400\">");
			echo("<tr ><td>$listedesclasses</td>");
			echo("<td>$deroulant3</td>");
			echo("\n<td><input type=\"password\" name=\"password\" id=\"password\" size=\"10\" value=\"$password\"></td>");
			echo("\n<td><input type=\"hidden\" name=\"hidden\" id=\"hidden\" value=\"$classe\">");
			echo("\n<input type=\"button\" value=\"Login\" onclick=\"login2();\"></td>");
			
	}
	echo("</tr></table>");


	$contact = "<tr><td><A HREF=\"mailto:patgat@gmail.com\">Me contacter</a></td>";
	$contact .="<td><a href=\"./chat.php\"><img src=\"./icon/chat.png\"/></a></td>";
	$contact .= "<tr>";

?>

<img src="./img/puzzle.png" usemap="#map1"/>
<map name="map1">
<area shape="rect" coords="0,0,200,200" href="./documents.php?nomelv=<?php echo("$nom"); ?>">
<area shape="rect" coords="200,0,400,200" href="./info4elv.php?nomelv=<?php echo("$nom"); ?>">
<area shape="rect" coords="0,200,200,400" href="./cahier4elv.php">
<area shape="rect" coords="200,200,400,400" href="./tests.php?nomelv=<?php echo("$nom"); ?>">
</map>

<?php 
	if($passwordOK) echo("<table class=\"Px400GP\">");
	else echo("<table class=\"Px400P\">");
?>
<?php 
	if($passwordOK) echo($contact);
	else echo("<tr><td onclick=\"direction(6);\">Accueil</td><tr>");
?>
</tr></table>
</center>
</body>
</html>