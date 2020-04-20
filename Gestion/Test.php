<script>
	function mot2passe() {
		code = prompt('Donner le code','');
		document.cookie = "code4="+code;
	}
</script>





<?php
	$rentre = "<script>mot2passe();</script>";
	if($_COOKIE['code4']!="hello") echo($rentre);
	
?>