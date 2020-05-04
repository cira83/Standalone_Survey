<?php 
	include("./haut.php");
	$sujetlink = $_GET['file']; 	//echo($sujet);
	$part1 = explode("_link", $sujetlink);
	$part0 = explode(".", $part1[1]); //echo($part[1]);
	$part3 = explode("/", $sujetlink);
	$info_sujet = "";
	$ligne = array_fill(0, 10, "");
	
	if(my_GET("src")==1){
		//affiche("Modification du fichier info : $sujetlink");
		$sujet = $_POST['doc'];
		//affiche("Sujet : $sujet");
		$cor = $_POST['ppt'];
		//affiche("Correction : $cor");
		$active = $_POST['active'];
		$bar= $_POST['xls'];
		//affiche("Barème : $bar");
		//affiche("Disponibles : $active");
		
		$sujet = urldecode($sujet);
		$cor = urldecode($cor);
		$bar = urldecode($bar);
		
		
		$fp = fopen($sujetlink, "w");
		fprintf($fp, "$sujet");
		fprintf($fp, "\n$cor");
		fprintf($fp, "\n$active");
		fprintf($fp, "\n$bar");
		fclose($fp);
	}
	
	
	
	
	
	if(file_exists($sujetlink)) {
		$fp = fopen($sujetlink, "r");
		$i = 0;
		while(!feof($fp)){
			$ligne[$i]=fgets($fp); //affiche("Ligne $i : $ligne[$i]");
			$i++;
		}
		fclose($fp);
	} 
	
	$danger = info_sujet_ouvert($sujetlink);
	if($danger) $info_sujet = "<td width=\"25px\"><img src=\"./icon/danger.png\" height=\"20px\"></td>";
	$lien_vers_doc = info_sujet($sujetlink);
	$part_correction_sujet = explode("+", $lien_vers_doc);
	$info_sujet .= "<td width=\"25px\">".$part_correction_sujet[0]."</td>";	
	$info_sujet .= "<td width=\"25px\">".$part_correction_sujet[1]."</td>";
	$info_sujet .= "<td width=\"25px\">".$part_correction_sujet[2]."</td>";
	
	tableau("$part3[3]</td><td><a href=\"epreuve.php?mat=$part3[3]&epr=$part1[1]\">$part0[0]</a>$info_sujet");

	
	
	$action = "info_sujet.php?file=$sujetlink";	
	if(strpos("_$ligne[2]","on")) $checked = "checked";
	else $checked = "";
?>
<table><form name="envoie fichier" enctype="multipart/form-data" method="post" action="<?php echo("$action&src=1");?>">
	<tr>
		<td width="120px"><b>Sujet</b> : </td>
		<td><input name="doc" type="txt" value="<?php echo($ligne[0]);?>" size="80px"></td>
		<td><a href="<?php echo($ligne[0]);?>">__&uarr;__</a></td>
	</tr><tr>
		<td><b>Correction</b> : </td>
		<td><input name="ppt" type="txt" value="<?php echo($ligne[1]);?>" size="80px"></td></td>
		<td><a href="<?php echo($ligne[1]);?>">__&uarr;__</a></td>
	</tr><tr>
		<td><b>Bareme</b> : </td>
		<td><input name="xls" type="txt" value="<?php echo($ligne[3]);?>" size="80px"></td></td>
		<td><a href="<?php echo($ligne[3]);?>">__&uarr;__</a></td>
	</tr><tr>
		<td><input type="submit"></td>
		<td>Informations disponibles</td>
		<td><input type="checkbox" name="active" <?php echo($checked);?> ></td>
	</tr>
	
</form></table>
<?php
	include("./bas.php");
?>