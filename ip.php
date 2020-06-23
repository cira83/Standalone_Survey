<?php
	$output = shell_exec('ip -4 -o addr show');
	echo "$output";
?>
