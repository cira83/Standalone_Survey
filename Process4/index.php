<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
	$numero = session_id();//Numero des fichiers 
	$nom_elv = $_SESSION['nom'];
?>

<html>
<script>
	var Int = [0,0,0];//Actions Intégrale de chaque correcteur
	
	function premier_ordre(a, En, Sn1) {// a = Tau/Te
		var Sn=0;
		Sn = (En+a*Sn1)/(a+1);
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
		var Td2 = document.getElementById("TD2");
		Td2.value = Td2.value.replace(",",".");
		var Ti1 = document.getElementById("TI1");
		Ti1.value = Ti1.value.replace(",",".");
		var Ti2 = document.getElementById("TI2");
		Ti2.value = Ti2.value.replace(",",".");
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
		var Ti1 = document.getElementById("TI1");
		var Td1 = document.getElementById("TD1");
		var A2 = document.getElementById("A2");
		var Ti2 = document.getElementById("TI2");
		var Td2 = document.getElementById("TD2");
		var X10_Elt = document.getElementById("Echelle_x");
		var a=0, Y1=0,Y11=0,Y2=0,Y22=0,X1=0,X2=0,tau=20,eps11=0,eps22=0,W=0;
		
		
		Int[1] = 0; //RAZ de intégrale 1
		Int[2] = 0; //RAZ de intégrale 2
		X10 = "0";
		info = "";
		X2 = 0;
		Tn = 0;
		Y22 = 0;
		points = "25,330"; //Premier point à 0 0 
		X10 = X10_Elt.value;
		
		
		if(boucle.value=="BO21") { //Boucle esclave ouverte. Y2 -| |- Y22 -| |- X2
			echelX = 10*50/X10;
			info = "Boucle esclave ouverte - X2 pour ΔY2=50% ; X2(∞)=50% ";
			Te = 0.1*X10/50;
			a = tau/Te;
			Tn = Te + Tn;
			for(i=0;i<650;i++) {
				Y22 = premier_ordre(a, 50, Y22);//a, En, Sn_1 a = Tau/Te
				X2 = premier_ordre(a, Y22, X2); 
				Yn_string = ordonne2string(X2);	
				Xn_string = abscisse2string(Tn,echelX);		
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
		}

		if(boucle.value=="BO1") { //Boucle simple ouverte Y1 -| |- Y11 -| |- X2 -| |- Y22 -| |- X1
			echelX = 10*50/X10;
			info = "Boucle simple ouverte - X1 pour ΔY1=50% ; X1(∞)=50% ";
			Te = 0.1*X10/50;
			a = tau/Te; 
			Tn = Te + Tn;
			for(i=0;i<650;i++) {
				Y11 = premier_ordre(a, 50, Y11);
				X2 = premier_ordre(a, Y11, X2);
				Y22 = premier_ordre(a, X2, Y22);
				X1 = premier_ordre(a, Y22, X1);//alert(Y11+" "+X2+" "+Y22+" "+X1);

				Yn_string = ordonne2string(X1);	
				Xn_string = abscisse2string(Tn,echelX);		
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
		}


		if(boucle.value=="BF2O1") {//Boucle esclave fermée
			echelX = 10*50/X10;
			info = "Boucle esclave fermée - X2 pour ΔY1=50% - A2="+A2.value+" ; Td2 = "+Td2.value+" ; Ti2 = "+Ti2.value;
			Te = 0.1*X10/50;
			a = tau/Te;
			Tn = Te + Tn;
			Y1 = 50;
			eps11 = 0;
			for(i=0;i<650;i++) {
				Y2 = PID(A2.value,Ti2.value,Td2.value,Te,Y1-X2,eps11,2);
				eps11=Y1-X2;								
				Y22 = premier_ordre(a, Y2, Y22);//a, En, Sn_1 a = Tau/Te
				X2 = premier_ordre(a, Y22, X2); 
				
				Yn_string = ordonne2string(X2);	
				Xn_string = abscisse2string(Tn,echelX);
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
		}	

		if(boucle.value=="BO2") {//Boucle Maitre ouverte
			echelX = 10*50/X10;
			info = "Boucle maitre ouverte - X2 pour ΔY1=50% - A2="+A2.value+" ; Td2 = "+Td2.value+" ; Ti2 = "+Td2.value;
			Te = 0.1*X10/50;
			a = tau/Te;
			Tn = Te + Tn;
			Y1 = 50;
			eps11 = 0;
			for(i=0;i<650;i++) {
				Y2 = PID(A2.value,Ti2.value,Td2.value,Te,Y1-X2,eps11,2);
				eps11=Y1-X2;								
				Y22 = premier_ordre(a, Y2, Y22);//a, En, Sn_1 a = Tau/Te
				X2 = premier_ordre(a, Y22, X2); 
				Y11 = premier_ordre(a, X2, Y11);
				X1 = premier_ordre(a, Y11, X1);
								
				Yn_string = ordonne2string(X1);	
				Xn_string = abscisse2string(Tn,echelX);
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
		}	


		if(boucle.value=="BF2") {//Boucle Maitre fermée Y1 -| |- Y11 -| |- X2 -| |- Y22 -| |- X1
			echelX = 10*50/X10;
			info = "Boucle maitre fermée - X1 pour ΔW=50% - A1="+A1.value+" ; Td1="+Td1.value+" ; Ti1="+Ti1.value+" - A2="+A2.value+" ; Td2="+Td2.value+" ; Ti2="+Ti2.value;
			Te = 0.1*X10/50;
			a = tau/Te;
			Tn = Te + Tn;
			X1 = 0;
			W = 50;
			eps11 = 0;
			for(i=0;i<650;i++) {
				Y1 = PID(A1.value,Ti1.value,Td1.value,Te,W-X1,eps22,1); eps22=W-X1;
				Y2 = PID(A2.value,Ti2.value,Td2.value,Te,Y1-X2,eps11,2);eps11=Y1-X2;
												
				Y22 = premier_ordre(a, Y2, Y22);//a, En, Sn_1 a = Tau/Te
				X2 = premier_ordre(a, Y22, X2); 
				Y11 = premier_ordre(a, X2, Y11);
				X1 = premier_ordre(a, Y11, X1);
								
				Yn_string = ordonne2string(X1);	
				Xn_string = abscisse2string(Tn,echelX);
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
		}			
		
		if(boucle.value=="BF1") {//Boucle simple fermée Y1 -| |- Y11 -| |- X2 -| |- Y22 -| |- X1
			echelX = 10*50/X10;
			info = "Boucle simple fermée - X1 pour ΔW=50% - A1="+A1.value+" ; Td1="+Td1.value+" ; Ti1="+Ti1.value;
			Te = 0.1*X10/50;
			a = tau/Te;
			Tn = Te + Tn;
			X1 = 0;
			W = 50;
			eps11 = 0;
			for(i=0;i<650;i++) {
				Y1 = PID(A1.value,Ti1.value,Td1.value,Te,W-X1,eps22,2); eps22=W-X1;
												
				Y22 = premier_ordre(a, Y1, Y22);//a, En, Sn_1 a = Tau/Te
				X2 = premier_ordre(a, Y22, X2); 
				Y11 = premier_ordre(a, X2, Y11);
				X1 = premier_ordre(a, Y11, X1);
								
				Yn_string = ordonne2string(X1);	
				Xn_string = abscisse2string(Tn,echelX);
				points = points + " " + Xn_string + "," + Yn_string; 
				Tn = Te + Tn;
			}
		}			
		
		
		//---------------------------------------------------- SORTIE DES RESULTATS
		cartouche.innerHTML = info;
		id10.innerHTML = X10;
		courbe.setAttribute("points", points);
	}
	
	
	function change_image(limage) {
    	var image = document.getElementById("image");
    	newimage = limage + ".svg";
		image.setAttribute("src", newimage);
    }

	function export_png() {
		var svg = document.getElementById("graphe");
		saveSvgAsPng(svg, "reponse_ind.png");
	}



</script>
	
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>	
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="print.css" media="print">
		<script type="text/javascript" src="./save-svg-as-png/lib/saveSvgAsPng.js"></script>
		<title>Process 4</title>
	</head>
	<body>
<?php echo("<!-- $nom_elv. -->\n");?> 
	<table><tr><td width="65px"><img src="LOGO.gif" height="60px" /></td><td><h1>PROCESS IV</h1></td><td width="65px"></td></tr></table>


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
				<line x1="20" y1="30" x2="680" y2="30" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="60" x2="680" y2="60" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="90" x2="680" y2="90" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="120" x2="680" y2="120" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="150" x2="680" y2="150" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="180" x2="680" y2="180" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="210" x2="680" y2="210" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="240" x2="680" y2="240" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="270" x2="680" y2="270" style="stroke:rgb(128,128,128);stroke-width:1" />
				<line x1="20" y1="300" x2="680" y2="300" style="stroke:rgb(128,128,128);stroke-width:1" />
				
				<line x1="25" y1="330" x2="680" y2="330" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_x"/>
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


				<text x="10" y="335" fill="black">0</text>
				<text x="0" y="245" fill="black">30</text>
				<text x="0" y="155" fill="black">60</text>
				<text x="0" y="65" fill="black">90</text>
			
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
					<option value="BO1">Boucle Simple Ouverte</option>
					<option value="BF1">Boucle Simple Fermée</option>
					<option value="BO21">Boucle Esclave Ouverte</option>
					<option value="BF2O1">Boucle Esclave Fermée</option>
					<option value="BO2">Boucle Maitre Ouverte</option>
					<option value="BF2">Boucle Maitre Fermée</option>
				</select>
				<input type="button" onclick="dessiner();" value="Calculer" />
				- 10 carreaux = <input type="text" value="200" id="Echelle_x" size="5"/> s
			</td></tr>
		<tr><td>
			<img src="BO1.svg" id="image"/>
		</td></tr>
	</table>
																											<!-- REGLAGES -->	

	<table class="blanc3">
		<tr>
			<td colspan="3">
				PID1
			</td>
			<td colspan="3">
				PID2
			</td>		
		</tr><tr>
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
				Td2 (en s)
			</td>
			<td>
				Ti2 (en s)
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
				<input type="text" id="A2" value="1" size="10px"/>
			</td>
			<td>
				<input type="text" id="TD2" value="0" size="10px"/>
			</td>
			<td>
				<input type="text" id="TI2" value="9999" size="10px"/>
			</td>
		</tr>
	</table>



		
	</body>
</html>




