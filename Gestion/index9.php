<?php
	//Liste des logiciels disponibles sur la clef
	include("./security.php");
	include("../head1.html");
	if($password_OK) echo("<title>$classe - $elv</title>");
	else echo("<title>$classe</title>");
?>
</head>
<body>
  <img src="head.png"/>

<?php
  	$class_cook = $_COOKIE["laclasse"];

  	if($class_cook) echo("<table><tr><td><p class=\"titre\">$class_cook - Logiciels</p></td></tr></table>");
  	else echo("<table><tr><td><p class=\"titre\">Pour mes élèves</p></td></tr></table>");
?>
<center>
<p class="liste">Pour tracer des courbes : <a href="../EasyGraph" class="no-under" target="_blank" >EasyGraph</a></p>
<p class="liste">Editeur d'images : <a href="../tui.image-editor" class="no-under" target="_blank" >Tui.image-editor</a></p>
<p class="liste">Pour les fonctions de transfert : <a href="../EasyRegPhp" class="no-under" target="_blank" >EasyReg</a></p>
<p class="liste">Simulation d'un process : <a href="../Process4" class="no-under" target="_blank" >Process 4</a></p>
</center>

<?php
	include("../foot2.html");
?>
