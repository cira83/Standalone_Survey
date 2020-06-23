<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img3/eycon.jpg" /></center>
<p>Dans ce TP vous aller utiliser un superviseur Eycon 10, un appareil qui se programme avec Lintools, logiciel que vous utiliserez pleinement en CIRA 2.</p>
<p>Pour la mise en service et les dernières questions, veuillez consulter la documentation sur <a href="./img3/EYCON.pdf">l'EYCON 10</a>.</p>

<p>Dans la suite on note &epsilon; = w - x.</p>
<h1>I. Signaux</h1>
<table>
	<tr><td><img src="./img3/1.gif"></td><td><img src="./img3/2.gif"></td><td></td></tr>
	<tr><td>Signal <sub>1</sub> - S1(t)</td><td>Signal <sub>2</sub> - S2(t)</td><td></td></tr>
</table>
<ol>
	<li>Donner le nom de chacun des signaux.</li>
	<li>Donner la transformée de Laplace s<sub>1</sub>(p) et s<sub>2</sub>(p) de chacun des signaux.</li>
	<li>Proposer un enregistrement de la mesure x et la consigne w, qui fournisse une erreur conforme au signal 1. On n'agira que sur la mesure x.</li>
</ol>

<h1>II. Régulation proportionnelle</h1>
<ol>
	<li>Régler le PID pour une régulation avec un gain A=1 et un décalage de bande Y<sub>0</sub>=0. On donnera le nom des paramètres modifiés ainsi que leur valeur respective.</li>
	<li>Relever la commande du régulateur en réponse à un signal d'erreur correspondant au signal 1. On n'agira que sur la mesure x, y(0) = 0%.</li>
	<li>Exprimer la réponse obtenue y<sub>1</sub>(t) en fonction de s<sub>1</sub>(t) et s<sub>2</sub>(t).</li>
    <li>Justifier la réponse Y<sub>1</sub>(p) obtenue en utilisant la transformée de Laplace.</li>
	<li>Régler le PID pour une régulation avec un gain A=2 et un décalage de bande FF_PID=0. On donnera le nom des paramètres modifiés ainsi que leur valeur respective.</li>
	<li>Relever la commande du régulateur en réponse à un signal d'erreur correspondant au signal 1. On n'agira que sur la mesure x, y(0) = 0%.</li>
	<li>Exprimer la réponse obtenue y<sub>2</sub>(t) en fonction de s<sub>1</sub>(t) et s<sub>2</sub>(t).</li>
    <li>Justifier la réponse Y<sub>2</sub>(p) obtenue en utilisant la transformée de Laplace.</li>
</ol>

<h1>III. Régulation proportionnelle intégrale</h1>
<ol>
	<li>Régler le PID pour une régulation avec un gain A=1 et un temps intégral ti=10s.</li>
	<li>Relever la commande du régulateur en réponse à un signal d'erreur correspondant au signal 1. On n'agira que sur la mesure x, y(0) = 0%.</li>
	<li>Exprimer la réponse obtenue y<sub>3</sub>(t) en fonction de s<sub>1</sub>(t) et s<sub>2</sub>(t).</li>
    <li>Justifier la réponse Y<sub>3</sub>(p) obtenue en utilisant la transformée de Laplace.</li>
	<li>Régler le PID pour une régulation avec un gain A=2 et un temps intégral ti=10s.</li>
	<li>Relever la commande du régulateur en réponse à un signal d'erreur correspondant au signal 1. On n'agira que sur la mesure x, y(0) = 0%.</li>
	<li>Quelle est la structure du régulateur PI ? Justifier votre réponse.</li>
	<li>Quelle peut être la structure du régulateur PID ?</li>
	<li>Exprimer la réponse obtenue y<sub>4</sub>(t) en fonction de s<sub>1</sub>(t) et s<sub>2</sub>(t).</li>
    <li>Justifier la réponse Y<sub>4</sub>(p) obtenue en utilisant la transformée de Laplace.</li>
</ol>

<h1>IV. Régulation proportionnelle intégrale dérivée</h1>
<ol>
	<li>Régler le PID pour une régulation avec un gain A=2 et un temps intégral ti=10s et un temps dérivé td=10s.</li>
	<li>Relever la commande du régulateur en réponse à un signal d'erreur correspondant au signal 1. On n'agira que sur la mesure x, y(0) = 0%.</li>
	<li>Justifier pourquoi la réponse Y<sub>4</sub>(p) obtenue n'est pas une composition de S<sub>1</sub>(p) et S<sub>2</sub>(p) en utilisant la transformée de Laplace.</li>
	<li>Déduire de y<sub>4</sub>(t) la structure du régulateur. On fera apparaître toutes les constructions.</li>
</ol>


<?php

	include("./Settings/bas.php");
?>	
