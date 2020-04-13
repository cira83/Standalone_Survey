<?php 
	include("./Settings/haut.php");
?>
<img src="img2/multiboucle.gif"/>

<h1>I. Compréhension</h1>
<ol>
	<li>Compléter le schéma ci-dessus pour faire apparaître la boucle de régulation de température. L'organe de réglage sera FV2.</li>
	<li>Proposez un schéma fonctionnel de la régulation. Faire apparaître, FV2, la température de l'eau froide et l'échangeur thermique.</li>
	<img src="img2/2604-500x500.jpg" width="150px"/>
	<li>Rappeler la signification des indications fournies par le régulateur ci-dessus.</li>
	<li>Placer ces indications sur le schéma fonctionnel.</li>
	<li>Quelle différence faites-vous entre un fonctionnement en boucle ouverte et un fonctionnement en boucle fermée.</li>
	<li>Quels sont les principaux paramètres à régler sur iTools et leur valeur respective, pour obtenir une régulation proportionnelle avec une bande proportionnelle de 10 % ?
	<a href="../../../doclasse.php" class="no-under" target="_blank">On s'aidera du document sur les paramètres des régulateurs.</a>
	</li>
	<li>Régler le débit d'eau froide avec une commande de 100%. Relever la valeur du débit affiché sur le débitmètre.</li>
</ol>

<h1>II. Prédéterminations et vérifications</h1>
<ol>
	<li>Relever T<sub>0</sub>, la température de l'eau froide. Expliquez comment vous avez procédé.</li>
	<p class="orange">On suppose que T-T<sub>0</sub>=K&times;Y, avec T la mesure de la température et Y la commande de la vanne FV2.</p><li>Mesurer K.</li>
	<li>Prédéterminer graphiquement la valeur de la température en régime permanent pour Xp=40% et W=40&deg;C à l'aide de la valeur obtenue de K à la question précédente.</li>
<p class="orange">Rappel du cours :</p>
<img src="img2/Point2Fonctionnement.png" width="300px"/><br/>
	<li>Vérifiez ce point de fonctionnement dans la pratique.</li>
	<li>Prédéterminer graphiquement la valeur de la température en régime permanent pour Xp=20% et W=40&deg;C.</li>
	<li>Vérifiez ce point de fonctionnement dans la pratique.</li>
	<li>Conclure sur l’influence de la bande proportionnelle sur l’erreur statique.</li>
</ol>

<h1>III. Instabilité</h1>
<ol>
	<li>Déterminer la valeur minimale Xp<sub>min</sub> de la bande proportionnelle qui correspond à un fonctionnement stable (W=40&deg;C).</li>
	<li>Mesurer la valeur de la période d'oscillation.</li>
</ol>



<?php

	include("./Settings/bas.php");
?>	
