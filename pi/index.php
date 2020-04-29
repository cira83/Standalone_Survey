<html>
<?php
	$noire_t = "#000000";//noir 
	$violet_t = "#8d1682";//violet 27min
	$rouge_t = "#fd0002";//rouge 9min
	$orange_t = "#ff8b01";//orange 3min
	$jaune_t = "#ffed02";//jaune 1min
	$vert_t = "#02fe00";//vert 20s
	
	$lut = "['$vert_t','$jaune_t','$orange_t','$rouge_t','$violet_t','$noire_t'];";
?>
	
	<head>
		<link rel="icon" type="image/gif" href="../img/LOGO_Flamme.gif" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="../Gestion/styles_sujet.css"  />
		<title>CIRA TP</title>


		<script type="text/javascript">
		var pastille = <?php echo($lut); ?>
		
			function photo(classe, nom,laquestion){
				laphoto = '<br><a href="../Gestion/devoir_comp.php?name='+nom+'&quest='+laquestion+'" target="_blank"><img src="../Gestion/files/'+classe+'/_Photos/'+ nom + '.jpg" height="100px"/></a>';
				return(laphoto);
			}
		
			function pastille_color(duree){
				couleur = pastille[0];
				if(duree>20) couleur = pastille[1];
				if(duree>60) couleur = pastille[2];
				if(duree>180) couleur = pastille[3];
				if(duree>540) couleur = pastille[4];
				if(duree>1620) couleur = pastille[5];

				bulle = '<font color=\"'+ couleur + '\" size=\"+2\" \">&#9679;</font> ';
				return(bulle);
			}
		
			function refresh(){
				var request = new XMLHttpRequest();
				var reponse;
				
				request.open('GET', "./lecture.php");
				request.responseType = 'text';
				
				request.onload = function() {
					data = request.response.split("#");
					classe = data[4];
					nom = data[0].split(':');
					timer = data[1].split(':');
					TP = data[5].split(':');
					nb_rep = data[2].split(':');
					question = data[7].split(':');
					for(i=0;i<18;i++){
						//if(question[i]) interrogation = '<img src="PI_orange.gif" height="20px" onclick="repondre(\''+question[i]+'\',\''+nom[i]+'\');"> ';
						if(question[i]) {
							laquestion = question[i].toString();
							lenom = nom[i].toString();
							interrogation = '<img src="PI_orange.gif" height="20px" id="' + laquestion + '" onclick="repondre(this.id,\''+lenom+'\');">';
						}
						else {
							interrogation = '';	
							laquestion = '';
						}					
						cellule = document.getElementById(i);
						celluleQ = document.getElementById('Q'+i);
						if(i<data[3]) {
							cellule.innerHTML =  pastille_color(timer[i])+nom[i]+' '+nb_rep[i]+'<br>'+TP[i]+photo(classe, nom[i],laquestion);
							celluleQ.innerHTML = interrogation;
						}
						else cellule.innerHTML = '';
					}	
				};	
				
				request.send();
			}

			function refresh_bak(){
				var cellule = document.getElementById('T0');
				retour = lecture_fichier("./lecture.php");


				cellule.innerHTML = retour;
			}

			setInterval(refresh, 1000);
			
			function repondre(question,nom){
				lareponse = prompt(question,'');
				
				var xhr = null;
			    var xhr = new XMLHttpRequest();	
			    
			    if(lareponse) {
				    chemin = './repondre1question.php?lareponse='+lareponse+'&lenom='+nom;	
					xhr.open("GET", chemin, true);
					xhr.send(null);
				}
			}
			
			function ip() {
				var request = new XMLHttpRequest();
				
				request.open('GET', "../ip.php");
				request.responseType = 'text';
				
				request.onload = function() {
					data = request.response;
					alert(data);
				};	
				request.send();
			}
			
			
			function classe() {
				var request = new XMLHttpRequest();
				var laclasse = document.getElementById('laclasse');
				
				request.open('GET', "./classe.php");
				request.responseType = 'text';
				
				request.onload = function() {
					data = request.response.split(':');
					laclasse.innerHTML = data[0];
				};	
				request.send();				
			}
				
			function debut(){
				refresh();
				classe();
			}	
		</script>
	</head>
	<body onload="debut()">
			<table><tr><!-- ENTETE -->
				<td width="50px"><a href="../Gestion/DSZone.php" title="Appel"><img src="../Gestion/icon/home.png" height="40px"></a></td>
				<td width="50px"><img src="../Gestion/icon/ip.gif" height="40px" onclick="ip();"></td>
				<td width="150px"><font size="-1">18 élèves<br>maximum</font></td>
				<td align="center"><font size="+2">TP CIRA</font></td>
				<td align="center"><font size="+2"><div id="laclasse">----</div></font></td>
				<td width="50px"><a href="http://localhost:1880/ui/"><img src="./node-red-icon.png" height="40px"></a></td>
			</tr></table>
			<!-- LUT -->
			<?php
				echo("<table><tr>");	
				echo("<td bgcolor=\"black\"></td>");
				echo("<td bgcolor=\"white\" width=\"35px\" align=\"center\"><font size=\"-2\">27 min</font></td><td bgcolor=\"$violet_t\"></td>");
				echo("<td bgcolor=\"white\" width=\"30px\" align=\"center\"><font size=\"-2\">9 min</font></td><td bgcolor=\"$rouge_t\"></td>");
				echo("<td bgcolor=\"white\" width=\"30px\" align=\"center\"><font size=\"-2\">3 min</font></td><td bgcolor=\"$orange_t\"></td>");
				echo("<td bgcolor=\"white\" width=\"30px\" align=\"center\"><font size=\"-2\">1 min</font></td><td bgcolor=\"$jaune_t\"></td>");
				echo("<td bgcolor=\"white\" width=\"30px\" align=\"center\"><font size=\"-2\">20 s</font></td><td bgcolor=\"$vert_t\"></td>");
				echo("<td bgcolor=\"white\" width=\"10px\" align=\"center\"><font size=\"-2\">0</font></td>");
				echo("</tr></table>");	
			?>
			<table><!-- ETUDIANTS -->
				<tr>
					<td id="0">----</td>
					<td id="1">----</td>
					<td id="2">----</td>
					<td id="3">----</td>
					<td id="4">----</td>
					<td id="5">----</td>
				</tr>
				<tr>
					<td id="Q0"></td>
					<td id="Q1"></td>
					<td id="Q2"></td>
					<td id="Q3"></td>
					<td id="Q4"></td>
					<td id="Q5"></td>
				</tr>

				<tr>
					<td id="6">----</td>
					<td id="7">----</td>
					<td id="8">----</td>
					<td id="9">----</td>
					<td id="10">----</td>
					<td id="11">----</td>
				</tr>
				<tr>
					<td id="Q6"></td>
					<td id="Q7"></td>
					<td id="Q8"></td>
					<td id="Q9"></td>
					<td id="Q10"></td>
					<td id="Q11"></td>
				</tr>


				<tr>
					<td id="12">----</td>
					<td id="13">----</td>
					<td id="14">----</td>
					<td id="15">----</td>
					<td id="16">----</td>
					<td id="17">----</td>
				</tr>
				<tr>
					<td id="Q12"></td>
					<td id="Q13"></td>
					<td id="Q14"></td>
					<td id="Q15"></td>
					<td id="Q16"></td>
					<td id="Q17"></td>
				</tr>

			</table>
	</body>
</html>
