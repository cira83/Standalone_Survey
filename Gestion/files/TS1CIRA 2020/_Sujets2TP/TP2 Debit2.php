<?php 
	include("./Settings/haut.php");
?>

<h1>I. Rappels sur le schéma fonctionnel</h1>
<p>On donne le schéma bloc suivant, représentant la régulation de débit.</p>
<img src="img2/01.gif"/>
<ol>
	<li>Mettre en évidence sur ce schéma fonctionnel les éléments suivants :</li>
	<ul>
		<li>La mesure de débit X ;</li>
		<li>Le régulateur ;</li>
		<li>La consigne W du régulateur ;</li>
		<li>La sortie Y du régulateur ;</li>
		<li>L'entrée X du régulateur ;</li>
		<li>La vanne de régulation.</li>
	</ul>
	<li>Quel doit être le sens d'action du régulateur. Justifiez votre réponse.</li>
</ol>

<h1>II. Prédéterminations</h1>
<p>On donne ci-dessus la caractéristique théorique débit en fonction de la commande de la vanne de la maquette de régulation de débit.</p>
<img src="img2/02.gif"/>
<ol>
	<li>Mesurer X<sub>max</sub>, Y1 et Y2 pour un fonctionnement sans perturbation. On donnera la méthode utilisée et des copies d'écran.</li>
	<li>Même question pour un fonctionnement avec perturbations.</li>
<p class="orange">On choisi une consigne <b>W</b> égale à Xmax avec perturbation divisé par 2.</p>
	<li>Déterminer la valeur du gain K du schéma fonctionnel pour le point de fonctionnement considéré (<b class="orange">W</b>), pour un système sans perturbation.</li>
	<li>Même question pour un système avec perturbation.</li>
	<li>Rappeler la relation entre le gain du régulateur A et la bande proportionnelle Xp du régulateur.</li>
	<li>Déterminer la valeur algébrique de la mesure X pour une consigne <b class="orange">W</b> en fonction de A et K et Y1.</li>
</ol>


<h1>III. Réglage du régulateur</h1>
<ol>
	<li>Régler l'affichage du régulateur en %. <a href="../../../doclasse.php" class="no-under" target="_blank">On s'aidera du document sur les paramètres des régulateurs</a>.</li>
	<li>Régler le régulateur pour un fonctionnement en régulation proportionnelle. On n'oubliera pas d'annuler les actions intégrale et dérivée.</li>
	<li>Régler la consigne à <b class="orange">W</b>. Placer le régulateur en mode automatique. On précisera la méthode utilisée.</li>
</ol>

<h1>IV. La bande proportionnelle et l'erreur statique</h1>
<ol>
	<li>À l'aide de la formule trouvée à la question II.6, prédéterminer la valeur de X pour les bandes proportionnelles suivantes : 40% et 60%. Le système fonctionne sans perturbation.</li>
	<li>Vérifier les valeurs précédentes de manière expérimentale.</li>
	<li>Comparer les résultats théoriques avec les résultats pratiques. Expliquer s'il y a lieu leur différence.</li>
</ol>


<h1>V. La bande proportionnelle et la perturbation</h1>
<ol>
	<li>À l'aide de la formule trouvée à la question II.6, prédéterminer l'influence de la perturbation sur la mesure X pour les valeurs suivantes de la bande proportionnelle : 40% et 60%.</li>
	<li>Vérifier les valeurs précédentes de manière expérimentale.</li>
	<li>Comparer les résultats théoriques avec les résultats pratiques. Expliquer s'il y a lieu les différences.</li>
</ol>




<?php

	include("./Settings/bas.php");
?>	
