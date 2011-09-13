<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');

function retourneValeur ($tab, $indice, $defaut, $affecter)
{
	$retour = $defaut;
	if (!empty ($tab [$indice]))
	{
		$retour = $tab [$indice];
	}
	
	if ($affecter)
	{
		$tab [$indice] = $defaut;
	}
	// Vérification de sécurité
	//
	// Désactivation des attaques par injections SQL
	// et des attaques XSS
	$retour = strip_tags ($retour);
	$retour = addslashes ($retour);
	return $retour;
}

function get ($indice, $defaut = null, $affecter = false)
{
	return retourneValeur (&$_GET, $indice, $defaut, $affecter);
}

function post ($indice, $defaut = null, $affecter = false)
{
	return retourneValeur (&$_POST, $indice, $defaut, $affecter);
}

function session ($indice, $defaut = null, $affecter = false)
{
	return retourneValeur (&$_SESSION, $indice, $defaut, $affecter);
}

function redirrect ($url)
{
	header ('Location: index.php?'.$url);
	exit ();
}

function error ($message)
{
	throw new Exception ($message);
}
?>
