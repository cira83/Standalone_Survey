<?php
	session_start();
	include("../../../../head4.html");
	$classe = $_COOKIE["laclasse"];
	
	$nom = $_GET["name"];
	if(!$nom) $nom=$_SERVER['SCRIPT_NAME'];
	
	$txt = explode("/",$nom);
	$k = count($txt);
	$j = explode(".",$txt[$k-1]);
	if($titre=="") 
	{
		$titre=$j[0];
		$titre1=$txt[$k-1];
		$titre2=$j[0];
	}
	
	echo("\n<title>$titre - $classe</title>");
	
	if($_COOKIE["nom"]) $elv = $_COOKIE["nom"];
	else $elv = $_GET["elv"];
	
	function easyreg() {
		echo("<a href=\"./EasyRegPhp\" class=\"no-under\" target=\"_blank\">EasyReg</a>");
	}
	
?>		
	

	</head>
	
	
	<body>
	<img src="../../../../head.png"/>
	<table>
		<tr>
			<td><p class="titre"><?php echo($classe);?></p></td>
			<td><p class="titre"><?php echo($titre);?></p></td>
			<td><p class="titre"><?php echo($elv);?></p></td>
			<td><a href="../../../Ticket.php?sujet=<?php echo("$titre&elv=$elv");?>" target="_blank"><img src="../../../icon/Ticket.png" height="50px"/></a></td>
		</tr>
	</table>
<!--- fin de l'entête - Fichier haut.php-->