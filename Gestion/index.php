<?php
	$classe = isset($_COOKIE['laclasse'])?$_COOKIE['laclasse']:"CIRA";
	$nomelv = isset($_COOKIE['nom'])?$_COOKIE['nom']:"";
	
	include("../head1.html");
	echo("<title>$classe</title>");
	

	function estrep2($nom){// Fichier ou non ?
		$drap = true;
		$data = explode(".", $nom);
		if($data[0]=="") $drap = false;
		if($nom[0]=="_") $drap = false;
		if($nom=="index.htm") $drap = false; //Nom du fichier questionnaire
		if($nom=="rep") $drap = false; //Nom du répertoire des réponse au questionnaire

		return($drap);
	}
	
	function les_classes(){
		$repertoire = "./files";
		$classes = scandir($repertoire);
		sort($classes);
		$i=0;
		foreach($classes as $classe) {
			if(estrep2($classe)){
				$part = explode(".", $classe);
				if(count($part)==1) {
					if($i) $classe_text .= ":$part[0]";
					else $classe_text = "$part[0]";
					$i++;
				}
			}
		}
		return $classe_text;
	}
	
	//Partie connexion sécurisé - V00
	$classe_text = les_classes();// echo($classe_text);
	$classe_dispo = explode(":", $classe_text);
	$repertoire = "./files/";


	//MENU DEROULANT CLASSES        -----------------------------------------------------------------------------------------------------
	$select_classe = "<select name=\"classe\" id=\"classe\" onchange=\"cira();\">";
	$select_classe .= "<option>Selectionner votre classe</option>";
	foreach($classe_dispo as $classe14){
		if($classe==$classe14) $select_classe .= "<option selected>$classe14</option>";
		else $select_classe .= "<option>$classe14</option>";

	}
	$select_classe .= "</select>";
	$submit = "<input type=\"submit\" value=\"Login\" onclick=\"login();\">\n";

	//MENU DEROULANT ELEVES        ------------------------------------------------------------------------------------------------------
	$select_elv = "<select name=\"nom\" id=\"nom\">\n";
	$fichieralire = "$repertoire$classe/_Profils.txt";
	if(file_exists($fichieralire)){
		$fp = fopen($fichieralire, "r");
		while(!feof($fp)){
			$ligne = fgets($fp);
			$part = explode(":", $ligne);
			if($part[0]==$nomelv) $select_elv .= "<option selected>$part[0]</option>\n";
			else $select_elv .= "<option>$part[0]</option>\n";
		}
		fclose($fp);
	}
	else echo("$fichieralire n'existe pas !!");
	$select_elv .= "</select>";

	$password_in = "<input type=\"password\" name=\"password\" id=\"password\" autocomplete=\"on\">";
	//$invite = "<form autocomplete=\"on\">\n";
	$invite = "<table><tr><td align=\"left\">$select_classe $select_elv $password_in</td><td align=\"right\">$submit</td></tr></table>";
	//$invite .= "</form>\n";



?>
	<script type="text/javascript">
		function cira(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe+"; path=/; expires="+date.toUTCString();
			location.reload() ;
		}

		function init(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			classe = document.getElementById('classe').value;
			document.cookie = 'laclasse='+classe+"; path=/; expires="+date.toUTCString();
		}

		function passvite(){
			var request = new XMLHttpRequest();
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			
			request.open('GET', "./validMdP.php");
			request.responseType = 'text';
				
			request.onload = function() {
				data = request.response;
				if(data==1) {//login élève ok
					message.innerHTML = '<font color="#00ff00">Bon mot de passe</font>';
					window.location.replace('./index7.php');
				}
				if(data==2) {// login prof
					message.innerHTML = '<font color="#00ff00">Bon mot de passe</font>';
					document.cookie = 'nom=Professeur; path=/; expires='+date.toUTCString();
					window.location.replace('./appel.php');
				}
			};	
				
			request.send();
		} 

		function login(){
			var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
			nomelv = document.getElementById('nom').value;
			mot2passe = document.getElementById('password').value;
			message = document.getElementById('message');

			document.cookie = 'password='+ mot2passe +'; path=/; expires='+date.toUTCString();
			document.cookie = 'nom='+ nomelv +'; path=/; expires='+date.toUTCString();
							
			location.reload() ;
		}

	</script>

	</head>
	<body onload="passvite();">
		<img src="head.png"/>


<?php
	echo("<table><tr><td><p class=\"titre\">$classe - Login</p></td></tr></table>");
	echo("<br>$invite");
	echo("<br><center><div id=\"message\"></div></center>");

	include("../foot1.html");
?>
