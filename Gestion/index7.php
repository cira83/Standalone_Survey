<?php
	include("./security.php");
	include("../head1.html");
	if($password_OK) echo("<title>$classe - $elv</title>");
	else echo("<title>$classe</title>");
?>
	<script type="text/javascript">
		function login(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe+"; expires="+date.toUTCString();
			location.reload() ;
		}

		function init(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe+"; expires="+date.toUTCString();
		}


	</script>

	</head>
	<body>
		<img src="head.png"/>

<?php
	$sujet2TP="./files/$classe/_Sujets2TP"; //echo($sujet2TP);
	if(!file_exists($sujet2TP)) $sujet2TP="";
	$doc="./files/$classe/_Documents";
	$class_cook = $_COOKIE["laclasse"];

	if($class_cook) echo("<table><tr><td><p class=\"titre\">$class_cook</p></td></tr></table>");
	else echo("<table><tr><td><p class=\"titre\">Pour mes élèves</p></td></tr></table>");
	echo("<br>$invite");
?>

<center>
<?php
	if($password_OK){
	  if($sujet2TP) echo("<p class=\"liste\"><a href=\"./tp.php?elv=$elv\" class=\"no-under\">Sujets de TP</a></p>") ;
		$questionnaire_perso = "$repertoire$classe/_Copies/$elv/rep/index.htm";
		echo("<p class=\"liste\"><a href=\"./index9.php?elv=$elv\" class=\"no-under\">Logiciels disponibles</a></p>") ;
		if(file_exists($questionnaire_perso)) echo("<p class=\"liste\"><a href=\"./devoir.php\" class=\"no-under\" target=\"_blank\">Devoir personnalisé</a></p>");
	}
?>

<!-- En travaux. Revenez plus tard. Merci. -->

<?php
	if($prof_login){
		echo("<hr><h2>Complément Professeur</h2>");
		echo("<p class=\"liste\"><a href=\"DSZone.php\" class=\"no-under\" target=\"_blank\" >Gestion des devoirs</a></p>");

	}
	include("../foot1.html");
?>