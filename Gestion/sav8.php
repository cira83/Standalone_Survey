<?php
	include("./security.php");
	include("../head1.html");
?>		
	<title>SAUVEGARDE</title>
	<script type="text/javascript">
	function login(){
		classe = document.getElementById('classe').value;
		document.cookie = 'laclasse='+classe;
		location.reload() ;
	}
	</script>
		
	</head>
	<body>
		<img src="head.png"/>
		<table><tr><td><p class="titre">Fichier(s) Sauvegardé(s)</p></td></tr></table>

<!-- Liste des fichiers sauvegardés -->
<?php
	$repertoire_TP = "../sav/TP/"; 	
	$ListFiles = scandir($repertoire_TP);
	sort($ListFiles);
	$i=0;
	$k=1;
	$nbfichier=0;
	echo("<p class=\"jaune\">");
	while ( $i < count($ListFiles)){
       	$file = $ListFiles[$i];
		$array=explode('.',$file);
		$extension=$array[1];
        if(($array[1]!="php")&&($array[1]!="")){
			echo($array[0].".".$array[1]);
			echo("<br/>");
			$nbfichier++;
    	}
    	$i++;
	}
	echo("</p><p>$nbfichier fichier(s) sauvegard&eacute;(s) </p>");
	
?>

<?php 
	$chemin = $repertoire_TP;
	if($password_OK) include("./sav8_form.php"); 
?>

<?php
	include("../foot2.html");
?>	



