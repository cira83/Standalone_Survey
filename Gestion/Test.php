<html>
	<head>
<script>
	function test() {
		var div = document.getElementById('test');
		
		div.innerHTML = "<table><tr><td>coucou</td></tr></table><table><tr><td>coucou</td></tr></table>";
	}
</script>
	</head>
<body onload="test();">
	<div id="test"> ---- </div>
	
</body>