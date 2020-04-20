<?php 
	include("./haut.php");
?>
<?php
	include("diagramme.php");

	$dezero = ($largeurdelecran - 1060);
	if($dezero>0) $zerox = $dezero/2; else $zerox = 0;
	$zeroy = 100;

	$nomdufichier = $_GET['nomfichier'];
	$elts = explode("/", $nomdufichier);
	$epreuve = explode(".",$elts[count($elts)-1]);
	$epreuve[0]=str_replace("_", "", $epreuve[0]);
	tableau($epreuve[0]);
	
	if (!$fp = fopen($nomdufichier,"r")) 
	{
		echo "<center><h1>Echec de l'ouverture du fichier : $nomdufichier</h1></center>";
	}else
	{
		//echo("<center><h1>$nomdufichier</h1></center>");
		$i = 0;
		while(!feof($fp)) 
		{
			$ligne[$i] = fgets($fp);
			$i++;
		}
		if($ligne[0]!="\n") {
			$notes14 = explode(":", $ligne[0]);
			$participants = explode(":", $ligne[1]);

			$rk = 0;
			for($i=0;$i<count($notes14);$i++){
				$names = explode(" ", $participants[$i]);
				for($j=0;$j<count($names);$j++){
					$nom14[$rk]=$names[$j];
					$not14[$rk]=$notes14[$i];
					$rk++;
				}
			}
		}
		else {
			$nom14[0] = null;
			$not14[0] = null;	
		}
		//affiche($ligne[0]);affiche($ligne[1]);
		
		//afficheliste($nom14);
		//afficheliste($not14);
		echo("<table class=\"vide\"><tr><td></td></tr></table>");
		$decalage2 = isset($decalage) ? $decalage : 20;
 		$taille = diagramme($nom14,$not14,$zerox,$zeroy+$decalage2,$k);
	}

?>
<?php include("./bas.php");?>