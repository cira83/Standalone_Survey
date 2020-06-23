<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
	$numero = session_id();//Numero des fichiers 
	include("./menutab.php");
	
	$action = $_GET[action];//Action fournie par le menu
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>EasyReg PHP</title>
<link href="./style.css" rel="stylesheet" media="all" type="text/css">
	
  <script type="application/javascript">
	
    function draw() {
		var ctx = document.getElementById('canvas').getContext('2d');
		var img = new Image();
		var QR = new Image();
		
		QR.src = './QRCode.png';
		
		<?php
			$elts = explode("#",$_SESSION['transfert']);
			$N = $elts[0];
			$D = $elts[1];
			$R = $elts[2];
		
			echo("var NP = \"$N\"\n");
			echo("var DP = \"$D\"\n");
			echo("var RP = \"$R\"\n");
			
			if($action=="black") 
			{
				echo("img.src = './black.gif';\n");
				echo("var quadrillage = 0;\n");
				
				//ouvrir le fichier des résultats
				$Ligne = explode("#",$_SESSION['black']);
				$nb_pts = count($Ligne);
				echo("var nbmax = $nb_pts;\n");
				
				$i=0;
				while($i<$nb_pts)
				{
					$DATA=explode(";", $Ligne[$i]);
					$mod = (float)$DATA[1];
					$arg = (float)$DATA[2];
					$X[$i] = ($arg + 180)*2.85 + 513;
					$Y[$i] = -$mod*74/5 + 320;	
					$i++;
				}	
				
				echo("var X = [");
				for($i=0;$i<$nb_pts-1;$i++) echo($X[$i].",");
				echo($X[$nb_pts-1]."];\n");

				echo("var Y = [");
				for($i=0;$i<$nb_pts-1;$i++) echo($Y[$i].",");
				echo($Y[$nb_pts-1]."];\n");
				
				$legende = "Diagramme de Black en boucle ouverte";
				

			}
			if($action=="temps")
			{
				echo("img.src = './temps.gif';\n");
				echo("var quadrillage = 1;\n");
				
				$zerox = 20;
				$zeroy = 772 - $zerox;
				
				echo("var zerox = $zerox;\n");
				echo("var zeroy = $zeroy;\n");
				
				//ouvrir le fichier des résultats
				$Ligne = explode("#",$_SESSION['temps']);
				$nb_pts = count($Ligne);
				echo("var nbmax = $nb_pts;\n");
				
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
				$X_val = "[0,$step_x";
				$newmax = $step_x;
				while($maxx>$newmax) 
				{
					$newmax = $newmax + $step_x;
					$X_val .= ",$newmax";
				}
				$X_val .= "]";
				$maxx = $newmax;
				echo("var X_val=$X_val;\n");
				
				$stepy = $maxy/10;
				$puis = round(log10($stepy)-0.5);
				$step_y = round($stepy/pow(10,$puis))*pow(10,$puis);
				$Y_val = "[0,$step_y";
				$newmax = $step_y;
				while($maxy>$newmax) 
				{
					$newmax = $newmax + $step_y;
					$Y_val .= ",$newmax";
				}
				$Y_val .= "]";
				$maxy = $newmax;
				echo("var Y_val=$Y_val;\n");
				
				//Calcul des échelles
				$scalex = (1024-2*$zerox)/$maxx; echo("var scalex = $scalex;\n");
				$scaley = (772-2*$zerox)/$maxy; echo("var scaley = $scaley;\n");
								
				$margedroite = $step_x*$scalex/4*3+$zerox; 
				echo("var margedroite = $margedroite;\n");
				$margebas = $step_y*$scaley/4+$zerox;
				echo("var margebas = $margebas;\n");
				
				//Les points de la courbes
				$i=0;
				while($i<$nb_pts)
				{
					$XX[$i] = $zerox + $x[$i]*$scalex;
					$YY[$i] = $zeroy - $y[$i]*$scaley;
					$i++;
				}	
				
				echo("var X = [");
				for($i=0;$i<$nb_pts-1;$i++) echo($XX[$i].",");
				echo($XX[$nb_pts-1]."];\n");

				echo("var Y = [");
				for($i=0;$i<$nb_pts-1;$i++) echo($YY[$i].",");
				echo($YY[$nb_pts-1]."];\n");
				
				$legende = "  Réponse indicielle en boucle fermée";
			}

			
		?>		
		
		
		img.onload = function()
		{
			ctx.drawImage(img,0,0);
			
			ctx.beginPath();
			
			ctx.moveTo(X[0],Y[0]);
			for (var i = 1; i < nbmax-1; i++)
			{
				ctx.lineTo(X[i],Y[i]);
			}
			
			ctx.lineWidth = 2;
			ctx.strokeStyle = '#00aa00';//Couleur de la courbe
			ctx.stroke();

			ctx.closePath();
			
		
			ctx.font = "12px Helvetica";
			ctx.fillStyle = "Black";
			
			
			
			
			if(quadrillage==1)
			{
				ctx.beginPath();
				
				ctx.moveTo(zerox,772-zeroy);
				ctx.lineTo(zerox , zeroy);
				ctx.lineTo(1024-zerox , zeroy);
    								
				ctx.lineWidth = 2;
				ctx.strokeStyle = "Black";
				ctx.stroke();
				ctx.closePath();
				
				ctx.beginPath();
				ctx.lineWidth = 1;
				indice = 1;
				while(indice<X_val.length)
				{
					valeurx = zerox + X_val[indice]*scalex;
					ctx.moveTo(valeurx , zeroy);
					ctx.lineTo(valeurx , 772-zeroy);
					if(indice<X_val.length-1) ctx.fillText(X_val[indice]+" s", valeurx-4, 770-zeroy);
					indice++;
				}
				indice = 1;
				while(indice<Y_val.length)
				{
					valeury = zeroy - Y_val[indice]*scaley;
					ctx.moveTo(zerox , valeury);
					ctx.lineTo(1024-zerox , valeury);
					ctx.fillText(Y_val[indice]+" %", zerox+4, valeury-2);
					indice++;

				}
				ctx.setLineDash([4, 2]);
				ctx.stroke();
				ctx.closePath();
				
				coinx = 664;
				coiny = 500;				

			} else {
				coinx = 110;
				coiny = 150;
				
			}
			

			
			// Rectangle infos
			ctx.fillStyle = '#FFFFFF';
			ctx.fillRect(coinx, coiny,220,115);
			ctx.fillStyle = '#000000';
			ctx.fillText("<?php echo($numero);?>", coinx + 5, coiny + 10);
			ctx.fillText("N(p) = "+NP, coinx + 5, coiny + 30);
			ctx.fillText("D(p) = "+DP, coinx + 5, coiny + 50);
			ctx.fillText("R = "+RP, coinx + 5, coiny + 70);
			ctx.fillText("<?php echo($legende);?>", coinx + 5, coiny + 90);
			ctx.fillStyle = '#DDDDDD';
			ctx.fillText("Clic-droit pour enregistrer l'image",coinx + 20,coiny + 110);
			
			ctx.drawImage(QR,935,680);
			
			
			// save canvas image as data url (png format by default)
			var dataURL = canvas.toDataURL();
			// set canvasImg image src to dataURL
			// so it can be saved as an image
			document.getElementById('canvasImg').src = dataURL;
			
  		}
  	
  		
  		
  		
  }  
  </script>
