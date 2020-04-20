<?php
	$listedesparticipants = "";
	
	function present($value){
		if($value=="-1") $drap = "Absent"; else  $drap = "Pr&eacute;sent";
		return($drap);
	}
	$nom_doc = "Professeur";


	$getdate = isset($_GET['ladate'])?$_GET['ladate']:$date;
	$ladate = str_replace("/", "_", $getdate);
	$lefichierexiste = false;
	$filename = "./files/$classe/_Appels/$ladate.txt"; //affiche($filename);

	// Création Repertoire _Appels  
	$lerepertoire =  "./files/$classe/_Appels";
	if(!file_exists($lerepertoire)){
		 echo("<p>Création du repertoire des Appels</p>");
		 mkdir($lerepertoire, 0777);
	}
?>
<form method="post" action="<?php echo("./index.php?action=1&ladate=$getdate");?>"/>
<?php
	$action = isset($_GET['action'])?$_GET['action']:""; //VALIDATION DE L'APPEL
	if($action==1){   
		//affiche("Validation de l'appel");
		$laliste = $_POST[laliste];
		$leselts = explode(":", $laliste);
		
		$fp = fopen($filename, "w");
		for($i=0;$i<count($leselts)-2;$i++){
			$unnom = $leselts[$i];
			$drap = $_POST[$unnom];
			$present = present($drap);
			fprintf($fp, "$unnom:$present:$drap:\n");
		}
		$unnom = $leselts[$i];
		$drap = $_POST[$unnom];
		$present = present($drap);
		fprintf($fp, "$unnom:$present:$drap:");
		fclose($fp);
	}

	//COULEURS DES CADRES SI FICHIER EXISTE
	$deja = "";
	if(file_exists($filename)) {//Dans le cas ou le fichier existe donne la liste des élèves présents dans le fichier
		$deja = (" (Lecture)"); $couleur_disquette = "#0f0";
		$lefichierexiste = true;
		$fp = fopen($filename, "r");
		$i=0;
		while (!feof($fp)){
			$ligne = fgets($fp);
			$data = explode(":", $ligne);
			if($data[2]=="+1") $couleur[$i] = "#fff"; else $couleur[$i] = "#f00";
			$file_eleve[$i] = $data[0]; //ajouté le 1 septembre 2016
			$i++;
		}
		fclose($fp);
	}
	else {
		$couleur_disquette = "#fff";
	}
	
	$belledate = str_replace("_", "/", $getdate);
	affiche("Appel du $belledate $deja");
	
	function menunom($nom,$couleur){
		$menu = "<select name=\"$nom\" onchange=\"newvalue(this.value,'$nom');\">";
		if($couleur=="#fff") $menu .= "<option value=\"+1\">Present</option>";
		$menu .= "<option value=\"-1\">Absent</option>";
		if($couleur=="#f00") $menu .= "<option value=\"+1\">Present</option>";
		$menu .= "</select>";
		
		return($menu);
	}


	//Partie avec les photos
	echo("<table>");
	$i = 1;
	$k = 0;
	$nbeleve = 0;
	while($k<count($leleve)){
		$nom = $leleve[$k];
		if($lefichierexiste) {//modifié le 1 septembre 2016
			//Cherche le nom dans la liste de nom disponibles dans le fichier
			$mm1 = 0;
			while(($mm1<count($file_eleve))&&($file_eleve[$mm1]!=$nom)){
				$mm1++;
			}
			$photo = photobord($nom,$couleur[$mm1]);
			$menu = menunom($nom,$couleur[$mm1]);
			if($couleur[$mm1]=="#fff") $nbeleve++;
		}
		else {
			$photo = photobord($nom,"#fff");//Couleur en fonction de l'ancien appel
			$menu = menunom($nom,"#fff");
			$nbeleve++;
		}
		$listedesparticipants .= $nom.":";//Necessaire à la création de nouvelles copies
		if($i==1) echo("<tr>");
		if($i<$nbphotoslignes){
			echo "<td>$photo<br/>$nom<br/>$menu</td>";
			$i++;
		}
		else {
			$i = 1;
			echo "<td>$photo<br/>$nom<br/>$menu</td></tr>\n";
		}	
		$k++;
	}
	while(($i<$nbphotoslignes+1)&&($i!=1)){
		echo "<td>.</td>";
		$i++;
	}
	echo("</table>");
		
	//FIN - Partie avec les photos

	$ladate15=str_replace("/", "_", $ladate);
	$ladate16=str_replace("_", "/", $ladate);	
	
	//Fichier à supprimer
	if($lefichierexiste){
		$aeffacer = "./files/$classe/_Appels/$ladate15.txt";
		$file2delete = "<a href=\"delfile.php?name=$aeffacer&action=0\">Supprimer</a> l'appel du $ladate16";
	}

	$nbeleveclasse = count($leleve);
?>
<table><tr>
	<td>Nombre d'&eacute;l&egrave;ves pr&eacute;sents dans la salle : <input type="text" id="nombre" size="3" value="<?php echo($nbeleve);?>">
<?php echo("sur $nbeleveclasse - ");?>
<input type="submit" value="Enregistrer">
<input type="hidden" value="<?php echo($listedesparticipants); ?>" name="laliste">
</td><td>
<img src="./icon/disquette.jpg" height="15px" style="border:solid 4px <?php echo($couleur_disquette);?>;" id="disquette">
</form></td>
</tr></table>

<script type="text/javascript">
function newvalue(lavaleur,id){
	back = document.getElementById('nombre').value;
	delta = parseFloat(lavaleur);
	document.getElementById('nombre').value = delta + parseFloat(back);
	document.getElementById('disquette').style.border = "solid 4px #f00";
	if(delta<0) document.getElementById(id).style.border = "solid 4px #f00";
	if(delta>0) document.getElementById(id).style.border = "solid 4px #ff0";
}
</script>

<?php 
	//les appels 1 decembre 2016
	$tabDappels = tabDappels($classe,$tableaudesappels);
	echo($tabDappels);
	include("./bas.php");
?>