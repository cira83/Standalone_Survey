<h1>Ajouter un ticket</h1>
<form method="post" action="Ticket.php?sujet=<?php echo($tp);?>">
	<table>
		<tr class="orange">
			<td>Sujet de TP</td>
			<td>Indications</td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo($tp);?></td>
			<td><input type="text" size="100" name="indications"></td>
			<td><input type="hidden" name="drap" value="1"><input type="submit"></td>
		</tr>
	</table>
</form>