</head>





<body onload="draw();">
<table ><tr align=center><td><font size="+3"><a href="./index.php">EASYREG</a></font></td></tr></table>


<?php
	//liste des constantes
	$suffix = ".txt";//Suffix de tous les fichiers
	$repertoire = "./files/";//Emplacement des fichiers
	$schem = "S"; //T(p)
	$modarg = "B";//liste des points
	$temporel = "T";//reponse tempo
	$reglages = "R";//Réglages pour les calculs
	$calc = "C";

	//POUR LE GRAPHIQUE DE BLACK
	$px0 = 512;	$py0 = 384;
	$scalex = 1024/360;
	$scaley = 15;

	
	$N = $_POST[N];//Numerateur de T(p)
	$D = $_POST[D];//Denominateur de T(p)
	$R = $_POST[R];//Valeur du retard en s
	$T = $_POST[T];//Valeur de la constante de temps

/*-----------------------------------------------------------------      Liste des Fonctions disponibles
function menutab($numero) //Remplacé par include("./menutab.php");
function coefpoly($poly) -- Donne les coefs du polynome
function multpoly($poly1,$poly2) -- Multiplie 2 polynomes 
function addpoly($poly1,$poly2) -- Additionne 2 polynomes 
function calculpoly($poly) -- Entrée un polynome sous format texte ; Sortie un polynome sous format texte, les coefs par ordre croissant séparés par des ;
function formulaire($N,$D,$R,$numero,$T)
function lecturepoly($_SESSION['transfert'])
function lectureN($nomdufichier) -- Retourne le numérateur (ligne 6 du fichier) sous forme de liste des coef séparé par des ;
function lectureD($nomdufichier) -- Retourne le denominateur (ligne 7 du fichier) sous forme de liste des coef séparé par des ;
function module($Z,$omega,$angle) -- Module du polynome donné par coef croissant $angle==0 module ; $angle!=0 argument
function plot($x,$y)
function Trans_Z($polyP,$Te) -- Fourni un polynome en z, coefs par ordre croissant séparés par des ;
function choixTe($te) -- Pour avoir un pas d'échelle sympas
function $calculTe($NumPoly,$DenPoly) -- Calcul du Te pour transformée en Z
function tableauCoef($poly,$text) -- Bel affichage des polynomes

-----------------------------------------------------------------      Liste des variables globales
$_SESSION['calcul'] = Tableau HTML fournissant les informations résultants des calculs
$_SESSION['black'] = Points du diagramme de Black séparés par #
$_SESSION['temps'] = Points du diagramme de temporel séparés par #
$_SESSION['transfert'] = Fonction de transfert

___________________________________________________________________________________________________________________________________________________
                                                                                      LES FONCTIONS
___________________________________________________________________________________________________________________________________________________
*/


	function coefpoly($poly) //donne les coefs du polynome
	{
		$nbcoef = 9;//puissance MAX
		
		for($i=0;$i<$nbcoef+1;$i++) $coef[$i]=0;
		$p = explode("+", $poly);//On coupe aux + Attention pas de -
		$nb = count($p);
		for($i=0;$i<$nb;$i++)
		{
			$p2 = explode("p", $p[$i]);//On coupe aux p
			$nb1 = count($p2);//normalement 1 ou 2
			if($nb1==1) 
			{
				//echo("$p2[0]*");
				$degre = 0;
				$valeur = $p2[0];
				if($valeur==0) $valeur = 1;
				$coef[$degre] = $coef[$degre] + $valeur;
			}
			if($nb1==2) 
			{
				//echo("$p2[0]/$p2[1]-");
				$degre = intval($p2[1]);
				if($degre==0) $degre = 1;
				$valeur = $p2[0];
				if($valeur==0) $valeur = 1;
				$coef[$degre] = $coef[$degre]+$valeur;
			}
		}
		$coefpoly = $coef[0];
		for($i=1;$i<$nbcoef;$i++) $coefpoly .= ";".$coef[$i];
		
		return($coefpoly);
	}	

	function multpoly($poly1,$poly2)//Multiplie 2 polynomes 
	{
		$nbcoef = 9;//puissance MAX
		
		$poly1_tab = explode(";", $poly1);
		$poly2_tab = explode(";", $poly2);
		$imax = count($poly1_tab);
		$jmax = count($poly2_tab);
		for($i=0;$i<$imax;$i++)
		{
			for($j=0;$j<$jmax;$j++)
			{
				$coef[$i+$j]=$coef[$i+$j]+$poly1_tab[$i]*$poly2_tab[$j];
			}
		}
		
		$coefpoly = $coef[0];
		for($i=1;$i<$nbcoef;$i++) $coefpoly .= ";".$coef[$i];
		
		return($coefpoly);		
	}

	function addpoly($poly1,$poly2)//Additionne 2 polynomes 
	{
		$nbcoef = 9;//puissance MAX
		
		$poly1_tab = explode(";", $poly1);
		$poly2_tab = explode(";", $poly2);
		for($i=0;$i<$nbcoef;$i++)
		{
			$coef[$i] = $poly1_tab[$i]+$poly2_tab[$i];
		}
		
		$coefpoly = $coef[0];
		for($i=1;$i<$nbcoef;$i++) $coefpoly .= ";".$coef[$i];
		
		return($coefpoly);		
	}


	function calculpoly($poly)
	//Entrée un polynome sous format texte ; Sortie un polynome sous format texte, les coefs par ordre croissant séparées par des ;
	{
		
		$part1 = explode("(", $poly);
		$nb1 = count($part1);
		$resultat = "";
		if($nb1==1)
		{
			$resultat = coefpoly($part1[0]);
		}
		else
		{
			$part2 = explode(")", $part1[0]);
			if($part2[0]=="") $premier="1;0;0;0;0;0;0;0;0";
			else $premier = coefpoly($part2[0]);
			for($i=1;$i<$nb1;$i++)
			{
				$part2 = explode(")", $part1[$i]);
				$nb2 = count($part2);//pour voir si utilisation de puissance ; exemple (1+p)2
				if($part2[1]=="")
				{
					$suite = coefpoly($part2[0]);
					$premier = multpoly($premier,$suite);
				}
				else
				{
					$suite = coefpoly($part2[0]);
					for($j=0;$j<$part2[1];$j++)
					{
						$premier = multpoly($premier,$suite);
					}
				}
			}
			$resultat .= $premier;
		}
		return ($resultat);
	}
	
	
	function calculpoly_bak($poly) //BAK le 12 juin 2014
	{
		$part = explode(")(", $poly);
		$nb = count($part);
		if($nb<2)
		{
			$resultat = coefpoly($poly);
		}
		else
		{
			$part[0] = str_replace("(", "", $part[0]);
			$premier = coefpoly($part[0]);
			for($i=1;$i<$nb;$i++)
			{
				if($i==$nb-1) $part[$i] = str_replace(")", "", $part[$i]);
				$suite = coefpoly($part[$i]);
				$premier = multpoly($premier,$suite);
			}			
			$resultat= $premier;	
		}
		return ($resultat);
	}
	
	function formulaire($N,$D,$R,$numero,$T)
	{
		$formulaire = "<table class=\"clair\"><tr><td>";
		$formulaire .= "<h3>Donner la fonction de transfert en boucle ouverte :</h3>";
		$formulaire .= "<p><center><img src=\"./TP.gif\"></center></p>";
		$formulaire .= "<form action=\"./index.php?num=$numero&action=save\" method=\"POST\" name=\"systeme\">";
		$formulaire .= "<p>N(p) = <input type=\"text\" name=\"N\" value=\"$N\" size=\"100\"></p>";
		$formulaire .= "<p>D(p) = <input type=\"text\" name=\"D\" value=\"$D\" size=\"100\"></p>";
		$formulaire .= "<p>R = <input type=\"text\" name=\"R\" value=\"$R\"></p>";
		$formulaire .= "<p>Constante de temps pour le calcul (en s) <input type=\"text\" name=\"T\" value=\"$T\"></p>";
		$formulaire .= "</form>";
		$formulaire .= "</td></tr></table>";
		
		return($formulaire);		
	}

	function lecturepoly($polynometxt)
	{
		
		$elts = explode("#",$polynometxt);
		$N = $elts[0];
		$D = $elts[1];
		$R = $elts[2];
		$T = $elts[3];
 		
		if($N!="") $formulaire = formulaire($N,$D,$R,$numero,$T);
		else $formulaire = "VIDE";
	
		return($formulaire);
	}
	
	function lectureN($nomdufichier)//retourne le numérateur (ligne 6 du fichier) sous forme de liste des coef séparé par des ;
	{
		$fp = fopen("$nomdufichier","r");
		$N = fgets($fp,255);		
		$D = fgets($fp,255);
		$R = fgets($fp,255);
		$T = fgets($fp,255);
		$Te = fgets($fp,255);
		$Num = 	fgets($fp,255);
		fclose($fp);
		
		return ($Num);
	}

	function lectureD($nomdufichier)//retourne le denominateur (ligne 7 du fichier) sous forme de liste des coef séparé par des ;
	{
		$fp = fopen("$nomdufichier","r");
		$N = fgets($fp,255);		
		$D = fgets($fp,255);
		$R = fgets($fp,255);
		$T = fgets($fp,255);
		$Te = fgets($fp,255);
		$Num = 	fgets($fp,255);
		$Den = fgets($fp,255);
		fclose($fp);
		
		return ($Den);
	}
	
	function lectureNZ($nomdufichier)//retourne le numérateur Z (ligne 6 du fichier) sous forme de liste des coef séparé par des ;
	{
		$fp = fopen("$nomdufichier","r");
		$N = fgets($fp,255);		
		$D = fgets($fp,255);
		$R = fgets($fp,255);
		$Num = 	fgets($fp,255);
		$Den = fgets($fp,255);
		$NZ = fgets($fp,255);
		fclose($fp);
		
		return ($NZ);
	}
	
	function lectureDZ($nomdufichier)//retourne le denominateur Z (ligne 7 du fichier) sous forme de liste des coef séparé par des ;
	{
		$fp = fopen("$nomdufichier","r");
		$N = fgets($fp,255);		
		$D = fgets($fp,255);
		$R = fgets($fp,255);
		$Num = 	fgets($fp,255);
		$Den = fgets($fp,255);
		$NZ = fgets($fp,255);
		$DZ = fgets($fp,255);
		fclose($fp);
		
		return ($DZ);
	}	
	

	function lectureR($nomdufichier)//retourne la valeur du retard
	{
		$fp = fopen("$nomdufichier","r");
		$N = fgets($fp,255);		
		$D = fgets($fp,255);
		$R = fgets($fp,255);
		fclose($fp);
		
		return ($R);
	}

	function module($Z,$omega,$angle)//Module du polynome donné par coef croissant $angle==0 module ; $angle!=0 argument
	//Dans le cas de argumebt, $angle donne la valeur précédement calculée
	{
		$k = explode(";", $Z); 
		$degmax = count($k);
		$re = (float)0;//partie réelle
		$im = (float)0;//partie imaginaire
		$typ = (int)0;//=1 -> Reel =0 ->img
		$sign = (float)1;
		$puis = (float)1;
		for($i=0;$i<$degmax;$i++)
		{
			$typ = 1 - $typ;
			$valeur = (float) $k[$i];	//echo("valeur=$valeur ");		
			if($typ==1)
			{
				$re = $re + $sign*$valeur*$puis;	//echo("re=$re ");
			}
			else
			{
				$im = $im + $sign*$valeur*$puis;	//echo("im=$im ");
				$sign =-$sign;
			}
			$puis = $puis*$omega;
		}
		
		if($angle==0) 
		{
			$resultat = 10*log10($re*$re+$im*$im);	
		}
		else
		{
			if($re!=0) $resultat = 180*atan($im/$re)/3.14159; else $resultat = -90;
			if(($im>0)&&($resultat<0)) $resultat = $resultat + 180;
			
			while($resultat-$angle<-90) $resultat = $resultat + 180;
			//echo("$Z($omega) $resultat <br>");
		}
			
			
		return ($resultat);
	}

	function plot($x,$y,$txt1,$txt2)
	{
		$x = $x-1;
		$y = -$y;
		$point ="<SPAN style=\"position:absolute; top:$y; left:$x;\" title=\"$txt1 $txt2\">.</SPAN>";
		
		return ($point);
	}

