<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img3/eycon.jpg" /></center>
<p>Dans ce TP vous aller utiliser un superviseur Eycon 10, un appareil qui se programme avec Lintools, logiciel que vous utiliserez pleinement en CIRA 2.</p>
<p>Pour la mise en service et les dernières questions, veuillez consulter la documentation sur <a href="Eycon%2010.php" target="_blank">l'EYCON 10</a>.</p>
<p>L'Eycon est programmé afin de simuler un procédé (process), ce qui vous permets de travailler sans maquette réelle.</p>


<h1>I. Boucle de régulation</h1>
<ol>
	<li>Trouver l'entrée et la sortie du procédé. On donnera la méthode utilisée.</li>
	<li>Déterminer le modèle de Broïda de votre procédé. Fournir l'enregistrement obtenu avec toutes les constructions nécessaires à l'identification.</li>
	<li>Donner l'équation H(p) de votre modèle.</li>
	<li>Déterminer les réglages de votre régulateur (Xp, Ti et Td).</li>
	<li>Donner alors la fonction de transfert C(p).</li>
	<li>Mesurer les performances de votre réglage. Tous les calculs et constructions devront apparaître sur l'enregistrement utilisé. (temps de réponse à ±5%, 
	erreur statique et dépassement).</li>
</ol>


<h1>II. Supervision</h1>
<ol>
	<li>Activer la licence temporaire en vous aidant de la documentation sur <a href="./Intouch.php" target="_blank">Intouch</a>.</li>
	<li>Réaliser la programmation du superviseur en respectant le synopsis ci-dessous. On devra pouvoir contrôler la commande, la consigne et le mode de fonctionnement par l'intermédiaire d'Intouch. La mesure s'affichera en temps réel.</li>
	<p><img src="img5/vision_01.jpg"/></p>
	<li>Modifier votre synopsis pour y ajouter un voyant d'alarme haute. Le voyant sera de couleur rouge si la mesure est supérieure à 50%, vert sinon.</li>
	<p><img src="img5/vision_02.jpg"/></p>
</ol>

<?php

	include("./Settings/bas.php");
?>	
