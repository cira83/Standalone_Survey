<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img5/Aerotherm.png" /></center>

<p class="bleu">On désire réguler la température de l'air en sortie de l'aérotherme. Le capteur de température utilisée sera la PT100 (TE1), la puissance de chauffe sera maximale (3 kw).</p>

<h1>I. Modélisation</h1>
<p><img src="img5/AerothermB.gif"/></p>
<ol>
	<li>Compléter le schéma TI pour faire apparaître la boucle de régulation.</li>
	<li>Placer sur le schéma TI y<sub>1</sub>, y<sub>2</sub>, &theta; et  &theta;c que l'on trouvent sur le schéma fonctionnel.</li>
	<li>Déterminer un modèle du premier ordre (Broïda) de H(p) en utilisant la méthode simple, pour un échelon de commande de 50% à 80%. La commande de ventilation sera fixée à 65%.</li>
	<li>Donner la fonction de transfert du procédé H(p).</li>
	<li>Déterminer un modèle du premier ordre (Broïda) de Hz(p) en utilisant la méthode simple, pour un échelon de commande de 50% à 80%. La commande de chauffage sera fixée à 65%.</li>
	<li>Donner la fonction de transfert du procédé Hz(p).</li>
	<li>Exprimer &theta;(p) en fonction de y<sub>1</sub>, y<sub>2</sub>, Hz(p) et H(p).</li>
	<li>On suppose que y<sub>1</sub>=A.y<sub>2</sub>+y. Déterminer A pour que &theta;(p=0) ne dépende pas de y<sub>2</sub>.</li>
</ol>

<h1>II. Détermination d'un correcteur</h1>
<p class="bleu">On choisi un correcteur PI série avec Ti = &tau;, &tau; constante de temps de H(p).</p>
<ol>
	<li>Exprimer la fonction de transfert C(p) en fonction du gain A.</li>
	<li>Exprimer la fonction de transfert en boucle ouverte T(p) en fonction de A.</li>
	<li>À l'aide <?php easyreg();?>, déterminer A pour une réponse en boucle fermée la plus rapide possible sans dépassement.</li>
	<li>Mesurer les performances de votre correcteur en boucle fermée. On donnera la valeur de l'erreur statique et le temps de réponse à &pm;5%. (fournir la réponse indicielle)</li>
</ol>

<h1>III. Performances</h1>
<ol>
	<li>Donner la valeur de Xp et de Ti du correcteur déterminé au paragraphe II.</li>
	<li>Régler votre régulateur avec les valeurs déterminées.</li>
	<li>Relever la réponse indicielle de votre régulation. La consigne passera de 40 à 50%.</li>
	<li>Mesurer les performances de votre régulation. On donnera la valeur de l'erreur statique, du premier dépassement et du temps de réponse à &pm;5%. (fournir la réponse indicielle)</li>
	<li>Comparer les performances obtenues aux performances attendues.</li>
	<li>Essayer d'améliorer les performances de votre régulation en ajoutant de l'action dérivée.</li>
	<li>Relever la réponse indicielle de votre régulation. La consigne passera de 40 à 50%.</li>
	<li>Mesurer les performances de votre régulation. On donnera la valeur de l'erreur statique, du premier dépassement et du temps de réponse à &pm;5%. (fournir la réponse indicielle)</li>
	<li>Conclure sur l'apport de l'action dérivée.</li>
</ol>	



<?php

	include("./Settings/bas.php");
?>	