function Trans_Z($polyP,$Te) // Fourni un polynome en z, coefs par ordre croissant séparés par des ;
{
	$polyZ="0;0;0;0;0;0;0;0;0";
	if($Te!=0) $unsurTe = 1/$Te;else $unsurTe=1;
	$poly1_z="$unsurTe;-$unsurTe;0;0;0;0;0;0;0";
	$puissance=$poly1_z;
	$polyPtab = explode(";", $polyP);
	
	$polyZ=addpoly($polyZ,"$polyPtab[0];0;0;0;0;0;0;0;0");
	for($i=1;$i<9;$i++)
	{
		$suivant=multpoly($puissance,"$polyPtab[$i];0;0;0;0;0;0;0;0");
		$polyZ=addpoly($polyZ,$suivant);
		$puissance=multpoly($puissance,$poly1_z);
	}
	
	return($polyZ);
}

function choixTe($te)//Pour avoir un pas d'échelle sympas
{
	$puissance = round(log10($te)-0.5);	
	$puissance10 = pow(10,$puissance);
	
	$k=1;
	if($te>1.5*$puissance10) $k = 2;
	if($te>4*$puissance10) $k = 5;
	
	$choix = $k*$puissance10;
	return($choix);
}

function calculTe($Te) //Calcul du Te pour transformée en Z
{

	$newTe = choixTe($Te);
	
	return($newTe);
}

