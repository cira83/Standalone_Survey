<?php 
	include("./Settings/haut.php");
?>
<center><p><img src="img2020/NiveauDR2.jpg " width="55%"></p></center>

<h1>I. Réglage du transmetteur</h1>
<ol>
	<li>Procéder au réglage du transmetteur de pression, pour avoir la relation suivante entre la mesure de pression X et le niveau L2. On donnera la procédure utilisée.</li>
	<img src="img2020/L1.jpg"/>
	<li>Compléter le schéma suivant représentant la relation entre L1 et X.</li>
	<img src="img2020/L2.jpg"/>
	<li>Compléter le schéma suivant représentant le relation entre les niveaux L1 et L2.</li>
	<img src="img2020/L3.jpg"/>
	<li>En déduire le relation mathématique entre L1 et L2.</li>
</ol>

<h1>II. Boucle ouverte</h1>
<p class="bleu">Remplir le réservoir R2 au maximum, puis fermer la vanne V1.</p>
<ol>
	<li>Calculer la commande en % correspondant à un courant de 9 mA. On notera cette valeur Y9 .</li>
	<li>Relever la réponse du système à une augmentation de commande de 0 à Y9 . On donnera l'évolution des niveaux L1 et L2 des deux réservoirs.</li>
	<li>Le procédé est-il stable ou instable ?</li>
	<li>Le procédé est-il intégrateur ?</li>
	<li>Mesurer le temps de réponse à &pm;10 %.</li>
</ol>

<h1>III. Régulation du niveau L2</h1>
<p class="bleu">Remplir le réservoir R2 au maximum, puis fermer la vanne V1.</p>
<ol> 
	<li>Régler le régulateur pour afﬁcher le niveau L2. On donnera les valeurs de VALL et VALH.</li>
	<li>Déterminer le sens d'action du régulateur.</li>
	<li>Procéder au réglage de celui-ci, avec les valeurs ci-dessous.</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc">Xp=10%</td>
	<td class="blanc">Y0=0%</td>
	<td class="blanc">Ti=30s</td>
	<td class="blanc">Td=0s</td>
</table></center>
	<li>Relever la réponse indicielle en boucle fermée du système. La consigne passera de 100 à 50%.</li>
	<li>Donner la valeur de l'erreur statique.</li>
	<li>Mesurer le temps de réponse à &pm;10 %.</li>
</ol>

<h1>IV. Régulation du niveau L1</h1>
<p class="bleu">Remplir le réservoir R2 au maximum, puis fermer la vanne V1.</p>
<ol> 
	<li>Régler le régulateur pour afﬁcher le niveau L1. On donnera les valeurs de VALL et VALH.</li>
	<li>Déterminer le sens d'action du régulateur.</li>
	<li>Procéder au réglage de celui-ci, avec les valeurs ci-dessous.</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc">Xp=10%</td>
	<td class="blanc">Y0=0%</td>
	<td class="blanc">Ti=30s</td>
	<td class="blanc">Td=0s</td>
</table></center>
	<li>Relever la réponse indicielle en boucle fermée du système. La consigne passera de 100 à 50%.</li>
	<li>Donner la valeur de l'erreur statique.</li>
	<li>Mesurer le temps de réponse à &pm;10 %.</li>
</ol>



<?php

	include("./Settings/bas.php");
?>	
