<?php 
	include("./Settings/haut.php");
?>
<img src="img2/04.gif"/><hr/>
<img src="img2/05.gif"/>

<h1>I. Schématisation de la régulation</h1>
<ol>
	<li>Compléter le schéma TI fourni ci-dessus en plaçant les fils permettant un fonctionnement de la régulation de niveau.</li>
	<li>Donner le nom des différents éléments : Grandeur réglée ; Grandeur réglante ;  Grandeur perturbatrice ; Organe de réglage.</li>
	<li>Dans le schéma fonctionnel ci-dessus, placer les éléments suivants : La consigne W ; La mesure X ; LV1, Qout ; LV2, Qin ; LIC ; LT.</li>
	<li>Quelle est le sens d’action du débit Qin sur le niveau X ? Compléter le schéma en ajoutant l’opérateur + ou - correspondant.</li>
	<li>Quelle est le sens d’action du débit Qout sur le niveau X ? Compléter le schéma en ajoutant l’opérateur + ou - correspondant.</li>
	<li>Quelle est le sens d’action de la sortie Y du régulateur sur le niveau X ? En déduire le sens d’action du régulateur. Compléter le schéma en ajoutant les opérateurs + ou - correspondants.</li>
	<li>Si l'entrée du bloc H est soumise à une constante non nulle, donner l'allure de la sortie du bloc H.</li>
</ol>



<h1>II. Prédétermination de l’erreur statique quand Qin = 0</h1>
<p>Dans un premier temps, le débit Qin = 0. La régulation est une régulation proportionnelle avec une consigne de 50%.</p>
<ol>
	<li>Donner la valeur de C.</li>
	<li>Tracer la commande Y théorique fournie par le régulateur en fonction du niveau pour les bandes proportionnelles suivantes : 10%, 20 %.</li>
	<li>Dans notre cas, quelle est la valeur de l’ouverture de la vanne en régime permanent ? Expliquez.</li>
	<li>En déduire la valeur de l’erreur statique pour les deux bandes proportionnelles.</li>
</ol>


<h1>III. Fonctionnement en mode automatique</h1>
<p>Vanne LV1 fermée, remplir le réservoir jusqu’à 100 %.</p>
<ol>
	<li>Pour les deux valeurs de bande proportionnelle (10%, 20 %), relever la valeur de l’erreur statique.</li>
	<li>Expliquez pourquoi elles sont différentes des valeur théoriques.</li>
</ol>

<h1>IV. Prédétermination de l’erreur statique quand Qin ≠ 0</h1>
<p>Ouvrir modérément la vanne LV2.</p>
<ol>
	<li>Relever la valeur d’ouverture de la vanne LV1 pour avoir un niveau stable à 50%.</li>
	<li>Tracer la caractéristique statique, niveau en fonction de l’ouverture de la vanne LV1.</li>
	<li>En déduire, la valeur de l’erreur statique en fonction de la bande proportionnelle, pour les bandes suivantes (10%, 20 %).</li>
</ol>

<h1>V. Fonctionnement en mode automatique</h1>
<ol>
	<li>Pour les deux valeurs de bande proportionnelle (10%, 20 %), relever la valeur de l’erreur statique en fonctionnement.</li>
	<li>Expliquez pourquoi elles sont différentes des valeur théoriques.</li>
	<li>Proposer une méthode permettant d’annuler cette erreur statique, sans utiliser de correcteur intégral.</li>
	<li>Vérifier le fonctionnement de votre méthode, pour les deux bandes proportionnelles. On donnera les valeurs réelles des erreurs statiques.</li>
	<li>Commenter les résultats obtenues avec votre méthode, et comparer celle-ci avec l’utilisation d’un correcteur intégral.</li>
</ol>



<?php

	include("./Settings/bas.php");
?>	