function tableauCoef($poly,$nom,$var)//Bel affichage des polynomes
{
	$coef = explode(";", $poly);
	$coef_nb = count($coef);
	$tableau = "<p>$nom = ";
	$tableau.=$coef[0];
	for($i=1;$i<$coef_nb;$i++) 
	{
		if($var=="z")
		{
			if($i>0) $puis = "$var<sup>-$i</sup>"; else $puis = "$var";	
		}
		else
		{
			if($i>1) $puis = "$var<sup>$i</sup>"; else $puis = "$var";
		}
		if($coef[$i]==1) $valeur="";else $valeur=$coef[$i];
		if($coef[$i]>0) $tableau.="+".$valeur.$puis;
		if($coef[$i]<0) $tableau.=$valeur.$puis;
	}
	$tableau .= "</p>";
	
	return $tableau;
}

//___________________________________________________________________________________________________________________________________________________________________
//                                                                                      TRAITEMENT
//___________________________________________________________________________________________________________________________________________________________________

	$content1 = "";
	
//  _______________________________________________________________________________	NOUVEAU FICHIER

	if($action=="newfile")
	{				
		$_SESSION['transfert'] = "1#";
		$_SESSION['transfert'] .="1+p#";
		$_SESSION['transfert'] .="0#";
		$_SESSION['transfert'] .="1#";
		$_SESSION['transfert'] .="0.05#";
		$_SESSION['transfert'] .="1;0;0;0;0;0;0;0;0#";
		$_SESSION['transfert'] .="1;1;0;0;0;0;0;0;0#";
		$_SESSION['transfert'] .="1;0;0;0;0;0;0;0;0#";
		
		$formulaire = formulaire("1","1+p","0",$numero,"1");
		$_SESSION['calcul']="";
	}

	$nomdufichier = $repertoire.$schem.$numero.$suffix;
