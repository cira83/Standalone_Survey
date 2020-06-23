<?php 
	include("./Settings/haut.php");
?>
<center><p><img src="./img3/niveau_2.jpg" width="45%"></p></center>

<h1>I. Mesure du niveau</h1>
<ol>
	<li>Proposer un câblage électrique permettant le fonctionnement de la boucle de régulation et la communication avec un modem Hart. On rappelle qu'une résistance de 250 &Omega; est branchée en parallèle sur l'entrée mesure du régulateur.</li>
	<li>Valider le fonctionnement de la communication avec le transmetteur. On fournira une copie d'écran des réglages du transmetteur.</li>
	<li>Procéder au réglage du transmetteur pour qu'il affiche la mesure du niveau dans le réservoir inférieur. On détaillera la procédure utilisée.</li>
	<li>Tracer la caractéristique de votre transmetteur de niveau (mesure en % en fonction du niveau réel en %, au moins 5 mesures).</li>
</ol>

<h1>II. Correcteur PID</h1>
<ol>
	<li>Régler les vannes manuelles afin d'avoir un niveau de 50% pour une commande de 50%. <u class="orange">Ne plus toucher ces vannes par la suite</u>.</li>
	<li>Relever la réponse indicielle du procédé pour une commande variant de 50% à 60%.</li>
	<li>Déduire de la courbe précédente le sens d'action du procédé. On fera un raisonnement complet.</li>
	<li>Déterminer le modèle de Broïda de votre procédé. On fera apparaitre toutes les constructions nécessaires et on utilisera la méthode de Broïda.</li>
	<li>Déterminer les réglages de votre régulateur PID à l'aide du cours de régulation.</li>
	<li>Proposer un schéma fonctionnel de la régulation de niveau. On fera apparaitre les transformées de Laplace dans les blocs fonctionnels.</li>
	<li>Donner T(p), la fonction de transfert en boucle ouverte.</li>
	<li>À l'aide du logiciel <?php easyreg();?>, tracer l'allure de la réponse indicielle théorique en boucle fermée.</li>
	<li>Déduire de cette réponse les performances théoriques (temps de réponse à &pm;5%, erreur statique et premier dépassement) de votre régulation.</li>
</ol>

<h1>III. Performances</h1>
<ol>
	<li>Programmer votre régulateur conformément au correcteur déterminé. On donnera les paramètres modifiés ainsi que leur valeur respective.</li>
	<li>Relever la réponse à un échelon de consigne de 50% à 60%.</li>
	<li>Déduire de cette réponse les performances réelles (temps de réponse à &pm;5%, erreur statique et premier dépassement) de votre régulation.</li>
	<li>Comparer les performances théoriques et réelles et expliquer les différences si il y a lieu.</li>
</ol>




<?php

	include("./Settings/bas.php");
?>	
