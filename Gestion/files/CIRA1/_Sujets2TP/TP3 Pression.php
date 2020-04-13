<?php 
	include("./Settings/haut.php");
?>
<img src="img2020/Maquette%20Pression.jpg"/>

<h1>I. Généralités</h1>
<ol>
	<li>Quels sont les éléments d’une chaîne de régulation ?</li>
	<li>Quel est le rôle du régulateur dans cette chaîne ?</li>
	<li>Donner la réponse d'un régulateur à action proportionnelle de gain de valeur 2 à un échelon de mesure de 20% à 40%. Le régulateur est configuré en sens direct, les actions intégrale et dérivée sont supprimées, la consigne reste constante et Y à t=0s est égale à 0.</li>
	<li>Régler le régulateur avec les réglages suivants, donner le nom et la valeur des paramètres modiﬁés.</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc">Sens d'action inverse</td>
	<td class="blanc">Xp=30%</td>
	<td class="blanc">Y0=0%</td>
	<td class="blanc">Ti=&infin;</td>
	<td class="blanc">Td=0s</td>
	<td class="blanc">X=50%</td>
</table></center>
	<li>Mettre le régulateur en mode automatique, puis faire varier W de 50% à 60%. Mesurer les valeurs correspondantes de Y.</li>
	<li>Même question avec Xp = 50 %.</li>
	<li>Représenter les courbes Y = f (W)</li>
	<li>En déduire l'ampliﬁcation du régulateur ∆Y/∆W dans les deux expériences précédentes et la comparer avec la valeur théorique A = 100/Xp .</li>
</ol>

<h1>II. Étude de la régulation </h1>
<img src="img2020/TI%20Pression.jpg"/>
<ol>
	<li>Donner la signiﬁcation des symboles PT et PIC.</li>
	<li>Quel est le rôle des éléments (1), (2), (3), (4) de la boucle de régulation ?</li>
	<li>Réaliser et donner le câblage électrique correspondant au schéma TI.</li>
<p>Dans certains lycées ont utilise des enregistreurs câblés comme dans le schéma ci-dessous :</p>
<img src="img2020/Enregistreur.jpg"/>
	<li>Quelle est la grandeur visualisée entre A et B ?</li>
	<li>Quelle est la grandeur visualisée entre C et D ?</li>
</ol>

<h1>III. Performances</h1>
<ol>
	<li>Déterminer le sens d’action du régulateur.</li>
	<li>Régler le régulateur avec les réglages suivants, donner le nom et la valeur des paramètres modiﬁés.</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc">Xp=30%</td>
	<td class="blanc">Ti=30s</td>
	<td class="blanc">Td=0s</td>
	<td class="blanc">W=50%</td>
</table></center>	
	<li>Amener le procédé au point de fonctionnement, régulateur en manuel.</li>
	<li>Passer le régulateur en automatique, puis réaliser un échelon de consigne (10 %) et enregistrer l'évolution de la mesure.</li>
	<li>Reprendre l'exercice précédent en utilisant les nouveaux réglages :</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc">Xp=30%</td>
	<td class="blanc">Ti=10s</td>
	<td class="blanc">Td=0s</td>
	<td class="blanc">W=50%</td>
</table></center>	
	<li>Comparer les deux enregistrements et en déduire le réglage le plus adapté.</li>
</ol>


<?php

	include("./Settings/bas.php");
?>	
