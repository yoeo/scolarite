<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<table id="tableau-element" cellspacing="0px">
	<tr id="tableau-element-entete">
		<td>
			Filiaire
		</td>
		<td>
			Etudiant
		</td>
		<td>
			Valeur
		</td>
		<td>
			Type
		</td>
		<td>
			Supprimer
		</td>
	</tr>
	<?php
	foreach ($liste as $i => $note)
	{
	?>
	<tr class="tableau-element-ligne<?php echo (($i % 2) == 0) ? '1' : '2' ?>">
		<td>
			<?php echo $note->filiere ?>
		</td>
		<td>
			<?php echo $note->nom.' '.$note->prenom ?>
		</td>
		<td>
			<?php echo $note->valeur ?>
		</td>
		<td>
			<?php echo $note->type ?>
		</td>
		<td>
			<a href="index.php?action=supprimernote&id=<?php echo ''.$note->id_note ?>">
				<div class="tableau-supprimer">&nbsp;</div>
				</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>