//  _______________________________________________________________________________	SAUVEGARDE

	if($action=="save")
	{
		
		$R = str_replace(",", ".", $R);
		$T = str_replace(",", ".", $T);
		$D = str_replace(",", ".", $D);
		$N = str_replace(",", ".", $N);
		$D = str_replace("P", "p", $D);
		$N = str_replace("P", "p", $N);
		
		$_SESSION['transfert'] = "$N#";
		$_SESSION['transfert'] .= "$D#";
		$_SESSION['transfert'] .= "$R#";
		$_SESSION['transfert'] .= "$T#";
		$Te = calculTe($T/10);
		$_SESSION['transfert'] .= "$Te#";
		
		$RZ = round($R/$Te)-1; //Décalage en Z conséquence du retard - c'est un entier
		for($i=0;$i<$RZ;$i++) $RZ_txt .= "0;";

		
		$NumPoly = calculpoly($N);
		$DenPoly = calculpoly($D);
				
		$_SESSION['transfert'] .= "$NumPoly#";
		$_SESSION['transfert'] .= "$DenPoly#";
		
		$NumPolyZ = Trans_Z($NumPoly,$Te);
		$DenPolyZ = Trans_Z($DenPoly,$Te);
		$_SESSION['transfert'] .= $RZ_txt.$NumPolyZ."#";
		$_SESSION['transfert'] .= "$DenPolyZ#";
				
		$formulaire = lecturepoly($_SESSION['transfert']);
		$_SESSION['calcul']="";
						
	}
