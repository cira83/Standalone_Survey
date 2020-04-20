
function newclasse(lavaleur){
	document.cookie = 'laclasse='+lavaleur;
	lien = './index.php';
	window.location.replace(lien);
}

function login2(){
	
	pwd = document.getElementById('password').value;
	elv = document.getElementById('elv').value;
	classe = document.getElementById('classe').value;
		
	document.cookie = 'elv='+elv;
	document.cookie = 'password='+pwd;
	document.cookie = 'laclasse='+classe;	
	
	lien = './index.php?action=4';
	window.location.replace(lien);
}

	
function login(lavaleur){
	pwd = document.getElementById('password').value;
	elv = document.getElementById('elv').value;
	classe = document.getElementById('hidden').value;
		
	document.cookie = 'elv='+elv;
	document.cookie = 'password='+pwd;
	document.cookie = 'laclasse='+classe;
			
	if(lavaleur==1) lien = './documents.php';
	if(lavaleur==2) lien = './info4elv.php';
	if(lavaleur==3) lien = './cahier4elv.php';
	if(lavaleur==4) lien = './tests.php';
	if(lavaleur==5) lien = './appel.php';
	
	window.location.replace(lien);
}

function logout(){
	document.cookie = 'elv=';
	document.cookie = 'password=';
	lien = './index.php';
	window.location.replace(lien);
}


function direction(lavaleur){
	if(lavaleur==0) lien = './index.php';
	if(lavaleur==1) lien = './documents.php';
	if(lavaleur==2) lien = './info4elv.php';
	if(lavaleur==3) lien = './cahier4elv.php';
	if(lavaleur==4) lien = './tests.php';
	if(lavaleur==5) lien = './appel.php';
	if(lavaleur==6) lien = '../index.php';
	if(lavaleur==10) lien = 'http://macbook-air.lyc-rouviere-83.region-paca.lan';
	
	window.location.replace(lien);
}

function reload(number,niveau){
	lien = './documents.php?number='+number+'&niveau='+niveau;
	window.location.replace(lien);
}

function repondre(filename,numero){
	document.cookie = 'numero='+numero;
	rep = document.getElementById('rep').value;
	lien = './questionnaire.php?filename='+filename+'&rang=2'+'&rep='+rep;
	window.location.replace(lien);
}

function repondreA(filename,numero,rep){//Le 20 août 2016
	document.cookie = 'numero='+numero;
	lien = './questionnaire.php?filename='+filename+'&rang=2'+'&rep='+rep;
	window.location.replace(lien);
}

function suivante(filename,justes){
	document.cookie = 'justes='+justes;
	lien = './questionnaire.php?filename='+filename+'&rang=1';
	window.location.replace(lien);
}

function raz(filename){
	document.cookie = 'numero='+0;
	document.cookie = 'justes='+0;
	lien = './questionnaire.php?filename='+filename+'&rang=0';
	window.location.replace(lien);
}

function raz2(){
	document.cookie = 'numero='+0;
	document.cookie = 'justes='+0;
}
