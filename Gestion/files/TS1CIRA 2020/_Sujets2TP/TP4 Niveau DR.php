<?php 
	include("./Settings/haut.php");
?>
<center><p><img src="./img3/niveau_2.jpg" width="55%"></p></center>

<h1>I. Réglage du transmetteur de niveau</h1>
<ol>
	<li>Proposer un câblage électrique permettant le fonctionnement de la boucle de régulation et la communication avec un modem Hart. On rappelle qu'une résistance de 250 &Omega; est branchée en parallèle sur l'entrée mesure du régulateur.</li>
	<li>Valider le fonctionnement de la communication avec le transmetteur. On fournira une copie d'écran des réglages du transmetteur.</li>
	<li>Procéder au réglage du transmetteur pour qu'il affiche la mesure du niveau dans le réservoir supérieur. On détaillera la procédure utilisée.</li>
	<li>Tracer la caractéristique de votre transmetteur de niveau (mesure en % en fonction du niveau réel en %, au moins 5 mesures).</li>
</ol>

<h1>II. Régulation de niveau</h1>
<ol>
	<li>Régler les vannes manuelles afin d'avoir un niveau de 50% pour une commande de 50%. <u>Ne plus toucher ces vannes par la suite</u>.</li>
	<li>Relever la réponse indicielle du procédé pour une commande variant de 50% à 60%.</li>
	<li>Déduire de la courbe précédente le sens d'action du procédé. On fera un raisonnement complet.</li>
	<li>Déterminer le modèle de Broïda de votre procédé. On fera apparaitre toutes les constructions nécessaires et on utilisera la méthode simple.</li>
	<li>Á l'aide du simulateur <a href="./EasyRegPhp/">EasyReg</a>, déterminer le gain A du correcteur PI (on prendra Ti = &tau;) afin d'obtenir un temps de réponse le plus court possible, sans dépassement.</li>
	<li>Relever le temps de réponse à &pm;5%, ainsi que l'erreur statique de <u>la réponse théorique</u>.</li>
	<li>Programmer votre régulateur conformément au correcteur déterminé. On donnera les paramètres modifiés ainsi que leur valeur respective.</li>
	<li>Relever la réponse à un échelon de consigne de 50% à 60%.</li>
	<li>Relever le temps de réponse à &pm;5%, ainsi que l'erreur statique de la réponse réelle.</li>
	<li>Comparer les temps de réponse théorique et réel et expliquer leur différence si il y a lieu.</li>
</ol>

<h1>III. Alarme</h1>
<p>Afin de répondre aux questions suivantes, vous pouvez consulter <a href="img3/Manuel%202204%20et%202208.pdf">la documentation constructeur</a> du régulateur.</p>
<p>La maquette est équipée :<ul><li>D'un voyant vert LV;</li><li>D'un voyant rouge LR;</li><li>D'un bouton poussoir d'acquittement BP.</li></ul></p> 
<p>Le cahier des charges impose le fonctionnement suivant :</p>
<table class="blanc" >
	<tr><td><font color="yellow">Niveau</font></td><td><font color="yellow">LV</font></td><td><font color="yellow">LR</font></td></tr>
	<tr><td>&le;80%</td><td>1</td><td>0 si alarme acquittée</td></tr>
	<tr><td>&gt;80%</td><td>0</td><td>1</td></tr>
</table>


<ol>
	<li>Donner les équations logiques de LR et LV en fonction de &le;80%, &ge;80% et BP.</li>
	<li>Proposer un schéma de câblage électrique des voyants LR et LV et de BP. On s'aidera de la documentation sur le régulateur.</li>
	<li>Programmer le régulateur pour avoir un fonctionnement d'alarme correspondant au tableau ci-dessus. On donnera le nom et la valeur des paramètres modifiés.</li>
</ol>




<?php

	include("./Settings/bas.php");
?>	
