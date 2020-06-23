<?php
	include("../head1grey.html");
?>		
		
		<title>BTS CIRA Rouvi&egrave;re</title>
		<script type="text/javascript">
			function login(){
				classe = document.getElementById('classe').value;
				document.cookie = 'laclasse='+classe;
				nom = document.getElementById('nom').value;
				document.cookie = 'elv='+nom;
				motdepasse = document.getElementById('motdepasse').value;
				document.cookie = 'password='+motdepasse;
				location.reload() ;
			}
			
		</script>
		
	</head>
	<body>
		<center>
<center>

<?php
	include("./lesvariables.php");
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe = "CIRA1";
?>


<table><tr><td><p class="titre">Cahier de texte des <?php echo($classe);?></p></td></tr></table>

<?php
	$filename_cahier = "./files/$classe/_Cahier.txt";

	function number2($nombre){
		if($nombre<10) $resultat = "0$nombre";
		else $resultat = "$nombre";
		return $resultat;
	}

	if(!file_exists($filename_cahier)){
		$fp=fopen($filename_cahier, "w");
		fprintf($fp, "<td colspan=\"3\"><h2>Cahier de texte des $classe</h2></td>");
		fprintf($fp, "\n<td width=\"50px\"><b>Jour</b></td><td width=\"50px\"><b>Mois</b></td><td><b>Activit&eacute;s</b></td>");
		fclose($fp);
	}
	
	$tableau = "<table>";
	$fp = fopen($filename_cahier, "r");
	$ligne00 = fgets($fp);
	//$tableau .= "<tr>$ligne00</tr>";
	$ligne00 = fgets($fp);
	$tableau .= "<tr class=\"jaune\">$ligne00</tr>";
	
	
	//Figure de la progression Octobre 2017
	$figure = "./files/$classe/_$classe.svg";
	if(file_exists($figure)) echo("<a href=\"$figure\" target=\"_blank\"><img src=\"$figure\" width=\"790px\"/></a>");

	
	$i=0;
	while(!feof($fp)){
		$ligne12[$i] = fgets($fp);
		$i++; 
	}
	fclose($fp);
	
	$get_action = isset($_GET['action'])?$_GET['action']:"";
	if($get_action==1){
		$data1 = $_POST['jour'];
		$data2 = $_POST['mois'];
		$data3 = $_POST['texte'];
		if($data2<8) $codedate="2$data2$data1";
		else $codedate="1$data2$data1";
		$ligne12[$i]="<td><input type=\"hidden\" value=\"$codedate\">$data1</td><td>$data2</td><td>$data3</td>"; 
		
		
		$fp = fopen($filename_cahier, "a");
		fprintf($fp, "\n$ligne12[$i]");
		fclose($fp);
		
		$i++;
	}
	
	
	
	sort($ligne12);
	for($j=$i-1;$j>-1;$j--) $tableau .= "<tr>$ligne12[$j]</tr>";
	
	
	$tableau .= "</table>";
	
	
	echo($tableau);
?>
</center>
<?php include("../foot2.html");?>