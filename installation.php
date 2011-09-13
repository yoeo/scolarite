<?php
define ('PAS_D_ACCES_DIRECT', true);

// Initialisation du système
header ('Content-type: text/html; charset=utf-8');
session_start();
session_destroy ();
include ('fonction.php');
?>
<html>
	<head>
		<title> Bienvenue à l'installation automatique de la scolarité en ligne.</title>		
		
		<style type="text/css">
		body
		{
			background:#FFF;
		}

		a,
		a:visited
		{
			color:#00F;
		}

		#contenu
		{
			background: #aec8f8;
			margin: 20%;
			margin-bottom: 0px;
			padding: 20px;
			padding-top: 100px;
			border: 2px solid #06A;
			margin-top: 10px;
		}

		.info
		{
			color: #F30;
			font-size: large;
			font-weight: bold;
		}

		#entete-identifiant
		{
			font-size: large;
		}

		#credit
		{
			background: #aec8f8;
			text-align:center;
			padding: 5px;
			margin: 20%;
			margin-top: 15px;
			margin-bottom: 0px;
			font-weight: bold;
			font-size: small;
			border: 2px solid #06A;
		}

		#credit a
		{
			color:#008;
			text-decoration: none;
		}

		#cadre
		{
			overflow: auto;
			height: 400px;
			background: #FFF;
			border: solid 1px #666;
		}

		#boite
		{
			color: #036;
			padding: 20px;
		}

		.text-important
		{
			/*color: #E31;*/
			color: #1A3;
			font-size: large;
			font-weight: bold;
		}

		.tableau-element-ajouter
		{
			width: 100%;
		}

		.tableau-element-ajouter td
		{
			vertical-align: top;
			padding: 10px;
		}

		.tableau-element-ajouter .ligne1
		{
			background: #DDF;
		}

		.tableau-element-ajouter .ligne2
		{
			background: #EEE;
		}

		.tableau-element-ajouter div
		{
			font-weight: bold;
		}

		.tableau-element-ajouter input
		{
			border: 1px solid #229;
			width: 100%;
		}

		.tableau-element-valider
		{
			width: 100%;
			text-align: center;
			margin-top: 20px;
		}

		.tableau-element-valider input
		{
			width: 75%;
			border: 1px solid #229;
			cursor: pointer;
			background: #DDF;
		}
		</style>
	</head>
	
	<body>
		<div id="contenu">
			<div id="entete-identifiant">
				 Bienvenue à l'installation automatique de la scolarité en ligne.
			</div>
			<div id="entete-fin">&nbsp;</div>
			<div id="cadre">
				<div id="boite">
					<?php
					if (!file_exists ('configuration.php'))
					{
						if (post('nomserveur') && post('nombd') && post('nomutilisateur') && post('theme'))
						{
							$serveur	= post('nomserveur');
							$id			= post('nomutilisateur');
							$pass		= post('passutilisateur');
							$bd			= post('nombd');
							$theme		= post('theme');

							$configuration =
"<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');

// Configuration du site web.

\$scolariteBdServeur		= '$serveur';
\$scolariteBdIdentifiant	= '$id';
\$scolariteBdPass		= '$pass';
\$scolariteBdNom			= '$bd';
\$scolariteTheme			= '$theme';

\$typeUtilisateur = array ('etudiant','enseignant','administrateur');
?>";
							try
							{
								@mysql_connect ($serveur, $id, $pass) or error ("impossible de se connecter à la base de donnée");

								// Liste des bases de données visibles
								@mysql_query ("create database if not exists $bd") or error ("impossible de créer la base de donnée.");
								// fin de la création de la base de données
								
								@mysql_select_db ($bd) or error ("impossible d'accéder à la base de donnée.");
								if (!empty ($_POST['donnee']))
								{
									$bd =
'
--
-- Structure de la table administrateur
--

CREATE TABLE IF NOT EXISTS administrateur
(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom varchar(80) NOT NULL,
	prenom varchar(80) NOT NULL,
	identifiant varchar(80) NOT NULL,
	pass varchar(80) NOT NULL
);
-- --------------------------------------------------------

--
-- Structure de la table enseignant
--

CREATE TABLE IF NOT EXISTS enseignant
(
	id int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom varchar(80) NOT NULL,
	prenom varchar(80) NOT NULL,
	matiere varchar(80) NOT NULL,
	identifiant varchar(80) NOT NULL UNIQUE,
	pass varchar(80) NOT NULL
);
-- --------------------------------------------------------

--
-- Structure de la table etudiant
--

CREATE TABLE IF NOT EXISTS etudiant
(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom varchar(80) NOT NULL,
	prenom varchar(80) NOT NULL,
	identifiant varchar(80) NOT NULL UNIQUE,
	pass varchar(80) NOT NULL,
	matricule varchar(20) NOT NULL UNIQUE,
	filiere varchar(80) NOT NULL
);
-- --------------------------------------------------------

--
-- Structure de la table note
--

CREATE TABLE IF NOT EXISTS note
(
	id int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	valeur int(20) NOT NULL,
	type varchar(80) NOT NULL,
	id_enseignant int(20) NOT NULL,
	id_etudiant int(20) NOT NULL
);


--
-- Contenu de la table administrateur
--

INSERT INTO administrateur (nom, prenom, identifiant, pass) VALUES
("Zahoui", "Mohamed", "admin", "ab4f63f9ac65152575886860dde480a1");

--
-- Contenu de la table enseignant
--

INSERT INTO enseignant (id, nom, prenom, matiere, identifiant, pass) VALUES
(1, "Clamsou", "Karim", "Algorithmique", "prof", "ab4f63f9ac65152575886860dde480a1"),
(2, "Flaman", "Sylvie", "Logique", "logo", "ab4f63f9ac65152575886860dde480a1"),
(3, "Wayne", "Carter", "Nano technologie", "nano", "ab4f63f9ac65152575886860dde480a1");

--
-- Contenu de la table etudiant
--

INSERT INTO etudiant (id, nom, prenom, identifiant, pass, matricule, filiere) VALUES
(1, "Somda", "Yandaar", "etudiant", "ab4f63f9ac65152575886860dde480a1", "X060257", "Master ILTI 2");

INSERT INTO etudiant (nom, prenom, identifiant, pass, matricule, filiere) VALUES
("Calixte", "Grant", "alixte", "ab4f63f9ac65152575886860dde480a1", "X060251", "Master ILTI 2"),
("Surup", "Franc", "alixt", "ab4f63f9ac65152575886860dde480a1", "X060252", "Master ILTI 2"),
("Isop", "Lens", "lixte", "ab4f63f9ac65152575886860dde480a1", "X060253", "Master ILTI 2"),
("Luffy", "Issa", "alixe", "ab4f63f9ac65152575886860dde480a1", "X060254", "Master ILTI 2"),
("Nami", "Marie", "aixte", "ab4f63f9ac65152575886860dde480a1", "X060255", "Master ILTI 2"),
("Naruti", "Sylvie", "xte", "ab4f63f9ac65152575886860dde480a1", "X060256", "Master TI 2"),
("Konoha", "Charlotte", "alixteb", "ab4f63f9ac65152575886860dde480a1", "X060258", "Master TI 2"),
("Kunta", "Carine", "ixte", "ab4f63f9ac65152575886860dde480a1", "X060259", "Master TI 2"),
("Kinte", "Farida", "zete", "ab4f63f9ac65152575886860dde480a1", "X060211", "Master TI 2"),
("Athéna", "Cecile", "zqesd", "ab4f63f9ac65152575886860dde480a1", "X060212", "Master TI 2"),
("Fload", "Flemone", "zfqs", "ab4f63f9ac65152575886860dde480a1", "X060213", "Master TI 2"),
("Sylvain", "Sofie", "qzfq", "ab4f63f9ac65152575886860dde480a1", "X060214", "Licence Technologie du web"),
("Marx", "Quint", "zefcds", "ab4f63f9ac65152575886860dde480a1", "X060231", "Licence Technologie du web"),
("Fast", "Lynda", "zqdf", "ab4f63f9ac65152575886860dde480a1", "X060294", "Licence Technologie du web"),
("Domli", "Ciara", "ompk", "ab4f63f9ac65152575886860dde480a1", "X060265", "Master SIR 2"),
("Pitre", "Maia", "osfdc", "ab4f63f9ac65152575886860dde480a1", "X060298", "Master SIR 2"),
("Tsunade", "Marie", "vsdq", "ab4f63f9ac65152575886860dde480a1", "X060299", "Master SIR 2"),
("Boda", "Bouba", "vubs", "ab4f63f9ac65152575886860dde480a1", "X060599", "Licence Informatique");

--
-- Contenu de la table note
--

INSERT INTO note (valeur, type, id_enseignant, id_etudiant) VALUES
(13, "ETLD", 1, 1),
(15, "ETLD", 2, 1),
(12, "TP", 1, 1),
(11, "TP", 2, 1),
(18, "Controle continu", 1, 1),
(15, "Controle continu", 2, 1),
(19, "Ratrappage", 2, 1),
(12, "Examen", 1, 1),
(16, "ETLD", 1, 2),
(10, "TP", 1, 2),
(14, "Ratrappage", 1, 2),
(12, "Examen", 1, 2)
';
									$requetes = explode (';', $bd);
									foreach ($requetes as $req)
									{
										mysql_query($req) or error ("impossible d'installer les données d'exemples, recommencer la configuration en désactivant l'installation des données d'exemple");
									}
								}
								mysql_close();
								$fichier = @fopen ('configuration.php', 'w') or error ("impossible de créer le fichier de configuraation");
								@fputs ($fichier, $configuration) or error ("impossible d'écrire dans le fichier de configuration");
								?>
					<div> L'installation s'est déroulée <span class="info">avec succès</span></div>
					<div> Vous pouvez vous connecter en tant qu'administrateur en utilisant l'identifiant <span class="text-important">admin</span> et le mot de passe <span class="text-important">azerty</span></div>
					<div> Pour accéder au site <a href="index.php">cliquez ici</a>.</div>
								<?php
							}
							catch (Exception $e)
							{
							?>
					<div> Une erreur est survénue lors de l'installation : <span class="info"><?php echo $e->getMessage() ?></span></div>
					<div> Pour revenir à la page de configuration <a href="installation.php">cliquez ici</a>.</div>
							<?php
							}
						}
						else
						{
							$message = (post('nomserveur') || post('nombd') || post('nomutilisateur') || post('theme')) ?
										'Veuillez remplir tous les champs' : '';
					?>
					<div class="info"><?php echo $message ?>&nbsp;</div>
					<form action="installation.php" method="post">
						<table class="tableau-element-ajouter" cellspacing="0">
							<tr class="ligne1">
								<td>
									<div>
										Nom du serveur de la base de donnée
									</div>
								</td>
								<td>
									<input name="nomserveur" type="text" value="localhost" />
								</td>
							</tr>
							<tr class="ligne2">
								<td>
									<div>
										Nom de la base de donnée
									</div>
										<span>La base de donnée sera automatiquement crée si elle n'existe pas </span>
								</td>
								<td>
									<input name="nombd" type="text" value="scolarite" />
								</td>
							</tr>
							<tr class="ligne1">
								<td>
									<div>
										Nom de l'utilisateur de la base de donnée
									</div>
								</td>
								<td>
									<input name="nomutilisateur" type="text" value="root" />
								</td>
							</tr>
							<tr class="ligne2">
								<td>
									<div>
										Mot de passe de la base de donnée
									</div>
								</td>
								<td>
									<input name="passutilisateur" type="text" value="" />
								</td>
							</tr>
							<tr class="ligne1">
								<td>
									<div>
										Le thème par défaut
									</div>
								</td>
								<td>
									<select name="theme" >
									<?php
									if ($dir = opendir ('vues/themes'))
									{
										while($theme = readdir($dir))
										{
											if (!is_file ($theme) && $theme != '.' && $theme != '..')
											{
												echo "<option ".
										(($theme == 'coquille-bleue') ? "selected=\"selected\"" : "").
										" value=\"$theme\">$theme</option>
										";
											}
										}
									}
									?>
									
									</select>
								</td>
							</tr>
							<tr class="ligne2">
								<td>
									<div>
										Installez les données par défaut
									</div>
								</td>
								<td>
									<input type="checkbox" name="donnee[]" value="true" checked="yes" />
								</td>
							</tr>
						</table>
						<input type="hidden" name="existe" value="true" />
						<div class="tableau-element-valider">
							<input type="submit" value="Installer" />
						</div>
					</form>
					<?php
						}
					}
					else
					{
					?>
					<p>L'application de gestion de la scolarité <span class="text-important">à déja été installée</span>, pour y accéder <a href="index.php">cliquez ici</a>.</p>
					<p>Si vous voulez reprendre l'installation veuillez <span class="text-important">supprimer le fichier "configuration.php"</span> et <a href="installation.php">réactualisez</a>.</p>
					<?php
					}
					?>
				</div>
			</div>
		</div>	
		
		<div id="credit">
			<a href="mailto:y.deo@hotmail.com">Développé par SOMDA Yandaar Déogracias Eric</a>
		</div>
	</body>
</html>
