<?php
	include("./security.php");
	include("../head1.html");
?>		
		
	<title>NOTES</title>
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
<center>
	
<?php
	$nom = $_SESSION['nom'];
	$password = $_SESSION['password'];
	$files = "./files/";
	$classe = $_SESSION['laclasse'];
	$repertoire_copies =  "./files/$classe/_Copies";
	
	
	include("./lesfonctions.php");
	
	//if(password($nom,$password,$classe)){
	if($password_OK){
		echo("<table><tr><td colspan=2><p class=\"titre\">Les notes de $nom</p></td></tr></table>");
		if($serveur_name == "B800") include("./eleve4allPi.php");
		else include("./eleve4all.php");
	}
	else{
		echo("<td colspan=2>Vous n'&ecirc;tes pas connect&eacute;(e) !!</td>$logout</tr></table>");
	}
?>
</center>
<?php
	include("../foot2.html");
?>	