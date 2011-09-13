<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<div>Entrez les informations sur l'enseignant</div>
<form action="index.php?action=ajouterenseignant" method="post">
	<table class="tableau-element-ajouter">
		<tr>
			<td>
				<div>Nom</div>
			</td>
			<td>
				<input name="nom" type="text" value="" />
			</td>
			<td>
				<div>Prénom</div>
			</td>
			<td>
				<input name="prenom" type="text" value="" />
			</td>
		</tr>
		<tr>
			<td>
				<div>Matière</div>
			</td>
			<td>
				<input name="matiere" type="text" value="" />
			</td>
			<td>
				&nbsp;
			</td>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td>
				<div>Identifiant</div>
			</td>
			<td>
				<input name="identifiant" type="text" value="" />
			</td>
			<td>
				<div>Mot de passe</div>
			</td>
			<td>
				<input name="pass" type="password" value="" />
			</td>
		</tr>
	</table>
	<input type="hidden" name="existe" value="true" />
	<div class="tableau-element-valider"><input type="submit" value="valider" /></div>
</form>
