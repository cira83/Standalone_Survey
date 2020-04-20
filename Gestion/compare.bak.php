<?php include("./haut.php");?>


<?php
	$mat = $_GET[mat];
	$epr_part = explode(".",$_GET[epr]);
	$epr = $epr_part[0];
	$laclasse = $_GET[classe];

	tableau("Je compare les copies $epr dans le r&eacute;pertoire $mat des $laclasse");

	$nomdufichiermdr = "./files/$classe/$mat/_mdr$epr.txt";
	$mdr_file = fopen($nomdufichiermdr, "r");
	$i = 0;
	while(!feof($mdr_file)){
		$ligne[$i] = fgets($mdr_file); 
		$i++;
	}

	$drap = false;
	
	//Création du tableau mdr:proprio
	$nb1 = 0;
	foreach($ligne as $eleve){
		$part = explode(" ", $eleve); //echo("<p>--$eleve</p>");
		$lg = count($part); //echo("<p>---$lg</p>");
		for($i=2;$i<$lg;$i++){
			$position = $i-1;
			$tab_liste[$nb1] = "$part[$position]:$part[0]"; //echo("<p>$tab_liste[$nb1]</p>");
			$nb1++;
		}
	}	
		
	echo("<p>*** $nb1 copie(s) vérifée(s) ***</p>");
		
	sort($tab_liste);
	for($i=0;$i<count($tab_liste);$i++) echo("<p>$tab_liste[$i]</p>");
	
	
	echo("<p>*******</p>");
		
	if($nb1>0) {
		$part = explode(":", $tab_liste[0]);
		$mdr[0] = $part[0];
		$same[0] = $tab_liste[0];
	}
	
	$nb2double = 0;
	for($i=1;$i<count($tab_liste);$i++){
		$part = explode(":", $tab_liste[$i]);
		if($part[0]==$mdr[$nb2double]){
			$drap = true;
			$same[$nb2double].=":$part[1]";
		}
		else {
			if($drap){
				$drap = false;
				$nb2double++;
			}
			$mdr[$nb2double] = $part[0];
			$same[$nb2double] = $tab_liste[$i];
		}
	}

	for($i=0;$i<count($same)-1;$i++){
		$laliste .= "<p>$same[$i]</p>";
	}
	if($drap) $laliste .= "<p>$same[$i]</p>";
	echo($laliste);
	
?>


<?php 	include("./bas.php");?>