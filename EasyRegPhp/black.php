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



$image = LoadGif('black.gif');//Taille de l'image 1028x772
//Milieu gauche-bas (513,320)
//Echelle x : 58pts pour 20°
//Echelle y : -74pts pour 5db

$red = imagecolorallocate ($image , 255, 0, 0 );//defini le rouge

//ouvrir le fichier des résultats
$Ligne = explode("#",$_SESSION['black']);
$nb_pts = count($Ligne);
$i=0;
while($i<$nb_pts)
{
	$x1 = $x2;
	$y1 = $y2;
				
	$DATA=explode(";", $Ligne[$i]);
	$mod = (float)$DATA[1];
	$arg = (float)$DATA[2];
	$x2 = ($arg + 180)*2.85 + 513;
	$y2 = -$mod*74/5 + 320;
						
	if(($i>0)and($i<$nb_pts-1)) imageline ($image , $x1 , $y1 , $x2 , $y2 , $red );
	$i++;
}	
	

imagegif($image);
imagedestroy($image);

?>