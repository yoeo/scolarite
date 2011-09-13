<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');
?>

<html>
	<head>
		<title> Bonjour <?php echo $admin->nom ?>! </title>		
		<link type="image/x-icon" href="<?php echo $theme ?>icon.png" rel="icon" />
		<link type="text/css" rel="stylesheet" href="<?php echo $theme ?>style.css" />
		<script language="javascript" src="<?php echo $theme ?>script.js"> </script>
	</head>
	
	<body>
		<div id="contenu">
			<div id="entete-identifiant">
				Bonjour,
				<a href="index.php?action=accueil">
					<?php echo $admin->nom ?> <?php echo $admin->prenom ?>
				</a>.
				(<?php echo $admin->identifiant ?>)
			</div>
			<div id="entete-deconnecter">
				<a href="index.php?action=deconnecter">Se d&eacute;connecter</a>
			</div>
			<div id="entete-fin">&nbsp;</div>
			<table id="menu">
				<tr>
					<td>
						<a href="index.php?action=voiretudiants"><div>Voir les étudiants</div></a>
					</td>
					<td>
						<a href="index.php?action=voirenseignants"><div>Voir les enseignants</div></a>
					</td>
					<td>
						<a href="index.php?action=ajouteretudiant"><div>Ajouter un étudiant</div></a>
					</td>
					<td>
						<a href="index.php?action=ajouterenseignant"><div>Ajouter un enseignants</div></a>
					</td>
				</tr>
			</table>
			<div id="cadre">
				<div id="boite">
					<span id="info"><?php echo StripSlashes($message) ?>&nbsp;</span>
					<?php
					include ('vues/'.$vueAction.'.php');
					?>
				</div>
			</div>
		</div>	
		
		<div id="credit">
			<a href="mailto:y.deo@hotmail.com">Développé par SOMDA Yandaar Déogracias Eric</a>
		</div>
	</body>
</html>