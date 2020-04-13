<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img3/Aerotherm.png" /></center>





<h1>I. Schématisation</h1>

<table>
	<tr><td><font color="aqua" size="+1">Repère</font></td><td><font color="aqua" size="+1">Fonction</font></td><td><font color="aqua" size="+1">Numéro bornier (si disponible)</font></td></tr>
	<tr><td>TE1</td><td></td><td></td></tr>
	<tr><td>TT1</td><td></td><td></td></tr>
	<tr><td>TE2</td><td></td><td></td></tr>
	<tr><td>TT2</td><td></td><td></td></tr>	
	<tr><td>TAH1</td><td></td><td></td></tr>	
	<tr><td>TY1</td><td></td><td></td></tr>	
	<tr><td>SPY1</td><td></td><td></td></tr>	
	<tr><td>SPY2</td><td></td><td></td></tr>	

</table>



<ol>
	<li>Compléter le tableau ci-dessus en donnant la fonction des éléments repérés et le numéro de leur bornier.</li>
	<li>Compléter le schéma TI afin de faire apparaître la boucle de régulation de température. On utilisera la sonde PT100 pour mesurer la température.</li>
	<li>Proposer un schéma fonctionnel de la maquette. Vous ferez apparaître le numéro des borniers sur ce schéma.</li>
	<li>Expliquer le fonctionnement de la maquette en vous aidant du schéma fonctionnel.</li>
	<li>Donner le schéma électrique permettant le fonctionnement de la régulation. Ne pas oublier la ventilation (le sytème ne fonctionne pas sans la ventilation).</li>
	<li>Câbler la boucle de régulation, puis valider son fonctionnement en manuel. On donnera la procédure de vérification.</li>
</ol>

<h1>II. Régulation proportionnelle</h1>
<p>Le système fonctionnera avec une puissance de chauffe de 2 kW. La ventilation sera à son maximum.</p>
<ol>
	<li>Tracez la caractéristique statique de votre système. On prendra au moins 4 mesures.</li>
	<li>On choisit une consigne de 42 °C. Pour une bande de proportionnelle de 20 %, déterminer la valeur du décalage de bande pour avoir une erreur statique nulle en boucle fermée.</li>
	<li>Montrez graphiquement, en vous aidant de votre caractéristique statique, que votre réglage est correct.</li>
	<li>Procédez au réglage de votre régulateur avec les valeurs que vous avez déterminées. Vérifiez alors le point de fonctionnement obtenu.</li>
</ol>

<h1>III. Régulation PI</h1>
<ol>
	<li>Enregistrer la réponse à un échelon de commande, celle-ci passera de 20 à 60 %.</li>
	<li>Relever le temps de réponse T1 pour atteindre 64 % de l'amplitude de la variation de la mesure.</li>
	<li>Régler votre système avec une bande proportionnelle de 20 % et un temps intégral égal au temps de réponse déterminé précédemment.</li>
	<li>Relever les performances de votre régulation, temps de réponse à 5 %, valeur du premier dépassement, erreur statique.</li>
</ol>

<h1>IV. Régulation PID</h1>
<ol>
	<li>Comparer les performances de votre régulation pour plusieurs valeurs de l'action dérivée.<br> On prendra TD = T1, TD = T1/2, TD = T1/4.</li>
	<li>Conclure sur l'effet de l'action dérivée sur les performances d'une régulation.</li>
</ol>

















<?php

	include("./Settings/bas.php");
?>	
