<?php
	include("./security.php");
	include("../head1.html");
		
	if($password_OK) echo("<title>$classe - $elv</title>");
	else echo("<title>$classe</title>");
?>
	<script type="text/javascript">
		function logout(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			document.cookie = 'password=none; path=/; expires='+date.toUTCString();
			window.location.replace('./index.php');
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
	
	$le_sujet_perso = "";
	$questionnaire_perso = "$repertoire$classe/_Copies/$elv/rep/index.htm";
	if(file_exists($questionnaire_perso)) {
		$fp_sujet = fopen($questionnaire_perso, "r");
		$premiere_ligne = fgets($fp_sujet);
		$parties = explode("#", $premiere_ligne);
		$le_sujet_perso = "$parties[1] $parties[0]";
	}

	
?>

<center>
<?php
	if($password_OK){
		if($le_sujet_perso) echo("<p class=\"liste\"><a href=\"./devoir.php\" class=\"no-under\">$le_sujet_perso</a></p>");		
	  	echo("<p class=\"liste\"><a href=\"./tp.php?elv=$elv\" class=\"no-under\">Sujets disponibles</a></p>") ;
		echo("<p class=\"liste\"><a href=\"./index9.php?elv=$elv\" class=\"no-under\">Logiciels</a></p>") ;
		echo("<p class=\"liste\"><a href=\"./sav9.php\" class=\"no-under\">Rendre un fichier</a></p>");
		if(!file_exists("../B800")){
			
			echo("<p class=\"liste\"><a href=\"./documents.php\" class=\"no-under\">Mes documents</a></p>");
			echo("<p class=\"liste\"><a href=\"./info4elv.php\" class=\"no-under\">Mes Notes</a></p>");
			echo("<p class=\"liste\"><a href=\"./doclasse.php\" class=\"no-under\">Documents de la classe</a></p>");
			echo("<p class=\"liste\"><a href=\"./cahier4elv.php\" class=\"no-under\">Cahier de texte</a></p>");

		}
	}
?>

<!-- En travaux. Revenez plus tard. Merci. -->

<?php
	if(false){
		echo("<hr><p class=\"liste\"><a href=\"DSZone.php\" class=\"no-under\">Gestion des devoirs</a></p>");
		echo("<p class=\"liste\"><a href=\"appel.php\" class=\"no-under\">Appels</a></p>");
	}
	include("../foot1.html");
?>
