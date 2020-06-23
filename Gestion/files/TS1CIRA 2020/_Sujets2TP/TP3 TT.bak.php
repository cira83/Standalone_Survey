<?php 
	include("./Settings/haut.php");
?>


<h1>I. Régulation de température Mentor</h1>
<img src="img2/mentor.jpg" width="700p"/>
<p class="bleu">La maquette Mentor ci-dessus représentée a fait l'objet l'an dernier d'un projet CIRA de réparation. Vos camarades ont procédé au remplacement du convertisseur électrique. Un défaut électrique nous empêche de la faire fonctionner correctement. Je vous propose d'ajouter une mesure de température afin d'améliorer ses performances en boucle fermée.</p>

<ol>
	<li>À partir du schéma TI ci-dessus, proposer un schéma fonctionnel de la boucle de régulation où apparaît la perturbation de température.</li>
	<li>Placer sur le schéma TI le transmetteur de température à ajouter.</li>
	<li>Compléter le schéma électrique ci-dessous pour faire fonctionner la boucle de régulation représentée sur le schéma TI, ainsi que la mesure de température supplémentaire. TT2 sera connecté sur M2.</li>
	<img src="img2/mentor2.jpg" width="700p"/>
	
	<li>À quelles bornes du régulateur sont connectées les prise 1 et 2 ? (voir câblage sur la maquette)</li>
	<li>À quelles bornes du régulateur sont connectées les prise 3 et 4 ? (voir câblage sur la maquette)</li>

</ol>


<h1>II. Mesure de température</h1>
<p class="bleu">Pour mesurer la température on utilise un capteur de température PT100 associé à un transmetteur JUMO type 707011. Pour programmer et vérifier le transmetteur vous disposez d'une alimentation +15v/0V/-15V, d'un ordinateur, d'un calibrateur de boucle, d'une série de 4 boites à décades. </p>

<ol>
	<li>Quelle est la signification du nom PT100 ?</li>
	<li>Quel est le rôle du transmetteur dans une chaîne de mesure ?</li>
	<li>Proposer un schéma électrique permettant le paramètrage du transmetteur. Le régulateur sera utilisé pour mesurer le courant de boucle. <b class="bleu"> Faire valider le schéma par le professeur</b>.</li>
	<li>Dans le schéma ci-dessus quel élément remplace l'ampèremètre ?</li>
	<li>Programmer le transmetteur pour avoir :</li>
	<ul>
		<li>Un courant de 20 mA pour une température de 100 &deg;C ;</li>
		<li>Un courant de 0 mA pour une température de 0 &deg;C ;</li>
		<li>Un montage 2 fils ;</li>
		<li>Un temps de réponse le plus rapide possible.</li>
	</ul>
	<li>Procéder au réglage du zéro du transmetteur en modifiant la valeur de la résistance de ligne si nécéssaire.</li>
	<li>Compléter le tableau suivant :</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc" width="30%">Température théorique en &deg;C</td>
	<td class="blanc" width="10%">0</td>
	<td class="blanc" width="10%">20</td>	
	<td class="blanc" width="10%">40</td>
	<td class="blanc" width="10%">60</td>
	<td class="blanc" width="10%">80</td>
	<td class="blanc" width="10%">90</td>	
	<td class="blanc" width="10%">100</td>
	</tr>
	<tr align="center">
	<td class="blanc">Résistance lue sur le tableau</td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	</tr>

	<tr align="center">
	<td class="blanc">Résistance réglée sur les boites à décades</td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	</tr>
	
	<tr align="center">
	<td class="blanc">Température mesurée en &deg;C</td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	</tr>
	
	<tr align="center">
	<td class="blanc">Courant mesuré en mA</td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	<td class="blanc"></td>	
	<td class="blanc"></td>
	</tr>
</table></center>
	<li>Quelle est la classe de mesure du transmetteur de température TT2 (Plus grande erreur possible / Pleine échelle) ?</li>
	<li>Proposer un câblage permettant d'afficher la mesure de la température fournie par le transmetteur sur le régulateur 2604.</li>
	<li>Faire afficher la température de la salle sur le régulateur. Quelle est sa valeur ?</li>
</ol>



<?php

	include("./Settings/bas.php");
?>	
