<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<table id="tableau-element" cellspacing="0px">
	<tr id="tableau-element-entete">
		<td>
			Nom
		</td>
		<td>
			Prenom
		</td>
		<td>
			Matière
		</td>
		<td>
			Supprimer
		</td>
	</tr>
	<?php
	foreach ($liste as $i => $enseignant)
	{
	?>
	<tr class="tableau-element-ligne<?php echo (($i % 2) == 0) ? '1' : '2' ?>">
		<td>
			<?php echo $enseignant->nom ?>
		</td>
		<td>
			<?php echo $enseignant->prenom ?>
		</td>
		<td>
			<?php echo $enseignant->matiere ?>
		</td>
		<td>
			<a href="index.php?action=supprimerenseignant&id=<?php echo $enseignant->id ?>">
				<div class="tableau-supprimer">&nbsp;</div>
				</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>