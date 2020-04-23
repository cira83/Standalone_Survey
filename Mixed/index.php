<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
	$numero = session_id();//Numero des fichiers 
	$nom_elv = $_COOKIE['nom'];
	$nom_logiciel = "MIXED";
?>

<html>
<script>
	var Int = [0,0,0];//Actions Intégrale de chaque correcteur
	var caseaW = '<input type="checkbox" id="W" name="W=50%" value="&Delta;W" onchange="casacocher(this.id,\'Y\',\'Z\');">';
	var caseaY = '<input type="checkbox" id="Y" name="Y=50%" value="&Delta;Y" onchange="casacocher(this.id,\'Z\',\'W\');">';
	var caseaZ = '<input type="checkbox" id="Z" name="Z=50%" value="&Delta;Z" onchange="casacocher(this.id,\'W\',\'Y\');">';
	
	function premier_ordre(K,Tau,Te, En, Sn1) {// a = Tau/Te
		var Sn = 0;
		var a = Tau/Te;
		Sn = (K*En+a*Sn1)/(a+1);
		if(Sn>100) Sn = 100;
		if(Sn<0) Sn = 0;
		return(Sn);
	}	
	
	function PID(A,Ti,Td,Te,En,En1,Int_num) {
		var Yn;
		var alpha = Te*A/Ti ;
		var beta = Td/Te ;
		
		//Yn = Yn1+A*(En*(1+1/alpha)-En1+beta*(En-2*En1+En2));
		Int[Int_num] = En*alpha + Int[Int_num];
		
		Yn = Int[Int_num]+A*En+beta*(En-En1);
		//if(Yn>100) Yn=100;
		//if(Yn<0) Yn=0;
		return(Yn);
	}
	
	function enleve_virgule() {
		var A1 = document.getElementById("A1");
		A1.value = A1.value.replace(",",".");
		var A2 = document.getElementById("A2");
		A2.value = A2.value.replace(",",".");
		var Td1 = document.getElementById("TD1");
		Td1.value = Td1.value.replace(",",".");
		var Ti1 = document.getElementById("TI1");
		Ti1.value = Ti1.value.replace(",",".");
	}
	
	
	function ordonne2string(Sn) {
		if(Sn>100) Sn = 100;
		if(Sn<0) Sn = 0;
		var echelY = -3;
		var Yn =  330 + Sn*echelY ;
		var Yn_string = Yn.toString();
		return(Yn_string);
	}

	function abscisse2string(X,echelX) {
		var Xn =  25 + X*echelX ;
		var Xn_string = Xn.toString();
		return(Xn_string);
	}

	
	function dessiner() {//Dessine la courbe
		enleve_virgule();
		
		var boucle = document.getElementById("boucle");
		var svg = document.getElementById("graphe");
		var courbe = document.getElementById("courbe");
		var id10 = document.getElementById("X10");
		var cartouche = document.getElementById("cartouche");
		var A1 = document.getElementById("A1");
		var A2 = document.getElementById("A2");
		var Ti1 = document.getElementById("TI1");
		var Td1 = document.getElementById("TD1");
		var Y = document.getElementById('Y');
		var Z = document.getElementById('Z');
		var W = document.getElementById('W');
		
		var X2=0; X0=22; Consigne=50; Tau1=28 ; Tau2=28; XZ=0; tauZ = 10;
		var gain_procede=1.2;gain_pertubation=0.6;
		var X10_Elt = document.getElementById("Echelle_x");
		var a=0,Y2=0,Y2R=0,Y22=0,X1=0,X2=0,eps11=0,eps22=0; X2R=0; DeltaZ=50;
		
		
		Int[1] = 0; //RAZ de intégrale 1
		Int[2] = 0; //RAZ de intégrale 2
		X10 = "0";
		info = "";
		
		Tn = 0;
		X2=0;
		Y22=0;
		points = ""; //Pas de premier point
		X10 = X10_Elt.value;
		X0=0;
		echelX = 10*50/X10;
		Te = 0.1*X10/50;
		Tn = Te + Tn;
		
		if(boucle.value=="BSO") { 
			if(Y.checked){ //Boucle Simple Ouverte. 50 [H1] Y22 [H2| X2
				info = "Boucle ouverte - ΔY=0-50%";
				for(i=0;i<650;i++) {
					Yn_string = ordonne2string(X2);	
					Xn_string = abscisse2string(Tn,echelX);		
					points = points + " " + Xn_string + "," + Yn_string; 
					
					Y22 = premier_ordre(gain_procede,Tau1,Te,50,Y22);
					X2 = premier_ordre(1,Tau2,Te,Y22,X2); //Constante de temps = 20 + 5

					
					Tn = Te + Tn;
				}
			}	
			if(Z.checked){ //Boucle Simple Ouverte. 20 [Hz| Kp.50-X2
				info = "Boucle ouverte - ΔZ=0-50%";
				X0=X0+gain_procede*50;
				for(i=0;i<650;i++) {
					Yn_string = ordonne2string(X0-XZ);	
					Xn_string = abscisse2string(Tn,echelX);		
					points = points + " " + Xn_string + "," + Yn_string; 
					
					XZ = premier_ordre(gain_pertubation,tauZ,Te,DeltaZ,XZ); //Constante de temps = 30
					Tn = Te + Tn;
				}
			}	
		}
		
		if(boucle.value=="BMF") { 
			if(W.checked){ //Boucle Mixte Fermée. 50 [H1] Y22 [H2| X2
				info = "Boucle fermée - ΔW=0-50% - A1="+A1.value+" ; Td1 = "+Td1.value+" ; Ti1 = "+Ti1.value;
				Y22 = 0;
				for(i=0;i<650;i++) {
					Yn_string = ordonne2string(X2);	
					Xn_string = abscisse2string(Tn,echelX);
					points = points + " " + Xn_string + "," + Yn_string; 
					
					Y22 = premier_ordre(gain_procede,Tau1,Te,Y2,Y22); //Y2[]Y22
					X2 = premier_ordre(1,Tau2,Te,Y22,X2);  //Y22[]X2
					Y2 = PID(A1.value,Ti1.value,Td1.value,Te,Consigne-X2,eps11,2);//Consigne-X2[]Y2
					eps11=Consigne-X2;
										
					Tn = Te + Tn;
				}
			}
			if(Z.checked){ //Boucle Mixte Fermée. 50 [H1] Y22 [H2| X2
				info = "Boucle fermée - ΔZ=0-50% - A1="+A1.value+" ; Td1 = "+Td1.value+" ; Ti1 = "+Ti1.value;
				if(Ti1.value>8000) GBO = gain_procede*A1.value;
				else GBO = 9999;
				X2 = 50*GBO/(1+GBO);
				Y2 = X2/gain_procede;
				Y22 = X2;
				Y2R = Y2;
				X2R = X2;
				for(i=0;i<650;i++) {
					Yn_string = ordonne2string(X2R);	
					Xn_string = abscisse2string(Tn,echelX);
					points = points + " " + Xn_string + "," + Yn_string; 
					
					Y22 = premier_ordre(gain_procede,Tau1,Te,Y2R,Y22); //Y2R[]Y22
					X2 = premier_ordre(1,Tau2,Te,Y22,X2); //Y22[]X2 
					XZ = premier_ordre(gain_pertubation,tauZ,Te,DeltaZ,XZ);//DeltaZ=50
					X2R = X2 - XZ;
					Y2 = PID(A1.value,Ti1.value,Td1.value,Te,Consigne-X2R,eps11,2);//Y1-X2[]Y2
					Y2R = Y2+DeltaZ*A2.value;
					eps11=Consigne-X2R;
										
					Tn = Te + Tn;
				}
			}			
		}
		
		
		
		
		
		
		
		
		
		
		
		//---------------------------------------------------- SORTIE DES RESULTATS
		cartouche.innerHTML = info;
		id10.innerHTML = X10;
		courbe.setAttribute("points", points);
	}
	
	
	function change_image(limage) {
    	var image = document.getElementById("image");
		var Y = document.getElementById('Y');
		var Z = document.getElementById('Z');
		var W = document.getElementById('W');
		var TY = document.getElementById('TY');
		var TZ = document.getElementById('TZ');
		var TW = document.getElementById('TW');
		var TD_W = document.getElementById('TDW');
		var TD_Y = document.getElementById('TDY');
		var TD_Z = document.getElementById('TDZ');
		    	
    	if(limage=='BSO'){
	    	TY.innerHTML = "Y=50%";
	    	Z.checked = true;
	    	TZ.innerHTML = Z.value;
	    	TW.innerHTML = 'W';
	    	TD_Y.innerHTML = caseaY;
	    	TD_W.innerHTML = '';
    	}
 
     	if(limage=='BMO'){
	    	TY.innerHTML = "Y=50%";
	    	Z.checked = true;
	    	TZ.innerHTML = Z.value;
	    	TW.innerHTML = 'W';
	    	TD_Y.innerHTML = caseaY;
	    	TD_W.innerHTML = '';
    	}
 
 
     	if(limage=='BSF'){
	    	TW.innerHTML = "W=50%";
	    	Z.checked = true;
	    	TZ.innerHTML = Z.value;
	    	TY.innerHTML = 'Y';
	    	TD_W.innerHTML = caseaW;
	    	TD_Y.innerHTML = '';
    	}
 
      	if(limage=='BMF'){
	    	TW.innerHTML = "W=50%";
	    	Z.checked = true;
	    	TZ.innerHTML = Z.value;
	    	TY.innerHTML = 'Y';
	    	TD_W.innerHTML = caseaW;
	    	TD_Y.innerHTML = '';
    	}
    	
    	newimage = limage + ".svg";
		image.setAttribute("src", newimage);
    }

	function export_png() {
		var svg = document.getElementById("graphe");
		saveSvgAsPng(svg, "reponse_ind.png");
	}


	function casacocher(id,A1,A2){
		var B1 = document.getElementById(id);
		var B2 = document.getElementById(A1);
		var B3 = document.getElementById(A2);
		var T1 = document.getElementById('T'+id);
		var T2 = document.getElementById('T'+A1);
		var T3 = document.getElementById('T'+A2);
		
		if(B1.checked) {
			T1.innerHTML = B1.value;
			if(B2) {
				B2.checked = false;
				T2.innerHTML = B2.name;
			}
			if(B3) {
				B3.checked = false;
				T3.innerHTML = B3.name;
			}
		}
		else {
			T1.innerHTML = B1.name;
			if(B2) {
				B2.checked = true;
				T2.innerHTML = B2.value;
			}
		}
	}

