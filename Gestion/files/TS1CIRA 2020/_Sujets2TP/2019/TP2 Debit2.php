<?php 
	include("./Settings/haut.php");
?>
<p>On donne le schéma bloc suivant, représentant la régulation de débit.</p>
<img src="img2/01.gif"/>

<p>On donne ci-dessus la caractéristique théorique débit en fonction de la commande de la vanne de la maquette de régulation de débit.</p>
<img src="img2/02.gif"/>

<h1>I. Rappels sur le schéma fonctionnel</h1>
<ol>
	<li>Mettre en évidence sur ce schéma fonctionnel les éléments suivants :</li>
	<ul>
		<li>Le débit ;</li>
		<li>Le régulateur ;</li>
		<li>La consigne W du régulateur ;</li>
		<li>La sortie Y du régulateur ;</li>
		<li>L'entrée X du régulateur ;</li>
		<li>La vanne de régulation.</li>
	</ul>
	<li>Quel doit être le sens d'action du régulateur. Placer alors les opérateurs arithmétiques correspondants sur le schéma fonctionnel.</li>
</ol>

<h1>II. Prédéterminations</h1>
<ol>
	<li>Mesurer les valeurs de Qmax, Y1 et Y2 de la maquette pour un fonctionnement sans perturbation.</li>
	<li>Même question avec un fonctionnement avec perturbations.</li>
<p class="orange">On suppose à présent que le point de fonctionnement est compris entre dans l'intervalle [Y1,Y2], quel que soit le fonctionnement (avec et sans perturbation).</p>
	<li>Déterminer la valeur de K<sub>1</sub> pour le point de fonctionnement considéré, pour un système sans perturbation.</li>
	<li>Même question pour K<sub>2</sub>, pour un système avec perturbation.</li>
	<li>Rappeler la relation entre le gain du régulateur A et la bande proportionnelle Xp du régulateur.</li>
	<li>Déterminer la valeur du débit Q pour une consigne W en fonction de A et K et Y1.</li>
</ol>


<h1>III. Réglage du régulateur</h1>
<ol>
	<li>Régler l'affichage du régulateur en %. On précisera la procédure utilisée.</li>
	<li>Régler le régulateur pour un fonctionnement en régulation proportionnelle. On n'oubliera pas d'annuler les actions intégrale et dérivée.</li>
	<li>Régler la consigne à Qmax/3. Placer le régulateur en mode automatique. On précisera la méthode utilisée.</li>
</ol>

<h1>IV. La bande proportionnelle et l'erreur statique</h1>
<ol>
	<li>À l'aide de la formule trouvée à la question II.6, prédéterminer la valeur du débit Q pour les valeurs suivantes de la bande proportionnelle (40 %, 60 %). Le système fonctionne sans perturbation.</li>
	<li>Vérifier les valeurs précédentes de manière expérimentale.</li>
	<li>Comparer les résultats théoriques avec les résultats pratiques. Expliquer s'il y a lieu leur différence.</li>
</ol>


<h1>V. La bande proportionnelle et la perturbation</h1>
<ol>
	<li>À l'aide de la formule trouvée à la question II.6, prédéterminer l'influence de la perturbation sur le débit Q pour les valeurs suivantes de la bande proportionnelle (40 %, 60 %).</li>
	<li>Vérifier les valeurs précédentes de manière expérimentale.</li>
	<li>Comparer les résultats théoriques avec les résultats pratiques. Expliquer s'il y a lieu les différences.</li>
	<li>Conclure sur l'efficacité de la modélisation.</li>
</ol>




<?php

	include("./Settings/bas.php");
?>	
