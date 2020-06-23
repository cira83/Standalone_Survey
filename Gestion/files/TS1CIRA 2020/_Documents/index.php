<?php
	include("../../../../head4.html");
	include("../../../../Dropbox.php");
	
	$nom=$_SERVER['SCRIPT_NAME'];
	$txt = explode("/",$nom);
	$k = count($txt);
	$j = explode(".",$txt[$k-1]);
	if($titre=="") 
	{
		$titre=$j[0];
		$titre1=$txt[$k-3];
		$titre2=$j[0];
	}	
?>	
<!-- fin head -->
<title>Documents <?php echo($titre1);?></title>
	</head>
	<body>
		<img src="../../../../head.png"/>
		<table><tr><td><p class="titre">Documents <?php echo($titre1);?></p></td></tr></table>

<?php

	Dropbox("","./Setting/Documents.txt");//Liste des documents nom,adresse web	

	$repertoire = "./."; 	
	$ListFiles = scandir($repertoire);
	sort($ListFiles);
	$i=0;
	$k=1;
	echo("<ul>");
	while ( $i < count($ListFiles)){
       	$file = $ListFiles[$i];
		$array=explode('.',$file);
		$extension=$array[1];
       	if(($extension=="pdf")||($extension=="php")||($extension=="jpg")){
            if($array[0]!="index"){
            	echo("<li><a href=\"$repertoire/$file\" target=\"_blank\" class=\"annales\">");
				echo($array[0]);
				echo("</a></li>");
			}
            $k++;
    	}
    	$i++;
	}
	echo("</ul>");

	include("../../foot2.html");
?>	

