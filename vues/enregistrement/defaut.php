<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<html>
	<head>
		<title> Enregistrement </title>		
		<link type="image/x-icon" href="<?php echo $theme ?>icon.png" rel="icon" />
		<link type="text/css" rel="stylesheet" href="<?php echo $theme ?>style.css"> </script>
		<script language="javascript" src="<?php echo $theme ?>script.js"> </script>
	</head>
	
	<body>
		<div id="contenu-enregistrement">
			<div>
				<form name="identification" method="post" action="index.php?action=enregistrer">
					<div id="message-enregistrement">Identifiez vous s'il vous plait</div>
					<div id="info"><?php echo $message ?>&nbsp;</div>
					<table id="form-enregistrement">
						<tr>
							<td>Identifiant : </td>
							<td><input name="identifiant" type="text" /></td>
						</tr>
						<tr>
							<td>Mot de passe : </td>
							<td><input name="mot_de_passe" type="password" /></td>
						<tr>
						<tr>
							<td> </td>
							<td><input name="valider" type="submit"  value="Valider" /></td>
						<tr>
					</table>
				</form>
			</div>
			
		</div>
		<div id="credit">
			<a href="mailto:y.deo@hotmail.com">Développé par SOMDA Yandaar Déogracias Eric</a>
		</div>
	</body>
</html>