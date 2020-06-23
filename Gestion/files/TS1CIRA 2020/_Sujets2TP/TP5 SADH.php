<?php 
	include("./Settings/haut.php");
?>
<img src="img2/1.jpg"/>
<h1>I. Préparation</h1>

<ol>
	<li>Donner puis réaliser le câblage pneumatique et électrique correspondant au schéma TI ci-dessus.</li>
	<li>Déterminer le sens d'action du régulateur, on fera un raisonnement complet, on pourra s'appuyer sur des mesures.</li>
	<li>Régler le régulateur avec le sens d'action déterminé.</li>
</ol>


<p class="orange">Dans la suite, on enregistrera la mesure, la commande et la consigne de la régulation fonctionnant en boucle fermée.</p>

<h1>II. Action proportionnelle</h1>
<ol>
	<li>Déterminer la valeur de Xp correcte (au sens du cours), notée par la suite Xpc.</li>
	<li>Relever la réponse indicielle pour Xp<sub>1</sub> = 1,2&times;Xpc, Xp<sub>2</sub> = Xpc et Xp<sub>3</sub> = 0,8&times;Xpc. La consigne passera de 30% à 60%.</li>
	<li>Compléter le tableau suivant :</li>
	
	<p><table class="blanc">
		<tr align="center"><td  width="40%"></td><td class="blanc">Xp<sub>1</sub></td><td class="blanc">Xp<sub>2</sub></td><td class="blanc">Xp<sub>3</sub></td></tr>
		<tr align="center"><td class="blanc">Erreur statique en %</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
		<tr align="center"><td class="blanc">Premier dépassement en %</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
		<tr align="center"><td class="blanc">Temps de réponse à &pm;5% en s</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
	</table></p>
</ol>

<h1>III. Action dérivée</h1>
<ol>
	<li>Déterminer la valeur de Td correcte (au sens du cours), notée par la suite Tdc.</li>
	<li>Relever la réponse indicielle pour Td<sub>1</sub> = 1,2&times;Tdc, Td<sub>2</sub> = Tdc et Td<sub>3</sub> = 0,8&times;Tdc. La consigne passera de 30% à 60%.</li>
	<li>Compléter le tableau suivant :</li>
	
	<p><table class="blanc">
		<tr align="center"><td  width="40%"></td><td class="blanc">Td<sub>1</sub></td><td class="blanc">Td<sub>2</sub></td><td class="blanc">Td<sub>3</sub></td></tr>
		<tr align="center"><td class="blanc">Erreur statique en %</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
		<tr align="center"><td class="blanc">Premier dépassement en %</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
		<tr align="center"><td class="blanc">Temps de réponse à &pm;5% en s</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
	</table></p>
</ol>


<h1>IV. Action intégrale</h1>
<ol>
	<li>Déterminer la valeur de Ti correcte (au sens du cours), notée par la suite Tic.</li>
	<li>Relever la réponse indicielle pour Ti<sub>1</sub> = 1,2&times;Tic, Td<sub>2</sub> = Tic et Td<sub>3</sub> = 0,8&times;Tic. La consigne passera de 30% à 60%.</li>
	<li>Compléter le tableau suivant :</li>
	
	<p><table class="blanc">
		<tr align="center"><td  width="40%"></td><td class="blanc">Ti<sub>1</sub></td><td class="blanc">Ti<sub>2</sub></td><td class="blanc">Ti<sub>3</sub></td></tr>
		<tr align="center"><td class="blanc">Erreur statique en %</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
		<tr align="center"><td class="blanc">Premier dépassement en %</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
		<tr align="center"><td class="blanc">Temps de réponse à &pm;5% en s</td><td class="blanc"></td><td class="blanc"></td><td class="blanc"></td></tr>
	</table></p>
</ol>

<h1>V. Conclusion</h1>
<ol>
	<li>Quelle méthode de réglage avez-vous utilisée ?</li>
	<li>Les résultats sont-ils en accord avec le cours ? Si non, donner les éléments de mesure de performance qui ne correspondent pas.</li>
	<li>Conclure sur l'efficacité de la méthode sur cette maquette.</li>
</ol>

<?php

	include("./Settings/bas.php");
?>	
