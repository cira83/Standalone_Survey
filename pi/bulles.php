<html>
<?php
	$noire_t = "#000000";//noir 
	$violet_t = "#8d1682";//violet 27min
	$rouge_t = "#fd0002";//rouge 9min
	$orange_t = "#ff8b01";//orange 3min
	$jaune_t = "#ffed02";//jaune 1min
	$vert_t = "#02fe00";//vert 20s
	
	$lut = "['$vert_t','$jaune_t','$orange_t','$rouge_t','$violet_t','$noire_t'];";
?>
	
	<head>
		<link rel="icon" type="image/gif" href="../img/LOGO_Flamme.gif" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="../Gestion/styles_sujet.css"  />
		<title>CHAT TP</title>
<script>
	function repondre(){
		memoire = document.getElementById('0');
		reponse = prompt(memoire.textContent,'');
		
		memoire.innerHTML=memoire.innerHTML+'<br> Prof : '+reponse;
	}
	//setInterval(repondre, 5000);
</script>

	</head>
	<body onload="repondre();">
		<table><tr><!-- ENTETE -->
			<td width="50px"><a href="./index.php" title="Pi"><img src="./pi.png" height="25px"></a></td>
			<td align="center"><font size="+2">CHAT ZONE</font></td>
		</tr></table>
		<table><tr><!-- REPONSE -->
			<td id="0">?????</td>
		</tr></table>
	</body>
</html>
