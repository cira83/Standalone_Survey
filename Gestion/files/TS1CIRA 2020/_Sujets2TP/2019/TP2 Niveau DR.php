<?php 
	include("./Settings/haut.php");
?>
<center><p><img src="./img2/niveau_2.jpg" width="55%"></p></center>
<table class="dedans"><tr align="left"><td><font color="lightskyblue"><u>Cahier des charges :</u> On se propose de réaliser une régulation de niveau du réservoir du haut. L'organe de réglage sera la pompe P1. La vanne V2 sera contrôlée manuellement, on devra régler le transmetteur de niveau.</font></td></tr>
</table>

<h1>I. Réglage du transmetteur de niveau</h1>
<ol>
	<li>Rappeler le fonctionnement du transmetteur de niveau.</li>
	<li>Proposer un câblage électrique permettant le fonctionnement de la boucle de régulation et la communication avec un modem Hart. On rappelle qu'une résistance de 250 &Omega; est branchée en parallèle sur l'entrée mesure du régulateur.</li>
	<li>Valider le fonctionnement de la communication avec le transmetteur. On fournira une copie d'écran des réglages du transmetteur.</li>
	<li>Déterminer la position de la vanne qui corresponde à la mesure de pression sur le réservoir du haut. On donnera la procédure.</li>
	<li>Déterminer la valeur de la pression mesurée en kPa pour un niveau L=0%.</li>
	<li>Même question pour un niveau de 80%. </li>
	<li>Compléter alors le graphique suivant :</li>
		<img src="img2/echelle1.jpg" width="700px"/>

	<li>Procéder au réglage du transmetteur pour qu'il affiche la mesure du niveau dans le réservoir supérieur.</li>
	<li>Tracer la caractéristique de votre transmetteur de niveau (mesure en % en fonction du niveau réel en %).</li>
	<li>Quelle est la classe de mesure du capteur de niveau LT (Plus grande erreur possible / Pleine échelle) ?</li>
</ol>

<h1>II. Régulation de niveau</h1>
<ol>
	<li>Procéder au réglage de votre maquette pour que le niveau se stabilise à 50% pour une commande de 10 mA.</li>
	<li>Régler le régulateur pour un fonctionnement en régulation proportionnelle avec un gain A=5 et un décalage de bande Y<sub>0</sub>=0%.</li>
	<li>Relever la réponse indicielle pour une consigne passant de 40% à 50%.</li>
	<li>Donner alors la valeur du temps de réponse à ±10%, la valeur de l'erreur statique ainsi que celle du premier dépassement. Toutes les constructions devront apparaitre.</li>
	<li>Proposer une valeur de Y<sub>0</sub>=0% qui permette d'annuler l'erreur statique. On expliquera comment on a procédé.</li>
	<li>Régler le régulateur pour un fonctionnement en régulation proportionnelle avec un gain A=5 et le décalage de bande Y<sub>0</sub> déterminé à la question précédente.</li>
	<li>Relever la réponse indicielle pour une consigne passant de 40% à 50%.</li>
	<li>Donner alors la valeur du temps de réponse à ±10%, la valeur de l'erreur statique ainsi que celle du premier dépassement. Toutes les constructions devront apparaitre.</li>			<li>Comparer ces performances à celles obtenues à la question 4. Si l'erreur statique est non nulle, expliquer pourquoi.</li>
	<li>Conclure sur l'apport du décalage de bande dans une régulation proportionnelle.</li>
</ol>


<?php

	include("./Settings/bas.php");
?>	
