<?php
session_start();

function LoadPNG($imgname)
{
    /* Tente d'ouvrir l'image */
    $im = @imagecreatefrompng($imgname);

    /* Traitement en cas d'échec */
    if(!$im)
    {
        /* Création d'une image vide */
        $im  = imagecreatetruecolor(700, 30);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 700, 60, $bgc);

        /* On y affiche un message d'erreur */
        imagestring($im, 3, 5, 5, "Erreur de chargement de l'image PNG", $tc);
        imagestring($im, 3, 5, 15, $imgname, $tc);
    }

    return $im;
}

function LoadJPG($imgname)
{
    /* Tente d'ouvrir l'image */
    $im = @imagecreatefromjpeg($imgname);

    /* Traitement en cas d'échec */
    if(!$im)
    {
        /* Création d'une image vide */
        $im  = imagecreatetruecolor(700, 30);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 700, 60, $bgc);

        /* On y affiche un message d'erreur */
        imagestring($im, 3, 5, 5, "Erreur de chargement de l'image JPG", $tc);
        imagestring($im, 3, 5, 15, $imgname, $tc);
    }

    return $im;
}

function ecrire_question($image, $quest, $reps, $unit1, $unit2){//$champs[0]=question $champs[>0]=reponses
	$tc  = imagecolorallocate($im, 0, 0, 0);//Noir
	imagestring($image, 50, 10, 65, $quest.$unit1, $tc);
	for($i=0;$i<3;$i++) imagestring($image, 50, 30, 95+30*$i, $reps[$i].$unit2, $tc);
	for($i=0;$i<3;$i++) imagestring($image, 50, 390, 95+30*$i, $reps[$i+3].$unit2, $tc);
	return($image);
}

function elt2($elt,$liste){
	$drap = false;
	for($i=0;$i<count($liste);$i++) if($elt==$liste[$i]) $drap = true;
	return $drap;
}

function letter2number($letter){
	$number = 0;
	if($letter=="A") $number = 0;
	if($letter=="B") $number = 1;
	if($letter=="C") $number = 2;
	if($letter=="D") $number = 3;
	if($letter=="E") $number = 4;
	if($letter=="F") $number = 5;
	return $number;
}

include("./binaire.php");//Fonction pour les question sur le chapitre codage

$nom2image = $_SESSION['nom2image'];
$labonne_reponse = $_SESSION['reponse'];

$part = explode(".", $nom2image);
$ext = $part[count($part)-1];


if($ext=="jpg") {
	header('Content-Type: image/jpeg');
	$img = LoadJPG($nom2image);
	imagejpeg($img);
	imagedestroy($img);
}
	
if($ext=="png") {
	header('Content-Type: image/png');
	$img = LoadPNG($nom2image);
	imagepng($img);
	imagedestroy($img);
}


//-------------------- QUESTIONS DYNAMIQUES -------------------------- 
if($ext=="din") {//Extention pour les images dynamiques - A mettre dans le fichier d'exercice à la place de png
	header('Content-Type: image/png');
	$image_name .= $part[0];
	for($i=1;$i<count($part)-1;$i++) $image_name .= ".$part[$i]";
	$image_name .= ".png";
	$img = LoadPNG($image_name);
	
	$part2 = explode("/", $part[count($part)-2]);
	$type2question = $part2[count($part2)-1];
	
	if(($type2question=="BCD")||($type2question=="DCB")){
		for($i=0;$i<6;$i++){
			$new = rand (129,989);
			while(elt2($new,$champs)) $new = rand (129,989);
			$champs[$i] = $new;
			$reponse[$i] = bcd($champs[$i]);
		}
		
		if($type2question=="BCD") $img = ecrire_question($img, $champs[letter2number($labonne_reponse)], $reponse," (10)", " (BCD)");
		if($type2question=="DCB") $img = ecrire_question($img, $reponse[letter2number($labonne_reponse)], $champs," (BCD)"," (10)");
	}

	if(($type2question=="CC2")||($type2question=="2CC")){
		for($i=0;$i<6;$i++){
			$new = rand (3,125 );
			while(elt2($new,$champs)) $new = rand (129,989);
			$champs[$i] = "-".$new;
			$reponse[$i] = comp2_8($new);
		}
		
		if($type2question=="CC2") $img = ecrire_question($img, $champs[letter2number($labonne_reponse)], $reponse," (10)", " (CC2)");
		if($type2question=="2CC") $img = ecrire_question($img, $reponse[letter2number($labonne_reponse)], $champs," (CC2)"," (10)");
	}

	if(($type2question=="2HEX")||($type2question=="HEX2")){
		for($i=0;$i<6;$i++){
			$new = rand (125,255);
			while(elt2($new,$champs)) $new = rand (129,989);
			$champs[$i] = $new;
			$reponse[$i] = hexa($champs[$i]);
		}
		
		if($type2question=="HEX2") $img = ecrire_question($img, $champs[letter2number($labonne_reponse)], $reponse," (10)", " (HEX)");
		if($type2question=="2HEX") $img = ecrire_question($img, $reponse[letter2number($labonne_reponse)], $champs," (HEX)"," (10)");
	}

	if(($type2question=="2F32")||($type2question=="F322")){
		for($i=0;$i<6;$i++){
			$new = rand (125,255);
			while(elt2($new,$champs)) $new = rand (129,989);
			$champs[$i] = $new;
			$reponse[$i] = real32($champs[$i])." 0..";
		}
		
		if($type2question=="2F32") $img = ecrire_question($img, $champs[letter2number($labonne_reponse)], $reponse," (10)", " (Float 32)");
		if($type2question=="F322") $img = ecrire_question($img, $reponse[letter2number($labonne_reponse)], $champs," (Float 32)"," (10)");
	}
	
	imagepng($img);
	imagedestroy($img);
}


?>