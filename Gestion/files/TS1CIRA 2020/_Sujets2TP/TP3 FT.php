<?php 
	include("./Settings/haut.php");
?>
<p class="orange">Schéma TI</p>
<img src="img2/debitcorti2.jpg"/>

<p class="orange">Schéma électrique</p>
<img src="img2/instrumentation.jpg"/>

<h1>I. Préréglages</h1>
<ol>
	<li>Rappeler dans un tableau le nom et la fonction des différents éléments repérés sur le schéma TI.</li>
	<li>Faire le lien entre le nom des transmetteurs sur le bornier et ceux sur le schéma TI.</li>
	<li>Sur quelle maquette avez-vous déjà rencontré cette instrumentation ?</li>
	<li>Le débit mesuré par FIT1 s'exprime en Nm<sup>3</sup>/h. Quelle est cette unité ? Est-ce un débit massique ou volumique ?</li>
	<li>Rappeler le principe de fonctionnement des trois transmetteurs, ainsi que leur étendue de mesure. On s'aidera de la documentation disponible.</li>
	<li>Compléter le schéma de câblage électrique de chaque transmetteur. Les transmetteurs intelligents devront pouvoir communiquer via un modem Hart et les mesures s'afficher sur le régulateur. La mesure de FIT2 sera connectée sur l'entrée An_Input.</li>
	<li>Paramètrer le transmetteur FIT2 à l'aide de <i>Fuji Hart Explorer</i> pour qu'il mesure la différence de pression &Delta;P en kPa sur sa pleine échelle.</li>
	<li>Ouvrir (2) au maximum (sans démonter), puis régler (7) pour avoir un débit de 20 Nm<sup>3</sup>/h.</li>
</ol>


<h1>II. Mesures</h1>
<ol>
	<li>En jouant sur l'élément 2, faire varier le débit et compléter le tableau. </li>

<center><table class="blanc">
	<tr align="center">
	<td class="blanc">FIT1</td>
	<td class="blanc">&Delta;P</td>
	<td class="blanc">&radic;&Delta;P</td>
	</tr>
	<tr align="center">
	<td class="blanc">0</td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">4</td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">8</td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">12</td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">16</td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">20</td>
	<td class="blanc"></td>
	<td class="blanc"></td>
	</tr>
</table></center>
	
	<li>Tracer les deux courbes sur le même graphique.</li>
	<li>En déduire les paramètres du transmetteur FIT2 pour qu'il affiche la mesure de débit en Nm<sup>3</sup>/h.</li>

<center><table class="blanc">
	<tr align="center">
	<td class="blanc">Type de sortie</td>
	<td class="blanc" width="50%"></td>
	</tr>
	<tr align="center">
	<td class="blanc">Type d’action (directe ou inverse)</td>
	<td class="blanc" width="50%"></td>
	</tr>
	<tr align="center">
	<td class="blanc">Temps de réponse</td>
	<td class="blanc" width="50%">1s</td>
	</tr>
	<tr align="center">
	<td class="blanc">Unité physique primaire</td>
	<td class="blanc" width="50%">kPa</td>
	</tr>
	<tr align="center">
	<td class="blanc">Valeur basse de l’étendue de mesure</td>
	<td class="blanc" width="50%"></td>
	</tr>
	<tr align="center">
	<td class="blanc">Valeur haute de l’étendue  de mesure</td>
	<td class="blanc" width="50%"></td>
	</tr>
	<tr align="center">
	<td class="blanc">Unité secondaire</td>
	<td class="blanc" width="50%">Nm<sup>3</sup>/h</td>
	</tr>
	<tr align="center">
	<td class="blanc">Valeur secondaire basse</td>
	<td class="blanc" width="50%"></td>
	</tr>
	<tr align="center">
	<td class="blanc">Valeur secondaire haute</td>
	<td class="blanc" width="50%"></td>
	</tr>
	<tr align="center">
	<td class="blanc">Fonction de sortie du transmetteur</td>
	<td class="blanc" width="50%"></td>
	</tr>
</table></center>

	<li>Régler le régulateur pour que la mesure de FIT2 s'affiche en en Nm<sup>3</sup>/h.</li>
	<li>Compléter le tableau d'étalonnage de votre transmetteur.</li>
<center><table class="blanc">
	<tr align="center">
	<td class="blanc">FIT1</td>
	<td class="blanc">FIT2</td>
	</tr>
	<tr align="center">
	<td class="blanc">0</td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">4</td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">8</td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">12</td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">16</td>
	<td class="blanc"></td>
	</tr>
	<tr align="center">
	<td class="blanc">20</td>
	<td class="blanc"></td>
	</tr>
</table></center>	
	
	<li>Tracer la courbe d'étalonnage.</li>
	<li>Quelle est la classe de mesure du capteur de débit FIT2 (Plus grande erreur possible / Pleine échelle) ?</li>
</ol>


<h1>III. Modélisation</h1>
<p class="orange">On a l'habitude de dire que dans un capteur de débit à organe déprimogène, on a la relation Q<sub>{Nm<sup>3</sup>/h}</sub>=k&times;&radic;&Delta;P<sub>{kPa}</sub>.</p>
<ol>
	<li>Déterminer la valeur de k de l'organe déprimogène de cette maquette.</li>
</ol>

<?php

	include("./Settings/bas.php");
?>	
