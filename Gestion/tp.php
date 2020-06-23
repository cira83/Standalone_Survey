<?php
	include("../head1grey.html");
	include("../Dropbox.php");
	include("DSFonctions.php");

	if($_COOKIE["laclasse"]) $classe = $_COOKIE["laclasse"];
	else $classe = "CIRA1";

	if($_COOKIE["nom"]) $elv = $_COOKIE["nom"];

	if($B800) echo("<title>B800 - TP $classe</title>");
	else echo("<title>TP $classe</title>");
?>
<!-- fin head -->
<title>TP <?php echo($classe);?></title>
	</head>
	<body>
		<center>
		<table><tr><td><p class="titre">Sujets <?php echo("$classe - $elv");?></p></td></tr></table>

<?php

	Dropbox_link2("./files/$classe/_Sujets2TP/liste.txt",$elv,$classe);//Liste des documents nom,adresse web


	include("../foot2.html");
?>
