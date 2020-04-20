<?php
	include("./security.php");
	include("../head1.html");
	
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
		<img src="head.png"/>
<center>
	
<?php
	$nom = $elv;
	$password = $password;
	$classe = $classe;
	$files = "./files/";
	$repertoire_copies =  "./files/$classe/_Copies";
	
	include("./lesfonctions.php");
	
	if($password_OK){
		echo("<table><tr><td colspan=2><p class=\"titre\">Les notes de $nom</p></td></tr></table>");
		include("./eleve4all.php");
	}
	else{
		echo("<td colspan=2>Vous n'&ecirc;tes pas connect&eacute;(e) !!</td>$logout</tr></table>");
	}

?>
</center>
<?php
	include("../foot2.html");
?>	