<?php
	$classe = $_COOKIE["laclasse"];
	$password = $_COOKIE["password"];
	$filename = $_GET[file];
	include("./lesvariables.php");
	
	
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles.css">
		<link rel="icon" type="image/jpg" href="./icon/favicon.jpg">
		<title>Liste des <?php echo($classe);?></title>
	<style type="text/css"></style></head>
	<body>
		<center><h1><?php echo("Export vers Pi");?></h1></center>
<?php
	echo("<p>Fichier à téléverser sur Pi : $filename");
	
	$ftp_server="192.168.0.25"; 
	$ftp_user_name="pi"; 
	$ftp_user_pass="Waterloo"; 
	$file = $filename;//tobe uploaded 
	$remote_file = $filename; 

	// set up basic connection 
	$conn_id = ftp_connect($ftp_server,21,10); //resource ftp_connect ( string $host [, int $port = 21 [, int $timeout = 90 ]] )
	if(!$conn_id) echo("<p>Connection impossible !!</p>");
	
	
	// login with username and password 
	//$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("<h2>$ftp_user_name ($ftp_user_pass), you do not have access to this ftp server $ftp_server !</h2>");


	
	// close the connection 
	ftp_close($conn_id); 
	
	
?>
	</body>
</html>