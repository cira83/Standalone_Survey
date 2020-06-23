<?php 
	include("./Settings/haut.php");
?>
<h1>Raccourcis</h1>
<ul>
	<li><a href="#reseau" class="no-under">Réseau</a></li>
	<li><a href="#Programmation" class="no-under">Programmation</a></li>
</ul>


<h1 id="reseau">Réseau</h1>
<h2>Câblage</h2>
<p>Avant d’utiliser votre maquette, vous devez câbler votre réseau Ethernet. Ce réseau utilisera :</p>
<ul>
	<li>Un routeur Netgear ;</li>
	<li>Un ordinateur ;</li>
	<li>Un Eycon 10.</li>
</ul>
<img src="Eycon/01.gif">
<p><u>Remarques :</u></p>
<ul>
	<li>La prise mural se branche sur le port le plus à gauche du routeur ;</li>
	<li>En CIRA 1 on n’utilise pas de T2550 ;</li>
	<li>Il faut alimenter le routeur.</li>
</ul>
<h2>Vérification</h2>
<p>On peut à présent parcourir les réseaux Eurotherm en double cliquant sur l’icône ci-contre qui est sur le bureau de Windows :</p>
<img src="Eycon/02.gif">
<img src="Eycon/03.gif">

<h1 id="Programmation">Programmation</h1>
<p>Ouvrir le fichier TP3CIRA1 qui se trouve sur le bureau. Vous êtes en présence du projet qui a été programmé pour vous :</p>
<img src="Eycon/04.gif">
<p>Sélectionner EYCON-10_01, comme sur la figure ci-avant, puis appuyer sur le grand L pour lancer le programme d’édition de la base de donnée de l’Eycon.</p>
<img src="Eycon/05.gif" width="700px">
<p>La base de donnée de l’EYCON ne contient qu’un bloc PID et un simulateur de process. Vous pouvez voir les paramètres de ces éléments en cliquant dessus.</p>
<p>Transférer le programme en cliquant sur Download. Répondre Oui à toutes les questions.</p>
<p>Sur la droite, la petite icône bleue nommée EYCON est l’affichage de votre superviseur. En double cliquant dessus, vous allez ouvrir son éditeur.</p>
<img src="Eycon/06.gif" width="700px">
<p>En double-cliquant sur Page1 (ID01), vous verrez la première page de l’Eycon.</p>
<img src="Eycon/07.gif" width="700px">
<p>Pour visualiser les éléments de la base, lancer OPCScope dans le menu de Lintools :</p>
<img src="Eycon/08.gif" width="700px">
<p>Après avoir cliqué sur l’ampoule pour vous connecter au réseau ELIN, vous pourrez voir toutes les valeurs de la base de données de l’Eycon.</p>
<img src="Eycon/09.gif" width="700px">





<!-- 
	<img src="Intouch/31.gif" width="800px">
-->
<?php

	include("./Settings/bas.php");
?>	