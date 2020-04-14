<?php
/* On démarre la session AVANT d'écrire du code HTML*/ session_start();
	$numero = session_id();//Numero des fichiers
	$name = $_COOKIE['nom'];
?>

<html>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------>
	<head>
		<link rel="stylesheet" type="text/css" media="screen" href="styles_sujet.css">
		<link rel="stylesheet" type="text/css" href="print.css" media="print">
		<script type="text/javascript" src="./save-svg-as-png/lib/saveSvgAsPng.js"></script>
		<script type="text/javascript" src="./script.js"></script>
		<title>EasyGraph</title>
	</head>
	<body>

	<table><tr><td width="65px"><img src="LOGO.gif" height="60px" title="BTS CIRA ROUVIERE"/></td>
	<td><h1>EasyGraph</h1></td><td width="65px"></td>
	<td width="65px"><img src="backup.gif" height="35px" onclick="export_png();" title="Exporter le graphique"/></td></tr></table>


<!--
	taille tableau = 800 x 400
	taille image = 700 x 350
-->

	<table class="blanc">

		<tr><td colspan="3">																											<!-- GRAPHIQUE -->
			<svg id="graphe" width="700" height="350">
				<rect width="700" height="350" style="fill:rgb(255,255,255);stroke-width:0;stroke:rgb(255,255,255)" />
				<text x="450" y="65" fill="#DDD" id="Session"><?php echo($numero); ?></text><!-- FILIGRAMME -->
				<text x="450" y="45" fill="#DDD" id="Nom"><?php echo($name); ?></text>
				<!--
					(0,0) = 25,330
				-->
				<line x1="25" y1="330" x2="25" y2="30" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_y"/>
				<line x1="25" y1="330" x2="675" y2="330" style="stroke:rgb(0,0,0);stroke-width:2" id="axe_x"/>


				<text x="676" y="335" fill="black" id="Y0">0</text>
				<text x="20" y="345" fill="black" id="X0">0</text>


				<text x="30" y="25" fill="blue" id="Legende_Y1">Mesure 1</text>
				<text x="350" y="25" fill="green" id="Legende_Y2">Mesure 2</text>
				<text x="100" y="345" fill="black" id="Legende_X">Commande</text>
				<text transform="matrix(-0, -1, 1, -0, 20, 250)" id="Echelle_Y">1% par graduation</text>
				<text x="500" y="345" fill="black" id="Echelle_X">1% par graduation</text>

				<polyline points="" style="fill:none;stroke:blue;stroke-width:2" id="courbe1"/>
				<polyline points="" style="fill:none;stroke:green;stroke-width:2" id="courbe2"/>

			</svg>
		</td></tr>
	</table>
																											<!-- TABLEAU -->
	<table class="blanc2">
		<tr>
			<tr><td class="blue">X1</td><td class="blue">Y1</td><td class="green">X2</td><td class="green">Y2</td></tr>
			<tr><td><input type="text" id="X10" value="0" size="10px"/></td><td><input type="text" id="Y10" value="0" size="10px"/>
			</td><td><input type="text" id="X20" value="" size="10px"/></td><td><input type="text" id="Y20" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X11" value="5" size="10px"/></td><td><input type="text" id="Y11" value="9" size="10px"/>
			</td><td><input type="text" id="X21" value="" size="10px"/></td><td><input type="text" id="Y21" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X12" value="" size="10px"/></td><td><input type="text" id="Y12" value="" size="10px"/>
			</td><td><input type="text" id="X22" value="" size="10px"/></td><td><input type="text" id="Y22" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X13" value="" size="10px"/></td><td><input type="text" id="Y13" value="" size="10px"/>
			</td><td><input type="text" id="X23" value="" size="10px"/></td><td><input type="text" id="Y23" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X14" value="" size="10px"/></td><td><input type="text" id="Y14" value="" size="10px"/>
			</td><td><input type="text" id="X24" value="" size="10px"/></td><td><input type="text" id="Y24" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X15" value="" size="10px"/></td><td><input type="text" id="Y15" value="" size="10px"/>
			</td><td><input type="text" id="X25" value="" size="10px"/></td><td><input type="text" id="Y25" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X16" value="" size="10px"/></td><td><input type="text" id="Y16" value="" size="10px"/>
			</td><td><input type="text" id="X26" value="" size="10px"/></td><td><input type="text" id="Y26" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X17" value="" size="10px"/></td><td><input type="text" id="Y17" value="" size="10px"/>
			</td><td><input type="text" id="X27" value="" size="10px"/></td><td><input type="text" id="Y27" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X18" value="" size="10px"/></td><td><input type="text" id="Y18" value="" size="10px"/>
			</td><td><input type="text" id="X28" value="" size="10px"/></td><td><input type="text" id="Y28" value="" size="10px"/></td></tr>
			<tr><td><input type="text" id="X19" value="" size="10px"/></td><td><input type="text" id="Y19" value="" size="10px"/>
			</td><td><input type="text" id="X29" value="" size="10px"/></td><td><input type="text" id="Y29" value="" size="10px"/></td></tr>
		</tr>
	</table>
																											<!-- REGLAGES -->

	<table class="blanc3">
		<tr>
			<td colspan="2" class="black">

				<input type="text" size="20" id="Legende_X1_txt" value="Commande"/>
				<br>Legende X
			</td>
			<td colspan="2" class="blue">
				<input type="text" size="20" id="Legende_Y1_txt" value="Mesure 1"/>
				<br>Legende Y1
			</td>
			<td colspan="2" class="green">
				<input type="text" size="20" id="Legende_Y2_txt" value="Mesure 2"/>
				<br>Legende Y2
			</td>
			<td bgcolor="#bce368" class="black">
				<img src="write.gif" width="30px" onclick="dessine();" title="Dessine graphique">
			</td><td bgcolor="#f44128" class="black">
				<img src="efface.gif" width="30px"  title="Efface graphique" onclick="efface_graphique();">
			</td>
		</tr>
		<tr>
			<td width="12.5%">
				<input type="text" id="X_min" value="0" size="10px"/>
			</td>
			<td width="12.5%">
				<input type="text" id="X_max" value="100" size="10px"/>
			</td>
			<td width="12.5%">
				<input type="text" id="X_step" value="10" size="10px"/>
			</td>
			<td width="12.5%">
				<input type="text" id="X_unit" value="%" size="5px"/>
			</td>
			<td width="12.5%">
				<input type="text" id="Y_min" value="0" size="10px"/>
			</td>
			<td width="12.5%">
				<input type="text" id="Y_max" value="100" size="10px"/>
			</td>
			<td width="12.5%">
				<input type="text" id="Y_step" value="10" size="10px"/>
			</td>
			<td>
				<input type="text" id="Y_unit" value="%" size="5px"/>
			</td>
		</tr>
		<tr>
			<td class="neg">
				X<sub>Min</sub>
			</td>
			<td class="neg">
				X<sub>Max</sub>
			</td>
			<td class="neg">
				Graduation
			</td>
			<td class="neg">
				Unité
			</td>
			<td class="neg">
				Y<sub>Min</sub>
			</td>
			<td class="neg">
				Y<sub>Max</sub>
			</td>
			<td class="neg">
				Graduation
			</td>
			<td class="neg">
				Unité
			</td>
		</tr>

	</table>




	</body>
</html>
