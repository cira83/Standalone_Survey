function noter(quest){
	var image1 = document.getElementById("N"+quest.substring(1));
	var image2 = document.getElementById("M"+quest.substring(1));
	var coef = document.getElementById("C"+quest.substring(1));
	var note = document.getElementById("E"+quest.substring(1));
    
    newimage = "./icon/" + quest[0] + ".gif";
	image1.setAttribute("src", newimage);
	image2.setAttribute("src", newimage);
	
	if(quest[0]=="A") note.innerHTML = coef.innerHTML;
	if(quest[0]=="B") note.innerHTML = 0.75*coef.innerHTML;
	if(quest[0]=="C") note.innerHTML = 0.35*coef.innerHTML;
	if(quest[0]=="D") note.innerHTML = 0.05*coef.innerHTML;
	if(quest[0]=="X") note.innerHTML = 0;
	
	save_note(quest.substring(1),quest[0]);
}

function save_note(numero,note) {
	var nom_input = document.getElementById("nom_elv");
	var nom_elv = nom_input.value;
	var classe_input = document.getElementById("classe");
	var classe_elv = classe_input.value; 
	var code_input = document.getElementById("coderep");
	var code_elv = code_input.value;    
	var xhr = null;
    var xhr = new XMLHttpRequest();	
    
    chemin = "./noter.php?nota="+classe_elv+":"+nom_elv+":"+note+":"+numero+":"+code_elv;	
	xhr.open("GET", chemin, true);
	xhr.send(null);
}







