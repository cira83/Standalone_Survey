<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
function LoadGif($imgname)
{
    /* Attempt to open */
    $im = @imagecreatefromgif($imgname);

    /* See if it failed */
    if(!$im)
    {
        /* Create a blank image */
        $im = imagecreatetruecolor (150, 30);
        $bgc = imagecolorallocate ($im, 255, 255, 255);
        $tc = imagecolorallocate ($im, 0, 0, 0);

        imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);

        /* Output an error message */
        imagestring ($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
    }

    return $im;
}

header('Content-Type: image/gif');

$image = LoadGif('temps.gif');//Taille de l'image 1028x772
$zerox = 20;
$zeroy = 772 - $zerox;

$red = imagecolorallocate ($image , 255, 0, 0 );//defini le rouge
$black = imagecolorallocate ($image , 0, 0, 0 );//defini le noir
$blue = imagecolorallocate ($image , 0, 0, 255 );//defini le bleu
$white = imagecolorallocate ($image , 255, 255, 255 );//defini le blanc
$pointilles = array($black, $black, $black, $white, $white, $white);//Defini le style pointilles

$Ligne = explode("#",$_SESSION['temps']);
$nb_pts = count($Ligne);

$DATA=explode(";", $Ligne[0]);
$x[0] = (float)$DATA[0];
$y[0] = (float)$DATA[2];
$miny = $y[0];
$maxy = $y[0];

$i=1;
while($i<$nb_pts)
{
	$DATA=explode(";", $Ligne[$i]);
	$x[$i] = (float)$DATA[0];
	$y[$i] = (float)$DATA[2];
	if($miny>$y[$i]) $miny = $y[$i];
	if($maxy<$y[$i]) $maxy = $y[$i];
	$i++;
}

//Quadrillage
$minx = 0;
$maxx = $x[$nb_pts-2];
$stepx = $maxx/10;
$puis = round(log10($stepx)-0.5);
$step_x = round($stepx/pow(10,$puis))*pow(10,$puis);
$newmax = $step_x;
while($maxx>$newmax) $newmax = $newmax + $step_x;
$maxx = $newmax;//Pour que la valeur maximale soit un nombre simple

$stepy = $maxy/10;
$puis = round(log10($stepy)-0.5);
$step_y = round($stepy/pow(10,$puis))*pow(10,$puis);
$newmax = $step_y;
while($maxy>$newmax) $newmax = $newmax + $step_y;
$maxy = $newmax;//Pour que la valeur maximale soit un nombre simple

//Calcul des échelles
$scalex = (1024-2*$zerox)/$maxx; 
$scaley = (772-2*$zerox)/$maxy;

$margedroite = $step_x*$scalex/4*3+$zerox;
$margebas = $step_y*$scaley/4+$zerox;

//Axes
imageline ($image , $zerox , $zeroy , 1024-$zerox , $zeroy , $black );
imagestring($image, 2, 1024-$margedroite, $zeroy-12, "0 %", $blue);

imageline ($image , $zerox , $zeroy , $zerox , $zerox , $black );
imagestringup($image, 2, $zerox-12, 772-$margebas, "0 s", $blue);

imagesetstyle($image, $pointilles);
//Verticales
$abscisse=$step_x;
while($maxx>=$abscisse) 
{
	$valeurx = $zerox + $abscisse*$scalex;
	imageline($image , $valeurx , $zeroy , $valeurx , $zerox , IMG_COLOR_STYLED );
	imagestringup($image, 2, $valeurx-12, 772-$margebas, "$abscisse s", $blue);
	$abscisse=$abscisse+$step_x;
}

//Horizontales
$ordonnee=$step_y;
while($maxy>=$ordonnee) 
{
	$valeury = $zeroy - $ordonnee*$scaley;
	imageline($image , $zerox , $valeury , 1024-$zerox , $valeury , IMG_COLOR_STYLED );
	imagestring($image, 2, 1024-$margedroite, $valeury-12, "$ordonnee %", $blue);
	$ordonnee = $ordonnee+$step_y;
}



$i=0;
while($i<$nb_pts)
{
	$x1 = $x2;
	$y1 = $y2;

	$x2 = $zerox + $x[$i]*$scalex;
	$y2 = $zeroy - $y[$i]*$scaley;
						
	if(($i>0)and($i<$nb_pts-1)) imageline($image , $x1 , $y1 , $x2 , $y2 , $red );
	$i++;
}	



imagegif($image);
imagedestroy($image);

?>