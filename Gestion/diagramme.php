<?php
//Les fonctions	
function truncate($text, $length)
{
   $trunc = (strlen($text)>$length)?true:false;

   if($trunc)
      return substr($text, 0, $length);
   else
      return $text;
}
	
function petitephotode2($nom)
{
	$classe = $_COOKIE['laclasse'];
	$photos="./files/$classe/_Photos/";

	
	$nom_txt = truncate($nom,10);//pour couillet en 2018
	$adr = $photos.$nom .".jpg";
	$image = "<a href=\"./eleve.php?nom=$nom\"><img src=\"$adr\"\ width=\"50px\"></a><br>$nom_txt";

	echo($image);
}

//---Le 25 11 2011
function ligne($note,$zerox,$zeroy)
{
 	$x = $zerox + 50*$note -15;
 	$y = $zeroy + 85 * 0;
	echo("<SPAN style=\"position: absolute; top: $y"."px; left: $x"."px;\">");
	echo("<img src=\"./ligne.jpg\"\>");//trace une ligne
	echo("</SPAN>");
	if($note<10) $x=$x+10; else $x=$x+7;
	$y=$y+400;	
	echo("<SPAN style=\"position: absolute; top: $y"."px; left: $x"."px;\">");
	echo($note);
	echo("</SPAN>");
}

function whitetable($zerox,$zeroy){
	$note = 0;
 	$x = $zerox + 50*$note -15;
 	$y = $zeroy + 85 * 0;
 	echo("<SPAN style=\"position: absolute; top: $y"."px; left: $x"."px;\">");
 	echo("<table class=\"blanc\"><tr><td></td></tr></table>");
 	echo("</SPAN>");
 		
}

function quadrillage($zerox,$zeroy)
{
 	ligne(0,$zerox,$zeroy);
 	ligne(2,$zerox,$zeroy);
 	ligne(4,$zerox,$zeroy);
 	ligne(6,$zerox,$zeroy);
 	ligne(8,$zerox,$zeroy);
	ligne(10,$zerox,$zeroy);
	ligne(12,$zerox,$zeroy);	
	ligne(14,$zerox,$zeroy);
	ligne(16,$zerox,$zeroy);
	ligne(18,$zerox,$zeroy);
	ligne(20,$zerox,$zeroy);
}

function diagramme($nom,$note,$zerox,$zeroy)
{
 	$liste2noms = "";
 	foreach($nom as $txt) $liste2noms.=" ".$txt;
 	
 	$x = $zerox;
 	$y = $zeroy - 40;
  	if($note) $nbEleves = count($note);
  	else $nbEleves = 0;
 	whitetable($zerox,$zeroy);
 	
 	$x = $zerox + 10;
 	$y = $zeroy + 200;

 	quadrillage($zerox,$zeroy);
 	$taille = 0;
 	$place = 1.2;
 	for ($i = 0; $i < $nbEleves; $i++) 
 	{
	 	$decal[$i]=0;
		for($j=0;$j<$i;$j++)
		{
			if(($note[$i]>$note[$j]-$place)and($note[$i]<$note[$j]+$place)) 
			{
				if($decal[$j]==$decal[$i]) {//modifié le 10/10/2015
					$decal[$i]=$decal[$j]+1;
					$j=0;
				}
			}
		}
		if($decal[$i]>$taille) $taille = $decal[$i];
		$x = $zerox + 50* floatval($note[$i]) ;
 		$y = $zeroy + 85*$decal[$i];
		echo("<SPAN style=\"position: absolute; top: $y"."px; left: $x"."px; background-color:#FFFFFF;\" >");
		if($note[$i]) petitephotode2($nom[$i]);//n'affiche que les élèves notés
		echo("</SPAN>");
	}
	return($taille);
}



?>