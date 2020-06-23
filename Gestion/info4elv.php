<?php
	//include("./security.php");
	include("../head1grey.html");
	include("./lesfonctions.php");
	echo("<title>NOTES $elv</title>");
?>		
	<script type="text/javascript">
	function login(){
		classe = document.getElementById('classe').value;
		document.cookie = 'laclasse='+classe;
		location.reload() ;
	}
	</script>
		
	</head>
	<body>
<center>
	
<?php
	$nom = $elv;
	$password = $password;
	$classe = $classe;
	$files = "./files/";
	$repertoire_copies =  "./files/$classe/_Copies";
	
	
	
	if($password_OK){
		echo("<table><tr><td colspan=2><p class=\"titre\">Les notes de $nom</p></td></tr></table>");
		include("./eleve4all.php");
	}
	else{
		echo("<td colspan=2>Vous n'êtes pas connecté(e) !!</td>$logout</tr></table>");
	}

	include("../foot2.html");
?>	