<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
$numero = session_id();//Numero des fichiers
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>EasyReg PHP</title>
<link href="./style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<div id="entete"><table ><tr align=center><td><font size="+3">EASYREG</font></td></tr></table></div>
<?php
	include("./menutab.php");
	menutab($numero,"propos");		
?>

<table>
<tr><td>
<center>
<p class="centre">Version 1.1</p>
<p class="titre">EASYREG PHP</p>
<p class="centre">Copyright Patrick Gatt<br/>
cira@numericable.fr<br/>
http://cira83.com	
</p>
</center>
</td></tr></table>

<?php 	include("./Setting/footer.php");?>