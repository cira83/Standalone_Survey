<script type="text/javascript">
function oui(lefichier){
	lien = './delfile.php?action=1&name='+lefichier;
	window.location.replace(lien);
}
function non(lefichier){
	lien = './appel.php';
	window.location.replace(lien);
}
</script>
<?php include("./haut.php");?>
<?php
	$action = $_GET[action];
	$filename15 = $_GET[name];
	
	if($action==0){
		echo("<table><tr><td>");
		echo("Voulez vous r&eacute;ellement supprimer le fichier : $filename15 ?  ");
		echo("<input type=\"button\" value=\"OUI\" onclick=\"oui('$filename15');\">");
		echo("<input type=\"button\" value=\"NON\" onclick=\"non('$filename15');\">");
		echo("</td></tr></table>");
	}
	
	if($action==1){
		$resultat = unlink($filename15);
		echo("<table><tr><td>");
		if($resultat) echo("Le fichier $filename15 a &eacute;t&eacute; supprim&eacute;");
		else echo("Impossible de supprimer le fichier $filename15 !!");
		echo("</td></tr></table>");
	}

	
?>
<?php include("./bas.php");?>