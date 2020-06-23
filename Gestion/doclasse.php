<?php
	include("../head1grey.html");
	include("DSFonctions.php");
	include("lespetitesfonctions.php");
	include("../Dropbox.php");

	if($_COOKIE["laclasse"]) $classe = $_COOKIE["laclasse"];
	else $classe = "CIRA1";
	
	if(file_exists("../B800")) echo("<title>B800 - Documents $classe</title>");
	else echo("<title>Documents $classe</title>");
?>	
<!-- fin head -->
	</head>
	<body>
		<center>
		<table><tr><td><p class="titre">Documents <?php echo($classe);?></p></td></tr></table>

<?php

	if(file_exists("../B800")) Dropbox("","./files/$classe/_Documents/B800_Documents.txt");//Liste des documents nom,adresse web	
	else Dropbox("","./files/$classe/_Documents/Documents.txt"); 


	include("../foot2.html");
?>	

