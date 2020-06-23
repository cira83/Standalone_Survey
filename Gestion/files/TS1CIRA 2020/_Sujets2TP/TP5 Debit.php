<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img5/Debit.gif"/></center>

<h1>I. Préparation</h1>
<ol>
	<li>Donner puis réaliser le câblage électrique correspondant au schéma TI ci-dessus.</li>
	<li>Déterminer le sens d'action du régulateur, on fera un raisonnement complet, on pourra s'appuyer sur des mesures.</li>
	<li>Régler le régulateur avec le sens d'action déterminé.</li>
	<li>Préciser les éléments suivants :</li>
		<ul>
			<li>la grandeur réglée ;</li>
			<li>la grandeur réglante ;</li>
			<li>l’organe de réglage ;</li>
			<li>une grandeur perturbatrice.</li>
		</ul>
	<li>Comment peut-on perturber la grandeur réglée ?</li>
	<li>Relever la caractéristique statique de votre procédé sans perturbation.</li>
	<li>Même question avec la perturbation.</li>
	<li>Mettre les deux courbes sur le même graphique et expliquer l'influence de la perturbation.</li>
</ol>

<h1>II. Ziegler et Nichols</h1>
<ol>
	<li>Procéder à l'identification de Z&N pour un fonctionnement sans perturbation.</li>
	<li>Déterminer les deux caractéristiques du procédé (Ac et Tc).</li>
	<li>Calculer le correcteur PI, proposé par Z&N.</li>
	<li>Calculer le correcteur PID, proposé par Z&N.</li>
</ol>

<h1>III. Performances vis à vis de la consigne</h1>
<ol>
	<li>Programmer votre régulateur conformément au correcteur PI déterminé. On donnera les paramètres modifiés ainsi que leur valeur respective.</li>
	<li>Relever la réponse à un échelon de consigne.</li>
	<li>Déduire de cette réponse les performances (temps de réponse à &pm;5%, erreur statique et premier dépassement) de votre régulation.</li>
	<li>Programmer votre régulateur conformément au correcteur PID déterminé. On donnera les paramètres modifiés ainsi que leur valeur respective.</li>
	<li>Relever la réponse à un échelon de consigne.</li>
	<li>Déduire de cette réponse les performances (temps de réponse à &pm;5%, erreur statique et premier dépassement) de votre régulation.</li>
	<li>Comparer les performances des deux correcteurs et expliquer les différences si il y a lieu.</li>
</ol>

<h1>IV. Performances vis à vis de la perturbation</h1>
<ol>
	<li>Programmer votre régulateur conformément au correcteur PI déterminé.</li>
	<li>Relever la réponse à la perturbation.</li>
	<li>Déduire de cette réponse les performances (temps de retour à la consigne et premier dépassement) de votre régulation.</li>
	<li>Programmer votre régulateur conformément au correcteur PID déterminé.</li>
	<li>Relever la réponse à la perturbation.</li>
	<li>Déduire de cette réponse les performances (temps de retour à la consigne et premier dépassement) de votre régulation.</li>
	<li>Comparer les performances des deux correcteurs et expliquer les différences si il y a lieu.</li>
</ol>







<?php
	include("./Settings/bas.php");
?>	