<!--                             NEWEPREUVE.PHP                     -->
<hr/>
<?php
	$dirlist = scandir("./files/$classe/");
	$partiel_list = "<select name=\"mat\"/><option selected>----</option>";
	foreach($dirlist as $dir){
		if(($dir[0]!="_")&&($dir[0]!=".")) $partiel_list .= "<option>$dir</option>";
	}
	$partiel_list .= "</select>";
?>
<center>
<form action="./epreuve.php" method="post">
		<p>Matière : <?php echo($partiel_list)?> - 
		Epreuve : <input type="text" name="epreuve" size="20"> - 
	<input type="submit" value="Cr&eacute;ation des copies">
	<input type="hidden" value="<?php echo($listedesparticipants); ?>" name="laliste"></p>
</form>
</center>
