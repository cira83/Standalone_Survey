<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img3/Pression.gif" /></center>

<h1>I. Préparation</h1>
<ol>
<li>Compléter le schéma TI pour faire apparaître la boucle de régulation.</li>
<li>Donner le nom de la grandeur réglée, réglante et d'une grandeur perturbatrice. Placer ces grandeurs sur le schéma TI.</li>
<li>Donner et procéder au câblage électrique, pour un fonctionnement en régulation de pression.</li>
<li>Régler la consigne à 50%.</li>
<li>Compte tenu de l’appareillage utilisé, déterminer le sens d’action du régulateur et le justifier.</li>
<li>Régler le sens d'action du régulateur, on donnera le nom du paramètre modifié.</li>
<li>Régler le système pour que la pression se stabilise à environ 10% pour une commande de 0% de la vanne. Ne plus modifier le débit d'alimentation.</li>
<li>Réaliser un échelon de commande. La commande passera de 0 à 100%.</li>
<li>Le procédé est-il naturellement stable ou intégrateur ? Justifiez votre réponse.</li>
</ol>


<?php include ("./Methodes/regleur.php");?>
<?php

	include("./Settings/bas.php");
?>	