//  _______________________________________________________________________________	CALCUL
	
	if($action=="calcul")
	{
		$content1 = "";
		
			
		$formulaire = lecturepoly($_SESSION['transfert']);
		
		if($formulaire=="VIDE") 
		{
			$formulaire = formulaire("1","1+p","0",$numero,"1");
		}
		else
		{
			
			$elts = explode("#",$_SESSION['transfert']);
			$N = $elts[0];
			$D = $elts[1];
			$R = $elts[2];
			$T = $elts[3];
			$Te = $elts[4];
			$Num = $elts[5];
			$Den = $elts[6];
			$NZ = $elts[7];
			$DZ = $elts[8];
			
			$min = 0.01/$Te;
			$max = 100*$min;
			$raison = 1.05;
			$content1 = $_SESSION['calcul'];
			$Calcul = "<table class=\"clair\"><tr><td>";
			$Calcul .= "<u>R&eacute;sultats des calculs</u> <br />";
			$Calcul .= "<p>&omega;<sub>min</sub> = $min ; &omega;<sub>max</sub> = $max ; raison = $raison </p>";
			
			$_SESSION['black']=""; //DATA qui contient les points du diagramme de BLACK			
			$i = 0;
			for($omega = (float)$min;$omega<$max;$omega=$omega*$raison)
			{
				$mod_N = module($Num,$omega,0);	//echo("mod_N = $mod_N ");
				$mod_D = module($Den,$omega,0);	//echo("mod_D = $mod_N ");
				$module = $mod_N-$mod_D; //echo("module = $module <br>");

				if($arg_N==0)$arg_Back = 1; else $arg_Back = $arg_N;				
				$arg_N = module($Num,$omega,1);
				if($arg_D==0)$arg_Back = 1; else $arg_Back = $arg_D;
				$arg_D = module($Den,$omega,$arg_Back);
				//pb continuité arg
				
				$arg_retard = $R*$omega*180/3.14159;
				$argument = $arg_N - $arg_D - $arg_retard;
				
				//CALCUL DES EXTREMES
				if($i==0)
				{
					$Amin = $argument;
					$Amax = $argument;
					$Mmin = $module;
					$Mmax = $module;
				}
				else
				{
					if($Amin>$argument) $Amin = $argument;
					if($Amax<$argument) $Amax = $argument;
					if($Mmin>$module) $Mmin = $module;
					if($Mmax<$module) $Mmax = $module;
				}
				
				$_SESSION['black'].="$omega;$module;$argument#";
				$i++;
			}
			
			$Calcul .= "<p>Argument<sub>min</sub> = $Amin &deg; -- Argument<sub>max</sub> = $Amax &deg;</p>";
			$Calcul .= "<p>Module<sub>min</sub> = $Mmin db -- Module<sub>max</sub> = $Mmax db</p>";

			$NZ_tab = explode(";", $NZ);
			$NZ_nb = count($NZ_tab); //echo($NZ_nb." ");
			$DZ_tab = explode(";", $DZ);
			$DZ_nb = count($DZ_tab); //echo($DZ_nb." ");			
			
			
			
			//____________________________________________________________________________________________Pour REPONSE TEMPORELLE
			$_SESSION['temps']="";//Contient les valeurs des points temporels


			$T=0;
			$X[0]=0;$Xmax=0;$Xmin=0;
			for($i=0;$i<100;$i++)
			{
				$eps[$i]=100-$X[$i];
				$_SESSION['temps'].="$T;$eps[$i];$X[$i];Seps:$Seps;Sx:$Sx#";
				$Seps = $eps[$i]*$NZ_tab[0];
				for($j=1;$j<$NZ_nb;$j++)
				{
					if($i-$j>=0) $Seps = $Seps + $eps[$i-$j]*$NZ_tab[$j];
				}
				$Sx = $X[$i]*$DZ_tab[1];
				for($j=2;$j<$DZ_nb;$j++)
				{
					if($i+1-$j>=0) $Sx = $Sx + $X[$i+1-$j]*$DZ_tab[$j];
				}
				$X[$i+1]=($Seps-$Sx)/$DZ_tab[0];
				if($Xmin>$X[$i+1]) $Xmin=$X[$i+1];
				if($Xmax<$X[$i+1]) $Xmax=$X[$i+1];
				$T = $T + $Te;
			}			

			$Calcul .= "<p>X<sub>min</sub> = $Xmin % ; X<sub>max</sub> = $Xmax %</p>";
			$Calcul .= "</td></tr></table>";			
			$content1 .= $Calcul;
			
			//Version utilisant les variables superglobales
			$_SESSION['calcul']=$Calcul;
		}
		
	}
	
