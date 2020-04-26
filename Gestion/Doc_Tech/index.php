<?php
	include("../../head2.html");
?>	
<!-- fin head -->
<title>BTS CIRA Rouvi&egrave;re</title>
	</head>
	<body>
		<img src="../../head.png"/>
		<table><tr><td><p class="titre">Documentation CIRA2</p></td></tr></table>

<?php

		$repertoire = "./."; 	
		$ListFiles = scandir($repertoire);
		sort($ListFiles);
		$i=0;
		$k=1;
		echo("<ul>");
		while ( $i < count($ListFiles))
  		{
       		$file = $ListFiles[$i];
			$array=explode('.',$file);
			$extension=$array[1];
       		if(($extension=="pdf")||($extension=="php"))
        	{
            	if($array[0]!="index")
            	{
            		echo("<li><a href=\"$repertoire/$file\" target=\"_blank\"class=\"no-under\">");
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

