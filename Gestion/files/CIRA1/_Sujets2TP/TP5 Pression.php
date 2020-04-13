<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img5/fonctionnel.png" /></center>

<h1>I. Généralités</h1>
<ol>
<li>Donner le nom de votre régulation.</li>
<li>Donner le nom d'une perturbation.</li>
<li>Placer sur le schéma fonctionnel la mesure X, la commande Y, la consigne W et la perturbation Z.</li>
<li>Sur le schéma fonctionnel, mettre en évidence le régulateur.</li>
<li>Placer sur le schéma, les éléments présents sur votre régulation (vanne, pompe, transmetteur, réservoir, réchauffeur...).</li>
</ol>


<h1>II. Étude du régulateur</h1>
<p class="orange">On désire à présent déterminer la structure de notre régulateur, la commande n'agit pas sur la mesure.</p>
<ol>
<li>Donner les trois structures des régulateurs PID.</li>
<li>Pour chacune des structures donner la fonction de transfert C(p). Le gain proportionnel sera noté A, le temps intégral Ti et le temps dérivé Td.</li>
<li>Régler le régulateur avec une action inverse. On donnera le nom du paramètre à régler.</li>
<li>Quel est le sens de variation de la commande Y (croissant ou décroissant) lorsque la consigne augmente ?</li>
<li>Régler la mesure, la consigne et la commande à 0%.</li>
<li>Régler le régulateur comme suit :</li>
<p><table class="blanc">
	<tr align="center"><td class="blanc">Xp en %</td><td class="blanc">Ti en s</td><td class="blanc">Td en s</td></tr>
	<tr align="center"><td class="blanc">200</td><td class="blanc">10</td><td class="blanc">0</td></tr>
</table></p>
<li>Relever la réponse à un échelon de consigne de 25% de la commande.</li>
<li>À partir de ce relevé déterminer la structure du régulateur (série ou parallèle).</li>
<li>Pourquoi ne peut-on pas déterminer si le régulateur à une structure série ou mixte ?</li>
<li>Régler la mesure, la consigne et la commande à 0%.</li>
<li>Régler le régulateur comme suit :</li>
<p><table class="blanc">
	<tr align="center"><td class="blanc">Xp en %</td><td class="blanc">Ti en s</td><td class="blanc">Td en s</td></tr>
	<tr align="center"><td class="blanc">200</td><td class="blanc">10</td><td class="blanc">10</td></tr>
</table></p>
<li>Relever la réponse à un échelon de consigne de 25% de la commande.</li>
<li>Relever la réponse à un échelon de mesure de 25% de la commande.</li>
<li>À partir de ces relevés déterminer la structure du régulateur (série ou parallèle ou mixte).</li>
<li>En déduire la fonction de transfert C(p) de votre régulateur.</li>
<li>Certains régulateurs ont une action dérivée sur la mesure, d’autre sur l’erreur. De quelle catégorie est votre régulateur ? Justifier votre réponse.</li>
<li>Quelle serait l’allure de la commande si il en était autrement ?</li>
</ol>





<?php

	include("./Settings/bas.php");
?>	
