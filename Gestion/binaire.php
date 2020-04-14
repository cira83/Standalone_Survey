<?php
/*
	function bcd($valeur){
	function hexa($valeur){
	function espace($valeur){ //mets un espace entre 4 bits 
	function comp2_8($valeur){
	function real32($valeur){
*/	
//Generation des question sur le codage
function bcd($valeur){
	$chaine ="$valeur"; //pour convertir en chaine de caractères
	$res = "";
	$len = strlen($chaine);
	for($i=0;$i<$len;$i++){
		$part = decbin(intval($chaine[$i]));
		$zeros = "";
		for($j=strlen($part);$j<4;$j++) $zeros.="0";
		if($i!=$len-1) $res.=$zeros.$part." ";else $res.=$zeros.$part;
	}
	return($res);
}

function hexa($valeur){
	$res = dechex($valeur);
	return($res);
}

function espace($valeur){ //mets un espace entre 4 bits 
	$chaine = substr("$valeur",0,-4)." ".substr("$valeur",4);
	return $chaine;
}

function comp2_8($valeur){
	$comp = decbin(($valeur^255)+1);
		return(espace($comp));
}	
	
function real32($valeur){
	$comp = decbin($valeur);
	$longueur = strlen($comp);
	$mantisse = substr($comp, 1);
	for($i=0;$i<$longueur-1;$i++){
		$mantisse_txt .= $mantisse[$i];
		if($i==2) $mantisse_txt .=" ";
	}
	while($i<7){
		$mantisse_txt .="0";
		$i++;
	}
		
	$exposant = espace(decbin(126 + $longueur));
		
	return "0 ".$exposant." ".$mantisse_txt;
}

?>