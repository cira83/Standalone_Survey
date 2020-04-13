<?php 
	include("./Settings/haut.php");
?>
<img src="img2/04.gif"/><hr/>
<img src="img2/05.gif"/>

<h1>I. Schématisation de la régulation</h1>
<ol>
	<li>Compléter le schéma TI fourni ci-dessus en plaçant les fils permettant un fonctionnement de la régulation de niveau.</li>
	<li>Donner le nom des différents éléments : <ul>
		<li>grandeur réglée ;</li>
		<li>grandeur réglante ;</li>
		<li>grandeur perturbatrice ;</li>
		<li>organe de réglage.</li>
	</ul>
	</li>
	<li>Dans le schéma fonctionnel ci-dessus, placer les éléments suivants : <ul>
		<li>La consigne W ;</li>
		<li>La mesure X ;</li>
		<li>LV1, Qout ;</li>
		<li>LV2, Qin ;</li>
		<li>LIC ; LT.</li>
	</ul>
	</li>
	<li>Comment agit le débit Qin sur le niveau X ? <br/>Compléter le schéma en ajoutant l’opérateur + ou - correspondant.</li>
	<li>Comment agit le débit Qout sur le niveau X ? <br/>Compléter le schéma en ajoutant l’opérateur + ou - correspondant.</li>
	<li>Quel est le sens d’action du procédé ? En déduire le sens d’action du régulateur. <br/>Compléter le schéma en ajoutant les opérateurs + ou - correspondants.</li>
	<li>Si l'entrée du bloc H (le réservoir) est soumise à un débit constant non nul, donner l'allure de la mesure en fonction du temps.</li>
	<li>En déduire si le bloc H est un bloc :<ul>
		<li>stable ?</li>
		<li>instable ?</li>
		<li>intégrateur ?</li>
	</ul>
	</li>
</ol>



<h1>II. L’erreur statique quand Qin = 0</h1>
<ol>
<p class="orange">Dans un premier temps, le débit Qin = 0. La régulation est une régulation proportionnelle de bande proportionnelle Xp, avec une consigne de 50%.</p>

	<li>En régime permanent (mesure X constante), quelle est la valeur du Qout ?</li>
	<li>En déduire la commande de la vanne Y si celle-ci est NF.</li>
	<li>Quelle est alors la valeur de l’erreur statique pour les bandes suivantes (10%, 20 %) ?</li>

<center><h2>En pratique</h2></center>
<p class="orange">Vanne LV1 fermée, remplir le réservoir jusqu’à 100 %.</p>

	<li>Pour les deux valeurs de bande proportionnelle (10%, 20 %), relever la valeur de l’erreur statique.</li>
	<li>Expliquez pourquoi elles sont différentes des valeurs théoriques.</li>
</ol>

<h1>III. L’erreur statique quand Qin ≠ 0</h1>
<ol>
<p class="orange">Ouvrir modérément la vanne LV2.</p>

	<li>Relever la valeur de la commande Y pour avoir un niveau stable à 50%.</li>
	<p class="orange">La régulation est une régulation proportionnelle de bande proportionnelle Xp, avec une consigne de 50%.</p>
	<li>En régime permanent, quelle sera la valeur de la commande Y ?</li>
	<li>En déduire, la valeur de l’erreur statique pour les bandes suivantes (10%, 20 %).</li>


<center><h2>En pratique</h2></center>
<p class="orange">Ne pas toucher la vanne LV2 !!</p>

	<li>Pour les deux valeurs de bande proportionnelle (10%, 20 %), relever la valeur de l’erreur statique en fonctionnement.</li>
	<li>Expliquez pourquoi elles sont différentes des valeurs théoriques.</li>
	<li>Proposer une méthode permettant d’annuler cette erreur statique, sans utiliser de correcteur intégral.</li>
	<li>Vérifier le fonctionnement de votre méthode, pour Xp égal à 20%. On donnera la valeur réelle de l'erreur statique.</li>
</ol>



<?php

	include("./Settings/bas.php");
?>	
