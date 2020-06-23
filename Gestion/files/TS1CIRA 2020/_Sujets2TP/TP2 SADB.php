<?php 
	include("./Settings/haut.php");
?>
<img src="img2/03.gif"/>

<h1>I. Caractéristiques statiques</h1>
<ol>
	<li>Donner et réaliser le câblage pneumatique définie sur le schéma TI ci-dessus.</li>
	<li>Expliquer le principe de fonctionnement du capteur FT1.<a href="../../../doclasse.php" class="no-under" target="_blank">On s'aidera de la documentation disponible.</a></li>
	<li>Expliquer le fonctionnement du capteur FT2.</li>
	<li>Donner et procéder au câblage électrique des deux capteurs sur les entrées 1 et 2 du régulateur. (FT1 sur entrée 1, FT2 sur entrée 2)</li>
	<li>Ouvrir la vanne de réglage FV1 au maximum. Régler FV2, pour que le débit maximal soit mesurable par les deux capteurs. On donnera la valeur de ce débit en Nm<sup>3</sup>/h.</li>

	<li>Relever la mesure de débit en fonction de la commande de la vanne, pour le capteur FT1.</li>
	<li>Même question pour le capteur FT2.</li>
	<li>Tracer les deux caractéristiques sur le même graphique.</li>
	<li>Quelle caractéristique est la plus linéaire ?</li>
	
</ol>


<h1>II. Régulation proportionnelle</h1>
<ol>
	<li>Procéder au réglage du régulateur pour un fonctionnement en régulation proportionnelle. La consigne sera égale à la moitié du débit maximum. On utilisera FT2 comme capteur. Expliquer comment vous avez procédé.</li>
	<li>Déterminer la valeur XP<sub>0</sub> de la bande proportionnelle pour un fonctionnement en limite de stabilité.</li>
	<li>Relever la réponse indicielle du système pour les valeurs suivantes de la bande proportionnelle.</li>
	<ul>
		<li>XP<sub>10</sub> = 10 XP<sub>0</sub></li>
		<li>XP<sub>5</sub> = 5 XP<sub>0</sub></li>
		<li>XP<sub>2</sub> = 2 XP<sub>0</sub></li>
		<li>XP<sub>1</sub> = 1,5 XP<sub>0</sub></li>
	</ul>
	<li>Pour chacune des bande proportionnelles, relever la valeur de l'erreur statique.</li>
	<li>Pour chacune des bande proportionnelles, relever le temps de réponse à 10 %.</li>
	<li>Pour chacune des bande proportionnelles, relever la valeur du dépassement.</li>
	<li>Conclure sur l'influence de la bande proportionnelle sur les trois critères d'une régulation ; la précision, la vitesse et la stabilité.</li>
</ol>

<h1>III. Comparaison des deux capteurs</h1>
<ol>
	<li>Déterminer le réglage de la bande proportionnelle pour un fonctionnement optimal (temps de réponse à 10 % le plus court possible), en utilisant le capteur FT1.</li>
	<li>Donner la courbe obtenue ainsi que le temps de réponse.</li>
	<li>Déterminer le réglage de la bande proportionnelle pour un fonctionnement optimal (temps de réponse à 10 % le plus court possible), en utilisant le capteur FT2.</li>
	<li>Donner la courbe obtenue ainsi que le temps de réponse.</li>
	<li>Quel capteur vous parait le plus performant pour un fonctionnement en régulation de débit proportionnelle ? Justifier votre réponse.</li>
</ol>

<?php

	include("./Settings/bas.php");
?>	
