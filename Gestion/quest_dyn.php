<?php
	//Ancien fichier generation.php __________
	function information_real()
	{
		$inf = "La norme IEEE de&#769;finie le code de repre&#769;sentation d&apos;un nombre de&#769;cimal sur 32 bits (single) avec trois composantes ;</br>";
		$inf .= "<center><font color=\"blue\">x </font>";
		$inf .= "<font color=\"green\">xxxx xxxx </font>";
		$inf .= "<font color=\"yellow\">xxx xxxx xxxx xxxx xxxx xxxx</font></center>";
		
		$inf .= "<ul><li><font color=\"blue\">x, le bit de signe ;</font></li>";
		$inf .= "<li><font color=\"green\">xxxx xxxx, l'exposant sur 8 bits ;</font></li>";
		$inf .= "<li><font color=\"yellow\">xxx xxxx xxxx xxxx xxxx xxxx, la mantisse sur 23 bits.</font></li>";
		$inf .= "</ul>";
		
		return($inf);
	}
	
	
	function codec($chaine)
	{
		$retour="";
		for($i=0;$i<strlen($chaine);$i++) 
		{
			$askii = ord($chaine[$i]);
			$code = $askii^$i;
			$retour.=chr($code);
		}
		return($retour);
	}


	function hexa($valeur)
	{
		$res = dechex($valeur);
		
		return($res);
	}


	function bin($valeur)
	{
		$res = decbin($valeur);
		$chaine = "$res";
		while(strlen($chaine)<12) $chaine = "0".$chaine;
		$resultat = substr($chaine,0,4)." ".substr($chaine,4,4)." ".substr($chaine,8,4);
		return $resultat;
	}


	function bcd($valeur)
	{
		$chaine ="$valeur"; //pour convertir en chaine de caractères
		$res = "";
		$len = strlen($chaine);
		for($i=0;$i<$len;$i++)
		{
			$part = decbin(intval($chaine[$i]));
			$zeros = "";
			for($j=strlen($part);$j<4;$j++) $zeros.="0";
			if($i!=$len-1) $res.=$zeros.$part." ";
			else $res.=$zeros.$part;
		}
	
		return($res);
	}

	function espace($valeur) //mets un espace entre 4 bits
	{
		$chaine = substr("$valeur",0,-4)." ".substr("$valeur",4);
		return $chaine;
	}

	function comp2_8($valeur)
	{
		$comp = decbin(($valeur^255)+1);
	
		return(espace($comp));
	}	
	
	function real32($valeur)
	{
		$comp = decbin($valeur);
		$longueur = strlen($comp);
		$mantisse = substr($comp, 1);
		for($i=0;$i<$longueur-1;$i++)
		{
			$mantisse_txt .= $mantisse[$i];
			if($i==2) $mantisse_txt .=" ";
		}
		while($i<7)
		{
			$mantisse_txt .="0";
			$i++;
		}
		
		$exposant = espace(decbin(126 + $longueur));
		
		return "0 ".$exposant." ".$mantisse_txt;
	}
	
//Les 10 functions de génération de questions
	function question_bin_int()
	{
		$number1 = rand(256,1024);
		$valeur = bin($number1);
		$question = "<p><b>$valeur<sub>(2)</sub></b><br/> Donner la valeur du nombre cod&eacute; en binaire ci-dessus : <input type=\"text\" name=\"rep\"><p>\n";
		$reponse = $number1."\n";
			
		return($question.$reponse."<hr/>");
	}
	function question_bin()
	{
		$number1 = rand(256,1024);
		$question = "<p>Mettre <b>$number1</b> en binaire sous la forme xxxx xxxx xxxx ? <input type=\"text\" name=\"rep\"><p>\n";
		$reponse = bin($number1)."\n";
			
		return($question.$reponse."<hr/>");
	}
	
		
	function question_hexa(){
		$number1 = rand(256,1024);
		$question = "Mettre <b>$number1</b> en en hexa sous la forme xxx (lettres en minuscule).";
		$reponse = hexa($number1);
		return("$question:$reponse");
	}

	function question_hexa_int(){
		$number1 = rand(256,1024);
		$valeur = hexa($number1);
		$question = "Donner la valeur enti&egrave;re de <b>$valeur<sub>(16)</sub>.";
		$reponse = $number1;
		return("$question:$reponse");
	}
	
	function question_cc2(){
		$number1 = rand ( 3 , 126 );
		$question = "Mettre <b>-$number1</b> en code compl&eacute;ment &agrave; 2 - 8bits, sous la forme xxxx xxxx.";
		$reponse = comp2_8($number1);
		return("$question:$reponse");
	}
	
	function question_cc2_int(){
		$number1 = rand ( 25 , 126 );
		$valeur = comp2_8($number1);
		$question = "Donner la valeur décimale de <b>$valeur<sub>(CC2-8bits)</sub></b>.";
		$reponse = "-".$number1;
		return("$question:$reponse");
	}
	
	function question_bcd() {
		$number1 = rand ( 129 , 989 );
		$question = "Mettre <b>$number1</b> en code BCD sous la forme xxxx xxxx xxxx.";
		$reponse = bcd($number1);
		return("$question:$reponse");
	}	

	function question_bcd_int() {
		$number1 = rand ( 129 , 989 );
		$valeur = bcd($number1);
		$question = "Donner la valeur décimale de <b>$valeur<sub>(BCD)</sub></b>.";
		$reponse = $number1;
		return("$question:$reponse");
	}

	function question_float() {
		$number1 = rand ( 3 , 254 );
		//$question = information_real();
		$question = "Mettre <b>$number1</b> en code float32 sous la forme x xxxx xxxx xxx xxxx 0000 0000 0000 0000.";
		$reponse = real32($number1);
		return("$question:$reponse");
	}
	
	function question_decimal() {
		$number1 = rand ( 3 , 254 );
		$reponse = real32($number1);
		//$question = information_real();
		$question = "Donner la valeur décimale de <b>$reponse 0000 0000 0000 0000<sub>(float32)</sub></b>.";
		$reponse = $number1;
		return("$question:$reponse");
	}	
	
//Nouvelles fonction d'octobre 2017 ___________________________________________________
	function BCDQ($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_bcd());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}
	
	function DCBQ($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_bcd_int());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}
	
	function float_2017($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_float());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}	

	function decimal_2017($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_decimal());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}
		
	function int_2017($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_cc2_int());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}	

	function cc2_2017($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_cc2());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}
	
	function entier_2017($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_hexa_int());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}	
	
	function hexa_2017($chemin,$num){
		$fileQ = "$chemin/Q$num.txt";
		if(!file_exists($fileQ)){
			$part = explode(":", question_hexa());
			$laquestion = $part[0];
			$lareponse = $part[1];
			
			$fp = fopen($fileQ, "w");
			fwrite($fp, $laquestion);
			fclose($fp);
			$fp = fopen("$chemin/R$num.txt", "w");
			fwrite($fp, $lareponse);
			fclose($fp);
		}
		else {
			$fp = fopen($fileQ, "r");
			$laquestion = fgets($fp);
			fclose($fp);
		}
		return($laquestion);
	}
?>