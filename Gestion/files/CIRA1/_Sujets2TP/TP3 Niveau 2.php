<?php 
	include("./Settings/haut.php");
?>

<center><img src="./img3/Niveau.gif" /></center>
<h1>I. Préparation</h1>
<ol>
<li>Compléter le schéma TI pour faire apparaître la boucle de régulation e niveau. On ajoutera tous les éléments présents sur la maquette (convertisseur i/p, positionneur).</li>
<li>Proposer un schéma fonctionnel faisant apparaitre le correcteur C(p) ainsi que la fonction de transfert du procédé H(p).</li>
<li>Donner le nom de la grandeur réglée, réglante et d'une grandeur perturbatrice. Placer ces grandeurs sur le schéma TI.</li>
<li>Donner et procéder au câblage du régulateur.</li>
<li>Régler la consigne à 50%.</li>
<li>Compte tenu de l’appareillage utilisé, déterminer le sens d’action du régulateur et le justifier.</li>
<li>Régler le sens d'action du régulateur, on donnera le nom du paramètre modifié.</li>
<li>Régler le système pour que le niveau se stabilise à environ 50% pour une commande de 50% de la vanne. Ne plus modifier le débit d'alimentation.</li>
<li>Réaliser un échelon de commande. La commande passera de 50 à 40%.</li>
<li>Le procédé est-il naturellement stable ou intégrateur ? Justifiez votre réponse.</li>

</ol>

<?php include ("./Methodes/ziegler.php");?>


<?php

	include("./Settings/bas.php");
?>	

