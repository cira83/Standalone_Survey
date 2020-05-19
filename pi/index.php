<html>
<!--
	Le fichier _Copies/nom_elv/rep/qs.txt contient les questions et leurs réponses 
	- Une question réponse par ligne 
	- En cas de remarque, la question devient "remarque :"
	Le fichier _Copies/nom_elv/rep/RQ.txt contient les remarques furtives (une alerte apparait et efface la remarque)
-->
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
					ping = data[8];
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
							interrogation = '<img src="Question.gif" height="20px" id="' + laquestion + '" onclick="repondre(this.id,\''+lenom+'\',\''+classe+'\');">';
							sonnerie();
						}
						else {
							interrogation = '';	
							laquestion = '';
						}					
						cellule = document.getElementById(i);
						celluleQ = document.getElementById('Q'+i);
						celluleB = document.getElementById('B'+i);
						celluleL = document.getElementById('L'+i);
						bouche = '<img src="bouche.gif" height="15px" onclick="parle(\''+nom[i]+'\',\''+classe+'\');">';
						if(i<data[3]) {
							cellule.innerHTML =  pastille_color(timer[i])+nom[i]+' '+nb_rep[i]+'<br>'+TP[i]+photo(classe, nom[i],laquestion);
							celluleQ.innerHTML = interrogation;
							celluleB.innerHTML = bouche;
							celluleL.innerHTML = '<a href="./discussion.php?nom='+nom[i]+'&classe='+classe+'" target="_blank"><img src="../Gestion/icon/tab.jpg" height="16px" title="Discussion"/></a>';
						}
						else {
							cellule.innerHTML = '';
							celluleQ.innerHTML = '';
							celluleB.innerHTML = '';
						}
					}
					cellule_ping = document.getElementById('ping');
					
					cellule_ping.innerHTML = '<font color="white" size="-2">'+ping+'</font>';
;
				};	
				
				request.send();
			}

			function refresh_bak(){
				var cellule = document.getElementById('T0');
				retour = lecture_fichier("./lecture.php");


				cellule.innerHTML = retour;
			}

			setInterval(refresh, 3000);
			
			function repondre(question,nom,classe){
				lareponse = prompt(question,'');
				
				var xhr = null;
			    var xhr = new XMLHttpRequest();	
			    
			    if(lareponse) {
				    infos = classe+'_'+nom+'_'+lareponse+'_1_';
				    chemin = './repondre1question.php?infos='+infos;	
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
				sonnerie();
			}	
			
			function parle(nom,classe){
				var question = 'Remarque à '+nom+' de '+classe;
				laremarque = prompt(question,'');
				
				var xhr = null;
			    var xhr = new XMLHttpRequest();	
			    
			    if(laremarque) {
				    infos = classe+'_'+nom+'_'+laremarque+'_0_';
				    chemin = './repondre1question.php?infos='+infos;	//réponse sans question = remarque
					xhr.open("GET", chemin, true);
					xhr.send(null);
				}

			}
			
			function sonnerie(){
				var audio = new Audio('SW.mp3');
				audio.play();
				
			}
		</script>
	</head>
	<body onload="debut();">
			<table><tr><!-- ENTETE -->
				<td width="50px"><a href="../Gestion/appel.php" title="Appel"><img src="../Gestion/icon/home.png" height="40px"></a></td>
				<td width="50px"><img src="../Gestion/icon/ip.gif" height="40px" onclick="ip();"></td>
				<td width="150px"><font size="-1">18 élèves<br>maximum</font></td>
				<td align="center"><font size="+2">TP CIRA</font></td>
				<td align="center"><font size="+2"><div id="laclasse">----</div></font></td>
				<!-- <td width="50px"><a href="http://localhost:1880/ui/"><img src="./node-red-icon.png" height="40px"></a></td> -->
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
				echo("<td bgcolor=\"black\" width=\"30px\" align=\"center\" id=\"ping\"></td>");
				echo("</tr></table>");	
			?>
			<table><!-- ETUDIANTS -->
				<tr>
					<td id="0" colspan="3">----</td>
					<td id="1" colspan="3">----</td>
					<td id="2" colspan="3">----</td>
					<td id="3" colspan="3">----</td>
					<td id="4" colspan="3">----</td>
					<td id="5" colspan="3">----</td>
				</tr>
				<tr>
					<td id="Q0"></td><td id="L0"></td><td id="B0"></td>
					<td id="Q1"></td><td id="L1"></td><td id="B1"></td>
					<td id="Q2"></td><td id="L2"></td><td id="B2"></td>
					<td id="Q3"></td><td id="L3"></td><td id="B3"></td>
					<td id="Q4"></td><td id="L4"></td><td id="B4"></td>
					<td id="Q5"></td><td id="L5"></td><td id="B5"></td>
				</tr>

				<tr>
					<td id="6" colspan="3">----</td>
					<td id="7" colspan="3">----</td>
					<td id="8" colspan="3">----</td>
					<td id="9" colspan="3">----</td>
					<td id="10" colspan="3">----</td>
					<td id="11" colspan="3">----</td>
				</tr>
				<tr>
					<td id="Q6" width="8%"></td><td id="L6" width="9%"></td><td id="B6" width="8%"></td>
					<td id="Q7" width="8%"></td><td id="L7" width="9%"></td><td id="B7" width="8%"></td>
					<td id="Q8" width="8%"></td><td id="L8" width="9%"></td><td id="B8" width="8%"></td>
					<td id="Q9" width="8%"></td><td id="L9" width="9%"></td><td id="B9" width="8%"></td>
					<td id="Q10" width="8%"></td><td id="L10" width="9%"></td><td id="B10" width="8%"></td>
					<td id="Q11" width="8%"></td><td id="L11" width="9%"></td><td id="B11" width="8%"></td>
				</tr>


				<tr>
					<td id="12" colspan="3">----</td>
					<td id="13" colspan="3">----</td>
					<td id="14" colspan="3">----</td>
					<td id="15" colspan="3">----</td>
					<td id="16" colspan="3">----</td>
					<td id="17" colspan="3">----</td>
				</tr>
				<tr>
					<td id="Q12"></td><td id="L12"></td><td id="B12"></td>
					<td id="Q13"></td><td id="L13"></td><td id="B13"></td>
					<td id="Q14"></td><td id="L14"></td><td id="B14"></td>
					<td id="Q15"></td><td id="L15"></td><td id="B15"></td>
					<td id="Q16"></td><td id="L16"></td><td id="B16"></td>
					<td id="Q17"></td><td id="L17"></td><td id="B17"></td>
				</tr>

			</table>
			<audio id="SW" src="SW.mp3"></audio>
	</body>
</html>