//  _______________________________________________________________________________	BLACK

	if($action=="black")
	{

		$content1.="<canvas id=\"canvas\" width=\"1028\" height=\"772\" style=\"display:none;\"></canvas>";
		$content1.="<center><img id=\"canvasImg\" alt=\"Right click to save me !\"></center>";
		
		$content1.=$_SESSION['calcul'];
		
	}

//  _______________________________________________________________________________	TEMPS
	if($action=="temps")
	{
		$content1.="<canvas id=\"canvas\" width=\"1028\" height=\"772\" style=\"display:none;\"></canvas>";
		$content1.="<center><img id=\"canvasImg\" alt=\"Right click to save me !\"></center>";

		 $content1.=$_SESSION['calcul'];
	}

//  _______________________________________________________________________________	TABLEAU

	if($action=="tableau")
	{
		$content1 ="<table width=\"600px\"><tr>";
		$content1 .="<td><b>Pulsation</b></td><td><b>Module en db</b></td><td><b>Argument en &deg;</b></td></tr>";
		
		$Ligne = explode("#",$_SESSION['black']);
		$nb_pts = count($Ligne); 
		$i=0;
		while($i<$nb_pts)
		{
			$DATA=explode(";", $Ligne[$i]);
			$puls = $DATA[0];
			$mod = $DATA[1];
			$arg = $DATA[2];
			$content1 .= "<tr><td>$puls</td><td>$mod</td><td>$arg</td></tr>";
			$i++;
		}
		$content1 .="</table>";
		$content1 .= "<table width=\"600px\"><tr><td><a href=\"./export.php?action=tableau\" target=\"blank\">Exporter les valeurs</a></td></tr></table>";
		$content1 .= $_SESSION['calcul'];		
	}
