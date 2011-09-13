<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<table id="tableau-element" cellspacing="0px">
	<tr id="tableau-element-entete">
		<td>
			Type de note
		</td>
		<td>
			Note
		</td>
		<td>
			Matière
		</td>
		<td>
			Enseignant
		</td>
	</tr>
	<?php
	foreach ($liste as $i => $note)
	{
	?>
	<tr class="tableau-element-ligne<?php echo (($i % 2) == 0) ? '1' : '2' ?>">
		<td>
			<?php echo $note->type ?>
		</td>
		<td>
			<?php echo $note->valeur ?>
		</td>
		<td>
			<?php echo $note->matiere ?>
		</td>
		<td>
			<?php echo $note->nom." ".$note->prenom ?>
		</td>
	</tr>
	<?php
	}
	?>
</table>