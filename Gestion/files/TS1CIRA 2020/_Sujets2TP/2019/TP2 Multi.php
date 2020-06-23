<?php 
	include("./Settings/haut.php");
?>
<img src="img2/multiboucle.gif"/>

<h1>I. Compréhension</h1>
<ol>
	<li>Compléter le schéma ci-dessus pour faire apparaître la boucle de régulation.</li>
	<li>Proposez un schéma fonctionnel de la régulation. Faire apparaître, FV2, la température de l'eau froide et l'échangeur thermique.</li>
	<li>Rappeler la signification des indications fournies par le régulateur. Placer ces indications sur le schéma fonctionnel.</li>
	<li>Quelle différence faites-vous entre un fonctionnement en boucle ouverte et un fonctionnement en boucle fermée.</li>
	<li>Quels sont les principaux paramètres à régler sur iTools et leur valeur respective, pour obtenir une régulation proportionnelle avec une bande proportionnelle de 10 % ?</li>
</ol>

<h1>II. Prédéterminations et vérifications</h1>
<ol>
	<li>Relever Tf, la température de l'eau froide. Expliquez comment vous avez procédé.</li>
	<li>On suppose que Tc-Tf=Ke(Qf)&times;Qc, avec Tc la grandeur réglée, Qc le débit d'eau chaude et Qf le débit d'eau froide. Mesurer Ke(Qf<sub>max</sub>).</li>
	<li>On suppose que Qc = Kv&times;Y. Mesurer Kv.</li>
	<li>Prédéterminer graphiquement la valeur de la température en régime permanent pour Xp=40% et W=40&deg;C à l'aide des valeurs obtenus aux questions précédentes.</li>
	<li>Vérifiez ce point de fonctionnement dans la pratique.</li>
	<li>Prédéterminer graphiquement la valeur de la température en régime permanent pour Xp=20% et W=40&deg;C.</li>
	<li>Vérifiez ce point de fonctionnement dans la pratique.</li>
	<li>Conclure sur l’influence de la bande proportionnelle sur l’erreur statique.</li>
</ol>

<h1>III. Instabilité</h1>
<ol>
	<li>Déterminer la valeur minimale Xp<sub>min</sub> de la bande proportionnelle qui correspond à un fonctionnement stable (W=40&deg;C).</li>
	<li>Relever la réponse indicielle pour une régulation proportionnelle avec XP = 2&times;Xp<sub>min</sub>.</li>
	<li>Le système est-il stable ?</li>
	<li>Donner la valeur du dépassement en %.</li>
	<li>Donner le temps de réponse à ± 10 %.</li>
	<li>Conclure sur l’influence de la bande proportionnelle sur la stabilité du système.</li>
</ol>



<?php

	include("./Settings/bas.php");
?>	
