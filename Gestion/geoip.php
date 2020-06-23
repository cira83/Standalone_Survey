
<script type="text/javascript">

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

<body onload="locate_ip('8.8.8.8')">
</body>