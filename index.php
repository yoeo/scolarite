<?php
define ('PAS_D_ACCES_DIRECT', true);

// Initialisation du système
header ('Content-type: text/html; charset=utf-8');
include ('fonction.php');
if (!file_exists ('configuration.php'))
{
	header ('Location: installation.php');
	exit ();
}
include ('configuration.php');

mysql_connect($scolariteBdServeur, $scolariteBdIdentifiant, $scolariteBdPass);
mysql_select_db($scolariteBdNom);
session_start();



// Initialisation des variables 
$type = session ('type', 'enregistrement');
if (!in_array ($type, $typeUtilisateur))
{
	$type = 'enregistrement';
}
$controleur	= $type;
$modele		= $type;
$vue		= $type;
$message	= session ('message', '', true);
$theme		= 'vues/themes/'.$scolariteTheme.'/';


include ('modeles/'.$modele.'.php');
include ('controleurs/'.$controleur.'.php');
include ('vues/'.$vue.'/defaut.php');



// Fermetures
mysql_close();
?>