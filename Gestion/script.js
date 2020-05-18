var mytempo;

function myInfo(nom) {
  mytempo = setTimeout(function(){lecture_json(nom)}, 3000);//2 s avant affichage des infos
}

function myStopInfo() {
  clearTimeout(mytempo);
}

function lecture_json(nom){
	var request = new XMLHttpRequest();
	var reponse;
	var source = './infos_json.php?nom='+nom;
	
	request.open('GET', source);
	request.responseType = 'text';
	
	request.onload = function() {
		data = request.response;
		//message = data.nom+' - '+data.prenom+' - '+data.Motdepasse;
		alert(data);
	};	
	
	request.send();
}

function message(msg){
    if (window.webkitNotifications) {
        if (window.webkitNotifications.checkPermission() == 0) {
        notification = window.webkitNotifications.createNotification(
          'picture.png', 'Gestion des classes', msg);
                    notification.onshow = function() { // when message shows up
                        setTimeout(function() {
                            notification.close();
                        }, 1000); // close message after one second...
                    };
        notification.show();
      } else {
        window.webkitNotifications.requestPermission(); // ask for permissions
      }
    }
    else {
        alert(msg);// fallback for people who does not have notification API; show alert box instead
    }
}

function newclasse(lavaleur){
	var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour

	document.cookie = 'laclasse='+lavaleur+"; path=/; expires="+date.toUTCString();
	location.reload() ;
}

function cira(){
	var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
	classe = document.getElementById('classe').value;
	document.cookie = 'laclasse='+classe+"; path=/; expires="+date.toUTCString();
	location.reload() ;
}

function motdepasse(){
	var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour

	elv = document.getElementById('nom').value;
	document.cookie = 'elv='+elv+"; expires="+date.toUTCString();
	motdepasse = document.getElementById('pwd').value;
	document.cookie = 'password='+motdepasse+"; expires="+date.toUTCString();

	location.reload() ;
}

function tailledelafenetre(){
	document.cookie = 'largeur='+window.innerWidth;
}

function C_leprof(){
	var date = new Date(Date.now() + 86400000*30);//86400000 = 1 jour
	document.cookie = 'nom=Professeur; path=/; expires='+date.toUTCString();
}


function out(){
	document.cookie = 'password= ';
	location.reload() ;
}

function gotolien(lien){
	window.location.replace(lien);
}

