<script>
	function filtre(selecteur) {
		var div = document.getElementById('Logs');
		var select2 = document.getElementById('2');
		var select3 = document.getElementById('3');
		var select5 = document.getElementById('5');

		var request = new XMLHttpRequest();

		valeur = selecteur.value;
		id = selecteur.id;
		if(id!=2) select2.value = '0';
		if(id!=3) select3.value = '0';
		if(id!=5) select5.value = '0';
		
		chemin = 'listedeslog_filtre.php?infos='+id+':'+valeur+':';
		request.open('GET', chemin);
		request.responseType = 'text';
			
		request.onload = function() {
			data = request.response;
			div.innerHTML = data;
		};	
			
		request.send();
	}

	function locate_ip(ip){
		var request = new XMLHttpRequest();
		var reponse;
		var source = 'https://ipapi.co/'+ip+'/json';
		
		request.open('GET', source);
		request.responseType = 'json';
		
		request.onload = function() {
			data = request.response;
			message = data.city+' - '+data.region+' - '+data.org;
			alert(message);
		};	
		
		request.send();
	}

</script>


<?php
	include("./haut.php");

	function add2listpt($elt,$liste) {//liste = string separés par 2 points enlève </td>
		$part = explode("<", $elt);
		if($part[0])
			if(!strpos("_$liste", $part[0])) 
				$liste .="$part[0]:";

		return $liste;
	}
	
	function creer_select($liste,$id){
		$select = "<select id=\"$id\" onchange=\"filtre(this);\">";
		$select .= "<option value=\"0\">Tous</option>";
		$part = explode(":", $liste);
		for($i=0; $i<count($part)-1;$i++) $select .= "<option value=\"$part[$i]\">$part[$i]</option>";
		$select .= "</select>";
		return($select); 
	}
	
	//-------------------------------------------------------------------------------------
	
	$listeDetat = "0:1:2:";
	$listeNom = "";
	$listeIP = "";
	if(file_exists($logindeseleves)){
		$fp = fopen($logindeseleves, "r");
		$i=0;
		$content_tab = "";
		while (!feof($fp)){
			$ligne26 = fgets($fp);
			$part = explode("<td>", $ligne26);
			$ligne1 = "<tr>$ligne26</tr>";
			$part_2 = my_array_value($part,2); //echo("$part_2");
			$part_3 = my_array_value($part,3); 
			$part_5 = my_array_value($part,5);
			if(strpos("_$part_3", "1")) $ligne1 = "<tr bgcolor=\"white\">$ligne26</tr>";
			if(strpos("_$part_3", "0")) $ligne1 = "<tr bgcolor=\"red\">$ligne26</tr>";
			$content_tab = $ligne1.$content_tab;
			$listeNom = add2listpt($part_2,$listeNom);
			$listeIP = add2listpt($part_5,$listeIP);
			$i++;
		}
		fclose($fp);

		$select2 = creer_select($listeNom,2);
		$select3 = creer_select($listeDetat,3);
		$select5 = creer_select($listeIP,5);
		$ligne1 = "<table><tr><td>Nom : $select2</td><td>Type : $select3</td><td>IP : $select5</td></tr></table>";
	}


	echo($ligne1);

	echo("<table id=\"Logs\">");
	include("./listedeslog_filtre.php");
	echo("</table>");
	
	include("./bas.php");
?>


