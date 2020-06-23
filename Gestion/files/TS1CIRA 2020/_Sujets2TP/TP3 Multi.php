<?php 
	include("./Settings/haut.php");
?>
<img src="img3/Multiboucle2.gif"/>


<p><font color="aqua"><u>Objet du TP :</u> On vous propose de comparer les performances d'une boucle de régulation proportionnelle avec talon à celle d'une boucle de régulation proportionnelle intégrale. La perturbation considérée sera le débit d'eau froide.</font></p>

<h1>I. Contrôle du débit d'eau froide</h1>
<ol>
	<li>Proposer un schéma électrique permettant la régulation du débit conformément au schéma TI.</li>
	<li>Relever la valeur maximale du débit d'eau froide, que l'on notera Q<sub>max</sub>.</li>
	<li>Régler le régulateur pour un fonctionnement sans erreur statique et une consigne de &frac34;Q<sub>max</sub>.</li>
	<li>Relever la réponse indicielle pour une consigne passant de &frac12;Q<sub>max</sub> à &frac34;Q<sub>max</sub>.</li>
	<li>Donner la valeur de l'erreur statique, du temps de réponse à 10% et celle du premier dépassement.</li>
</ol>

<h1>II. Régulation proportionnelle de température</h1>
<p><font color="aqua">Le point de fonctionnement nominal correspond à un débit égal à &frac34;Q<sub>max</sub> et une température de 40 &deg;C.</font></p>

<ol>
	<li>Proposer un schéma électrique permettant la régulation de température conformément au schéma TI.</li>
	<li>Régler la bande proportionnelle afin d'obtenir un système stable avec un dépassement inférieur à 20%.</li>
	<li>Relever la réponse indicielle pour une consigne passant de 35&deg;C à 40&deg;C.</li>
	<li>Donner la valeur de l'erreur statique, du temps de réponse à 10% et celle du premier dépassement.</li>
	<li>Relever l'évolution de la température pour une consigne de débit passant de &frac34;Q<sub>max</sub> à &frac12;Q<sub>max</sub>.</li>
	<li>Donner la valeur de l'erreur statique, le temps pour retourner à 1&deg;C de la valeur finale.</li>
</ol>


<h1>III. Régulation proportionnelle intégrale de température</h1>
<ol>
	<li>Régler le régulateur pour un fonctionnement stable avec la plus petite valeur de Ti.</li>
	<li>Multiplier Ti par 4.</li>
	<li>Relever la réponse indicielle pour une consigne passant de 35&deg;C à 40&deg;C.</li>
	<li>Donner la valeur de l'erreur statique, du temps de réponse à 10% et celle du premier dépassement.</li>
	<li>Relever l'évolution de la température pour une consigne de débit passant de &frac34;Q<sub>max</sub> à &frac12;Q<sub>max</sub>.</li>
	<li>Donner la valeur de l'erreur statique, le temps pour retourner à 1&deg;C de la valeur finale.</li>
	<li>Comparer les réponses obtenue à la perturbation de débit. Expliquer les différences.</li>
	<li>Quelle type de régulation a votre préférence. Justifier votre réponse.</li>
</ol>






<?php

	include("./Settings/bas.php");
?>	
