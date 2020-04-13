<?php
/* On stop la session AVANT d'écrire du code HTML*/ session_start();
	session_destroy();
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
	menutab($numero,"Aide");
?>



<?php 	include("./Setting/footer.php");?>