//Constantes Graphique
var XX0 = 25;
var DeltaX = 650;
var YY0 = 330;
var DeltaY = -300;
var Xmini, Xmaxi, Ymini, Ymaxi;
var X1Value = Array(10);
var Y1Value = Array(10);
var X2Value = Array(10);
var Y2Value = Array(10);
var numero2ligne = 0;
var ligne_a_effacer;
//courbe.setAttribute("points", points);
var Str;



function trace_courbes() {
	var courbe1 = document.getElementById("courbe1");
	var courbe2 = document.getElementById("courbe2");
	var XXX,YYY,points;
	
	if((X1Value[0]!="")&(Y1Value[0]!="")) {
		XXX = XX0 + X1Value[0]*DeltaX/(Xmaxi-Xmini);//X1Value[0]*1 + XX0;
		YYY = YY0 + Y1Value[0]*DeltaY/(Ymaxi-Ymini);//Y1Value[0]*1 + YY0;
		points = XXX+","+YYY;
		for(i=1;i<10;i++) 
			if((X1Value[i]!="")&(Y1Value[i]!="")) {
				XXX = XX0 + X1Value[i]*DeltaX/(Xmaxi-Xmini)
				YYY = YY0 + Y1Value[i]*DeltaY/(Ymaxi-Ymini);
				points = points+" "+XXX+","+YYY;				
			}
	}
	courbe1.setAttribute("points", points);
	
	
	points = "";
	if((X2Value[0]!="")&(Y2Value[0]!="")) {
		XXX = XX0 + X2Value[0]*DeltaX/(Xmaxi-Xmini);//X1Value[0]*1 + XX0;
		YYY = YY0 + Y2Value[0]*DeltaY/(Ymaxi-Ymini);//Y1Value[0]*1 + YY0;
		points = XXX+","+YYY;
		for(i=1;i<10;i++) 
			if((X2Value[i]!="")&(Y2Value[i]!="")) {
				XXX = XX0 + X2Value[i]*DeltaX/(Xmaxi-Xmini)
				YYY = YY0 + Y2Value[i]*DeltaY/(Ymaxi-Ymini);
				points = points+" "+XXX+","+YYY;				
			}
	}
	courbe2.setAttribute("points", points);
}



function efface_graphique(){
	var graphe = document.getElementById("graphe");
	for(i=1;i<numero2ligne+1;i++) {
		ligne_a_effacer = document.getElementById("droite"+i);
		graphe.removeChild(ligne_a_effacer);
	}
	numero2ligne = 0;
	
	var courbe1 = document.getElementById("courbe1");
	var courbe2 = document.getElementById("courbe2");
	var points="";
	courbe1.setAttribute("points", points);
	courbe2.setAttribute("points", points);
}

function createline(x1, y1, x2, y2, color, w) {
    var aLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
    numero2ligne++;
    aLine.setAttribute('x1', x1);
    aLine.setAttribute('y1', y1);
    aLine.setAttribute('x2', x2);
    aLine.setAttribute('y2', y2);
    aLine.setAttribute('stroke', color);
    aLine.setAttribute('stroke-width', w);
    aLine.setAttribute('id', "droite"+numero2ligne);
    return aLine;
}

function verticale(valeur_X) {
	var graphe = document.getElementById("graphe");
	var xx = createline(valeur_X, 30, valeur_X, 330, 'rgb(128,128,128)', 1);
    graphe.appendChild(xx);
}

function horizontale(valeur_Y) {
	var graphe = document.getElementById("graphe");
	var xx = createline(25, valeur_Y, 675, valeur_Y, 'rgb(128,128,128)', 1);
    graphe.appendChild(xx);
}
	
function AxeX() {
	var texte1 = document.getElementById("Legende_X1_txt");
	var champs1 = document.getElementById("Legende_X");
	
	champs1.innerHTML = texte1.value;
	var step_txt = document.getElementById("X_step");
	var step = step_txt.value.replace(",", ".");
	
	var texte2 = document.getElementById("X_unit");
	var champs2 = document.getElementById("Echelle_X");
	champs2.innerHTML = step_txt.value+texte2.value+" par graduation";
	
	var Xmini_str = document.getElementById("X_min");
	Xmini = Xmini_str.value.replace(",", ".");
	var Xmaxi_str = document.getElementById("X_max");
	Xmaxi = Xmaxi_str.value.replace(",", ".");
	
	var champs3 = document.getElementById("X0");
	champs3.innerHTML = Xmini_str.value;
	
	var XX = XX0 + step*DeltaX/(Xmaxi-Xmini);
	while(XX<XX0+DeltaX+1) {
		verticale(Math.round(XX-1));
		XX = XX + step*DeltaX/(Xmaxi-Xmini);
	}	
}

function AxeY() {
	var texte1 = document.getElementById("Legende_Y1_txt");
	var champs1 = document.getElementById("Legende_Y1");
	champs1.innerHTML = texte1.value;
	var texte2 = document.getElementById("Legende_Y2_txt");
	var champs2 = document.getElementById("Legende_Y2");
	champs2.innerHTML = texte2.value; 
	
	var step_txt = document.getElementById("Y_step");
	var step = step_txt.value.replace(",", ".");
	
	var texte3 = document.getElementById("Y_unit");
	var champs3 = document.getElementById("Echelle_Y");
	champs3.innerHTML = step_txt.value+texte3.value+" par graduation";
	
	var Ymini_str = document.getElementById("Y_min");
	Ymini = Ymini_str.value.replace(",", ".");
	var Ymaxi_str = document.getElementById("Y_max");
	Ymaxi = Ymaxi_str.value.replace(",", ".");
	
	var champs4 = document.getElementById("Y0");
	champs4.innerHTML = Ymini_str.value;
	
	var YY = YY0 + step*DeltaY/(Ymaxi-Ymini);
	while(YY>YY0+DeltaY-1) {
		horizontale(Math.round(YY+1));
		YY = YY + step*DeltaY/(Ymaxi-Ymini);
	}	
}

function get_value() {
	for(i=0;i<10;i++) {
		Str = document.getElementById("X1"+i);
		X1Value[i] = Str.value.replace(",", ".");
	}
	for(i=0;i<10;i++) {
		Str = document.getElementById("Y1"+i);
		Y1Value[i] = Str.value.replace(",", ".");
	}
	for(i=0;i<10;i++) {
		Str = document.getElementById("X2"+i);
		X2Value[i] = Str.value.replace(",", ".");
	}
	for(i=0;i<10;i++) {
		Str = document.getElementById("Y2"+i);
		Y2Value[i] = Str.value.replace(",", ".");
	}
}



function dessine() {
	efface_graphique();
	AxeX();
	AxeY();
	get_value();
	trace_courbes();
}

function export_png() {
	var svg = document.getElementById("graphe");
	saveSvgAsPng(svg, "reponse_ind.png");
}
