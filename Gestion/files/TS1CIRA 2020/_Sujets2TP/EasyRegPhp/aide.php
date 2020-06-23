<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
$numero = session_id();//Numero des fichiers
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>EasyReg PHP</title>
<link href="./style.css" rel="stylesheet" media="all" type="text/css">
</head>
<body>
<div id="entete"><table ><tr align=center><td><font size="+3">EASYREG</font></td></tr></table></div>
<?php
	include("./menutab.php");
	menutab($numero,"Aide");
?>

<table class="clair"><tr><td>
<p class="titre">AIDE</p>
<p>Le menu est compos&eacute; de 9 &eacute;l&eacute;ments qui peuvent &ecirc;tre :</p>
<table class="petit"><tr><td width="100px">Non actif</td><td class="actif" width="100px">Actif</td><td class="prop" width="100px">Actif sugg&eacute;r&eacute;</td></tr></table>
<p>Il vous permettra de progresser et pour obtenir les graphes d&eacute;sir&eacute;s.</p>

<table class="unecase"><tr><td class="prop"><a href="./index.php?action=newfile">Nouveau fichier</a></td></tr></table>
<p>Avant de commencer, il faut d&eacute;finir un nouveau fichier qui contiendra la fonction de transfert en boucle ouverte de votre syst&egrave;me. Un num&eacute;ro de fichier vous sera donn&eacute; qui vous suivra le pendant votre s&eacute;ance.</p>
<table class="petitclair"><tr><td>
<img src="./TP2.gif"><img src="./TP.gif">
</td></tr></table>
<p>Les polyn&ocirc;mes N(p) et D(p) seront fournis factoris&eacute;s, le coefficient devant la variable p, la puissance derri&egrave;re. Le degr&eacute; maximum du polyn&ocirc;me est de 8. </p> <p>Exemples :</p>
<p>
1+p+p2+p3 = 1+p+p<sup>2</sup>+p<sup>3</sup><br/>
(1+p)4 = (1+p)<sup>4</sup><br/>	
5(1+p)(1+10p)2 = 5(1+p)(1+10p)<sup>2</sup>
</p>
<p>Le retard sera un nombre r&eacute;el positif.</p>
<p>La constante de temps sera une valeur estim&eacute;e de la constante de temps du syst&egrave;me en boucle ferm&eacute;e, elle servira au calcul des valeurs des points.</p>
<p>Apr&egrave;s avoir compl&eacute;t&eacute; le formulaire, il faut l'enregistrer.</p>

<table class="unecase"><tr><td class="prop"><a href="./aide.php?num=<?php echo($numero)?>">Enregistrer fichier</a></td></tr></table>
<p>Une fois enregistr&eacute;, vous aurez les informations relatif &agrave; l'interpretation du formulaire, qui sont n&eacute;cessaires aux calculs.</p>
<p>Vous pouvez corriger le formulaire, puis refaire une sauvegarde pour les enregistrer.</p>
<p>Une fois satisfait de l'interpr&eacute;tation, vous devez lancer les calculs.</p>

<table class="unecase"><tr><td class="prop"><a href="./aide.php?num=<?php echo($numero)?>">Faire les calculs</a></td></tr></table>
<p>Des &eacute;l&eacute;ments concernant les calculs, vous seront fournis, qui vous permettrons de juger de la pertinence de la valeur de la constante de temps.</p>
<p>Vous pouvez alors voir les tableaux ou les graphiques des r&eacute;sultats.</p>



</td></tr></table>


<?php 	include("./Setting/footer.php");?>