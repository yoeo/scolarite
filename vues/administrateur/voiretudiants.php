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
			Matricule
		</td>
		<td>
			Filiere
		</td>
		<td>
			Supprimer
		</td>
	</tr>
	<?php
	foreach ($liste as $i => $etudiant)
	{
	?>
	<tr class="tableau-element-ligne<?php echo (($i % 2) == 0) ? '1' : '2' ?>">
		<td>
			<?php echo $etudiant->nom ?>
		</td>
		<td>
			<?php echo $etudiant->prenom ?>
		</td>
		<td>
			<?php echo $etudiant->matricule ?>
		</td>
		<td>
			<?php echo $etudiant->filiere ?>
		</td>
		<td>
			<a href="index.php?action=supprimeretudiant&id=<?php echo $etudiant->id ?>">
				<div class="tableau-supprimer">&nbsp;</div>
				</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>