//  _______________________________________________________________________________	TABLEAU II

	if($action=="tableau2")
	{
		$content1 ="<table width=\"600px\"><tr>";
		$content1 .="<td><b>Temps en s</b></td><td><b>Erreur en %</b></td><td><b>Mesure en %</b></td></tr>";
		
		$Ligne = explode("#",$_SESSION['temps']);
		$nb_pts = count($Ligne);
		$i=0;
		while($i<$nb_pts)
		{
			$DATA=explode(";", $Ligne[$i]);
			$puls = $DATA[0];
			$mod = $DATA[1];
			$arg = $DATA[2];
			$content1 .= "<tr><td>$puls</td><td>$mod</td><td>$arg</td></tr>";
			$i++;
		}
		$content1 .="</table>";
		$content1 .= "<table width=\"600px\"><tr><td><a href=\"./export.php?action=tableau2\" target=\"blank\">Exporter les valeurs</a></td></tr></table>";

		$content1 .= $_SESSION['calcul'];
		
	}

//  _______________________________________________________________________________	T(p)
	
	if($action=="Tp")
	{
								
		$formulaire =  lecturepoly($_SESSION['transfert']);
		if($formulaire=="VIDE")
		{
			$formulaire = formulaire("1","1+p","0",$numero,"1");
		}	
		$content1 .= $_SESSION['calcul'];
	}
	


//___________________________________________________________________________________________________________________________________________________________________
//                                                                                      AFFICHAGE DE LA PAGE
//___________________________________________________________________________________________________________________________________________________________________
	
			
	menutab($numero,$action);
	echo($formulaire);
	echo($content1);
?>
<table>
<tr><td>
<font size="-2"><?php echo("<a href=\"./stop.php\">$numero");?></font>
</td></tr></table>
</body></html>
