<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img3/Aerotherm.png" /></center>

<p class="bleu">On désire réguler la température de l'air en sortie de l'aérotherme. Le capteur de température utilisée sera la PT100 (TE1), la puissance de chauffe sera maximale et la ventilation sera maximale.</p>

<h1>I. Modélisation</h1>
<ol>
	<li>Donner le nom de la grandeur réglante.</li>
	<li>Donner le nom d'une perturbation.</li>
	<li>Compléter le schéma TI pour faire apparaître la boucle de régulation.</li>
	<li>Proposer un schéma fonctionnel de la régulation en faisant apparaître la perturbation.</li>
	<li>Déterminer un modèle du premier ordre (Broïda sans retard) du procédé en utilisant la méthode de simple, pour un échelon de commande de 50% à 90%.</li>
	<li>Donner la fonction de transfert du procédé H(p).</li>
</ol>

<h1>II. Détermination d'un correcteur</h1>
<p class="bleu">On choisi un correcteur PI série avec Ti = &tau;. (&tau; = constante de temps du procédé)</p>
<ol>
	<li>Exprimer la fonction de transfert C(p) en fonction du gain A.</li>
	<li>Exprimer la fonction de transfert en boucle ouverte T(p) en fonction de A.</li>
	<li>Exprimer la fonction de transfert en boucle fermée F(p) en fonction de A.</li>
	<li>Quelle est la valeur du gain statique de la boucle fermée F(0) ?</li>
	<li>En déduire la valeur de l'erreur statique.</li>
	<li>Déterminer x(t), la réponse à un échelon de consigne de 10%.</li>
	<li>En déduire la valeur de A pour avoir un temps de réponse à &pm;5% égale à &tau;/10.</li>
</ol>

<h1>III. Performances</h1>
<ol>
	<li>Quelle est la valeur de la bande proportionnelle correspondante à la réponse II.7 ?</li>
	<li>Donner le sens d'action à régler sur votre régulateur. Justifier votre réponse.</li>
	<li>Procéder au réglage de votre régulateur conformément au paragraphe II.</li>
	<li>Relever la réponse à un échelon de consigne de 10%. Choisir une consigne proche des températures obtenues à la question I.5.</li>
	<li>Donner alors le temps de réponse à &pm;5 %, l'erreur statique, ainsi que le premier dépassement. On fera apparaitre toutes les constructions.</li>
	<li>Commenter les différences par rapport à la réponse indicielle attendue.</li>
</ol>





<?php

	include("./Settings/bas.php");
?>	
