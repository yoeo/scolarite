<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<div>Entrez les informations sur l'étudiant</div>
<form action="index.php?action=ajouternote" method="post">
	<table class="tableau-element-ajouter">
		<tr>
			<td>
				<div>Etudiant</div>
			</td>
			<td>
				<select name="id_etudiant">
				<?php
				foreach ($listeEtudiant as $i => $etudiant)
				{
					echo
					"
					<option value=\"$etudiant->id\">$etudiant->filiere : $etudiant->nom $etudiant->prenom</option>
					";
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<div>Valeur</div>
			</td>
			<td>
				<input name="valeur" type="text" value="" />
			</td>
		</tr>
		<tr>
			<td>
				<div>Type</div>
			</td>
			<td>
				<select name="type">
				<?php
				$lignes = file ("vues/$vue/typenote.txt");
				foreach ($lignes as $i => $type)
				{
					echo
					"
					<option value=\"$type\">$type</option>
					";
				}
				?>
				</select>
			</td>
		</tr>
	</table>
	<input type="hidden" name="existe" value="true" />
	<div class="tableau-element-valider"><input type="submit" value="valider" /></div>
</form>
