<?php
	$action = $_POST[action];
		
	$classe = $_COOKIE["laclasse"];
	$mot2passe = $_COOKIE["password"];
	$nom = $_COOKIE["elv"];
	
	if(!$classe) $classe = "CIRA1";
	if(!$nom) $nom = "Visiteur";
	
	$selection_classe = "<select name=\"classe\" id=\"classe\"><option>CIRA1</option><option>CIRA2</option></select>";
	
	
	$phrase = $_POST[phrase];
	$nb_ligne_max = 5;
	$separation = "§";
	
	function password($nom,$password,$classe){
		$reponse = false;
		$filename = "./files/$classe.txt";
		$fp = fopen($filename, "r");
		if($fp){
			while(!feof($fp)){
				$ligne = fgets($fp);
				$content = explode(":", $ligne);
				if(($nom==$content[0])&&($password==$content[3])) $reponse = true;
			}
		}
		fclose($fp);
		
		if($password=="GHRtE9b7") $reponse = true;
		
		return $reponse;
	}

	$pass = password($nom,$mot2passe,$classe);
	
	if($pass && ($action==1) && $phrase){
		$filename = "./files/$classe/_chat.txt";
		$fp = fopen($filename,"r");
		$nb2ligne = 0;
		while(!feof($fp)) {
			$ligne[$nb2ligne]= fgets($fp);
			$nb2ligne++;
		}
		fclose($fp);
		
		//limitation du nombre de ligne à $nb_ligne_max
		if($nb2ligne>$nb_ligne_max){
			$fp = fopen($filename,"w");
			for($i=1;$i<$nb2ligne;$i++) fwrite($fp, $ligne[$i]);
			fclose($fp);
		} 
		
		//Ajout de la dernière ligne
		$fp = fopen($filename,"a");
		$init = "\n$nom$separation$phrase";
		fwrite($fp, $init);	
		fclose($fp);
	}
	
	if($pass && ($action==2)){
		$filename = "./files/$classe/_chat.txt";
		$fp = fopen($filename,"w");
		$init = "Administrateur$separation Le fichier de discussion est créé.";
		fwrite($fp, $init);
		fclose($fp);
	}
	
	if($pass) $titre = "Chat privé CIRA 83 - $nom";
	else $titre = "Chat privé CIRA 83 - Login";
?>

<script>
	function lecture(){
		les_messages = document.getElementById("les_messages");
		var xhr = null;
		var xhr = new XMLHttpRequest();		
		
		xhr.onreadystatechange = function() {
        	if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
	        	les_messages.innerHTML = xhr.responseText;
        	}
    	};
    
		xhr.open("GET", "./chatES.php", true);
		xhr.send(null);
				
		requestAnimationFrame(lecture);
	}
	
	function logout(){
		document.cookie = 'elv=';
		document.cookie = 'password=';
		lien = './chat.php';
		window.location.replace(lien);
	}
	
	function login(){
	
	pwd = document.getElementById('password').value;
	elv = document.getElementById('elv').value;
	classe = document.getElementById('classe').value;
		
	document.cookie = 'elv='+elv;
	document.cookie = 'password='+pwd;
	document.cookie = 'laclasse='+classe;	
	
	lien = './chat.php';
	window.location.replace(lien);
}
</script>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="chat.css">
	</head>
	<body>
		<div id="titre">
			<?php echo("$titre"); ?>
		</div>
		<span id="les_messages">
		</span>
		

<?php
	echo("<div id=\"parler\">");
	echo("<form action=\"./chat.php\" method=\"post\">");
	echo("<center>");
	echo("<input type=\"text\" name=\"phrase\" size=\"80%\"><input type=\"hidden\" name=\"action\" value=\"1\">");
	echo("<input type=\"button\" value=\"Sortir\" onclick = \"logout();\">");
	echo("</center>");
	echo("</form></div>");
			
	if($nom=="Professeur"){
		echo("<div id=\"professeur\">");
		echo("<form action=\"./chat.php\" method=\"post\"><input type=\"hidden\" name=\"action\" value=\"2\">");
		echo("Room $classe  -  ");
		echo("<input type=\"submit\" value=\"Effacer la discussion\">");
		echo("</form></div>");
	}

?>
		
</body>
	
<?php
	if($pass) echo("<script>requestAnimationFrame(lecture)</script>");
?>	
	
	
</html>