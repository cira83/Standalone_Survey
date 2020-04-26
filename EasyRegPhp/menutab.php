<?php

function cases($texte,$lien,$actif)
{
	echo("<td");
	if($actif==1)//menu actif
	{
		echo(" class=\"actif\">".$lien.$texte."</a>");
	}
	if($actif==0)//menu non actif
	{
		echo(">".$texte);
	}
	if($actif==2)//menu proposé
	{
		echo(" class=\"prop\">".$lien.$texte."</a>");
	}
	if($actif==3)//menu proposé
	{
		echo(" class=\"selection\">".$lien.$texte."</a>");
	}
	echo("</td>");
}

function menutab($numero,$action)
{

	$Menu_session = isset($_SESSION['menu']) ? $_SESSION['menu'] : "";
	if($Menu_session=="")
	{
		$_SESSION['menu'] = "2,0,0,0,1,1,0,0";
	}
	
	$menuforme = explode(",", isset($menuformes)?$menuformes:""); //La liste définissant l'état du menu avant
	$menuforme = explode(",", $_SESSION['menu']);

	if($action=="save")
	{
		$menuforme[2]=0;
		$menuforme[1]=1;
		$menuforme[3]=2;
		
		$menuforme[7]=0;
	}
	if($action=="calcul")
	{
		$menuforme[1]=2;
		$menuforme[2]=0;
		$menuforme[3]=0;
		$menuforme[7]=1;
	}

	if($action=="Tp")
	{
		$menuforme[1]=2;
		$menuforme[2]=0;
	}

	if(($action=="tableau")or($action=="tableau2")or($action=="black")or($action=="temps")or($action=="Aide")or($action=="propos"))
	{
		$menuforme[1]=0;
		$menuforme[2]=1;
	}

	if($numero=="")//Dans le cas où il n'y a pas de numéro de fichier
	{
		$menuforme[0]=2;
		$menuforme[1]=0;
		$menuforme[2]=0;
		$menuforme[3]=0;
		$menuforme[4]=1;
		$menuforme[5]=1;
		$menuforme[6]=0;
		$menuforme[7]=0;
	}

	if($action=="newfile")//Format prioritaire
	{
		$menuforme[0]=0;
		$menuforme[1]=2;
	} 

	echo("<table><tr>");
//                                                  PREMIERE LIGNE		
	$ordre = isset($ordre)?$ordre:0;
	if($ordre==0) cases("Nouveau fichier","<a href=\"./index.php?action=newfile\">",$menuforme[0]);		
	cases("Faire les calculs","<a href=\"./index.php?action=calcul\">",$menuforme[3]);
	cases("<b>Les valeurs</b>","",$menuforme[6]);
	cases("<b>Le graphe</b>","",$menuforme[6]);
	


//                                                  DEUXIEME LIGNE	
	echo("</tr><tr>");
	cases("Enregistrer fichier","<a href=\"./index.php?action=save\" onclick=\"javascript:document.systeme.submit();return false;\">",$menuforme[1]);
	cases("Aide","<a href=\"./aide.php\">",$menuforme[4]);
	cases("du plan de Black","<a href=\"./index.php?action=tableau\">",$menuforme[7]);
	cases("du plan de Black","<a href=\"./index.php?action=black\">",$menuforme[7]);

//                                                  TROISIEME LIGNE
	echo("</tr><tr>");	
	cases("Fichier de travail","<a href=\"./index.php?action=Tp\">",$menuforme[2]);
	cases("A propos","<a href=\"./propos.php\">",$menuforme[5]);
	cases("temporelles","<a href=\"./index.php?action=tableau2\">",$menuforme[7]);
	cases("temporel","<a href=\"./index.php?action=temps\">",$menuforme[7]);		


	echo("</tr></table>");	
	
	//version avec variables superglobales
	$_SESSION['menu'] = "$menuforme[0],$menuforme[1],$menuforme[2],$menuforme[3],$menuforme[4],$menuforme[5],$menuforme[6],$menuforme[7]";
}


?>