</script>
	
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>	
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="print.css" media="print">
		<script type="text/javascript" src="./save-svg-as-png/lib/saveSvgAsPng.js"></script>
		<title><?php echo($nom_logiciel); ?></title>
	</head>
	<body>
<?php echo("<!-- $nom_elv. -->\n");?> 
	<table><tr><td width="65px"><img src="LOGO.gif" height="60px" /></td><td><h1><?php echo($nom_logiciel); ?></h1></td><td width="65px"></td></tr></table>


<!--
	taille tableau = 800 x 400
	taille image = 700 x 350
-->	
			
	<table class="blanc">
		<tr height="50px" ><td width="100px">
			</td><td><b>Réponse indicielle</b>
		</td><td width="100px">
			<img src="backup.gif" height="28px" onclick="export_png();" title="Exporter la réponse indicielle"/>
		</td></tr>
		
		<tr><td colspan="3">																											<!-- GRAPHIQUE -->
			<svg id="graphe" width="700" height="350">
				<rect width="700" height="350" style="fill:rgb(255,255,255);stroke-width:0;stroke:rgb(255,255,255)" />
				<text x="450" y="65" fill="#DDD" id="Session"><?php echo($numero); ?></text>
				<text x="450" y="45" fill="#DDD" id="nom_elv"><?php echo($nom_elv); ?></text><!-- FILIGRAMME -->
				<!-- 	
					(0,0) = 25,330 
					(delta 1 case,delta 1 case) = (+50,-30)
				-->
				<line x1="25" y1="330" x2="25" y2="30" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_y"/>
				<line x1="25" y1="30" x2="675" y2="30" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="60" x2="675" y2="60" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="90" x2="675" y2="90" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="120" x2="675" y2="120" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="150" x2="675" y2="150" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="180" x2="675" y2="180" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="210" x2="675" y2="210" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="240" x2="675" y2="240" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="270" x2="675" y2="270" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="25" y1="300" x2="675" y2="300" style="stroke:rgb(128,128,128);stroke-width:1" />
				
				<line x1="25" y1="330" x2="675" y2="330" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_x"/>
				<line x1="75" y1="330" x2="75" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="125" y1="330" x2="125" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="175" y1="330" x2="175" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="225" y1="330" x2="225" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="275" y1="330" x2="275" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="325" y1="330" x2="325" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="375" y1="330" x2="375" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>				
				<line x1="425" y1="330" x2="425" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="475" y1="330" x2="475" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="525" y1="330" x2="525" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="575" y1="330" x2="575" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="625" y1="330" x2="625" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>
				<line x1="675" y1="330" x2="675" y2="30" style="stroke:rgb(128,128,128);stroke-width:1"/>

				<text transform="matrix(-0, -1, 1, -0, 20, 250)" id="Echelle_Y">Mesure X en %</text>
				<text x="675" y="335" fill="black">0</text>
				<text x="675" y="245" fill="black">30</text>
				<text x="675" y="155" fill="black">60</text>
				<text x="675" y="65" fill="black">90</text>
			
				<text x="20" y="345" fill="black">0</text>
				<text x="518" y="345" fill="black" id="X10"></text>
				<text x="300" y="345" fill="black">Temps en s</text>
				
				<text x="20" y="25" fill="blue" id="cartouche"></text>
			
				<polyline points="" style="fill:none;stroke:red;stroke-width:1" id="courbe"/>
			
			</svg>
		</td></tr>
		<tr><td></td></tr>
	</table>
	<table>
		<tr><td></td></tr>
	</table>	
																											<!-- SCHEMA -->	
	<table class="blanc2">	
		<tr height="30px"><td>
				<b>Process : </b>
				<select id="boucle" onchange="change_image(this.value);">
					<option value="BSO">Boucle Ouverte</option>
					<!-- <option value="BSF">Boucle Simple Fermée</option> -->
					<!-- <option value="BMO">Boucle Mixte Ouverte</option> -->
					<option value="BMF">Boucle Fermée</option>
				</select>
				<input type="button" onclick="dessiner();" value="Calculer" />
				- 10 carreaux = <input type="text" value="200" id="Echelle_x" size="5"/> s
			</td></tr>
		<tr><td>
			<img src="BSO.svg" id="image"/>
		</td></tr>
	</table>
																											<!-- REGLAGES -->	

	<table class="blanc3">
		<tr>
			<td>
				A1
			</td>
			<td>
				Td1 (en s)
			</td>
			<td>
				Ti1 (en s)
			</td>
			<td>
				A2
			</td>
			<td>
				<div id="TY">Y=50%</div>
			</td>
			<td>
				<div id="TZ">&Delta;Z</div>
			</td>
			<td>
				<div id="TW">W</div>
			</td>
		</tr><tr>
			<td>
				<input type="text" id="A1" value="1" size="10px"/>
			</td>
			<td>
				<input type="text" id="TD1" value="0" size="10px"/>
			</td>
			<td>
				<input type="text" id="TI1" value="9999" size="10px"/>
			</td>
			<td>
				<input type="text" id="A2" value="0" size="10px"/>
			</td>			
			<td id="TDY">
				<input type="checkbox" id="Y" name="Y=50%" value="&Delta;Y" onchange="casacocher(this.id,'Z','W');" >
			</td>
			<td id="TDZ">
				<input type="checkbox" id="Z" name="Z=0%" value="&Delta;Z" onchange="casacocher(this.id,'W','Y');" checked>
			</td>
			<td id="TDW">
				
			</td>
		</tr>
	</table>



		
	</body>
</html>




