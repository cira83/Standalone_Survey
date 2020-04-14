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
<?php
	$classe = $_COOKIE["laclasse"];
	if(!$classe) $classe="CIRA1";
	
	$separation = "§";

	function bulle($acteur,$paroles){
		$bulle = "<div class=\"bulles\">";
		$bulle .= "<h1>$acteur</h1>";
		$bulle .= "$paroles";
		$bulle .= "</div>";
		echo($bulle);
	}

	$filename = "./files/$classe/_chat.txt";
	if(!file_exists($filename)) {
		$fp = fopen($filename,"w");
		$init = "Administrateur$separation Le fichier de discussion est créé.";
		fwrite($fp, $init);			
		fclose($fp);
	}

?>
	<span id="les_messages"></span>
	
	<script>requestAnimationFrame(lecture)</script>