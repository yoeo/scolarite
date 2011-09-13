<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');

// Vérification de sécurité
// -- Début
$idValide = false;
$id = session ('id');
$enseignant = null;
if (!empty ($id))
{
	if ($enseignant = modeleInfosEnseignant ($id))
	{
		$idValide = true;
	}
}
if (!$idValide)
{
	session ('type', 'enregistrement', true);
	session ('message', 'Veuillez vous enregistrer', true);
	redirrect ('action=accueil');
}
// -- Fin


// Traitement de la requêtte
$action 		= get ('action', 'accueil');
$vueAction		= $vue.'/accueil';
$liste			= array ();
$listeEtudiant	= array ();
if (in_array ($action, array (
								'accueil', 'deconnecter',
								'voirnotes', 'ajouternote', 'supprimernote'
								)))
{
	// appel de la fonction qui exécute la requette
	$action ();

	global $vue, $vueAction;
	$vueAction = $vue.'/'.$action;
}

function accueil ()
{
}

function deconnecter ()
{
	session_destroy();
	redirrect ('action=accueil');
}

function voirnotes ()
{
	global $liste, $id;
	$liste = modeleListeNotes ($id);
}

function supprimernote ()
{
	global $message, $id;
	$idn = get ('id');
	
	$note = modeleChercherNote ($idn, $id);
	if ($note)
	{
		if (modeleSupprimerNote ($idn, $id))
		{
			session ('message', "La note numéro $idn à été supprimé.", true);
		}
		else
		{
			session ('message', "Erreur, la note numéro $idn n'a pas été supprimée", true);
		}
	}
	else
	{
		session ('message', "La note numéro $idn n'existe pas ou vous n'avez pas l'authorisation de la supprimer.", true);
	}
	redirrect ('action=voirnotes');
}
function ajouternote ()
{
	global $id, $listeEtudiant;
	if (post ('existe', false))
	{
		if (post('valeur') && post ('type') && post ('id_etudiant'))
		{
			if ((post ('valeur') >=0) && (post ('valeur') <= 20))
			{
				if (modeleAjouterNote (post('valeur'), post ('type'), $id, post ('id_etudiant')))
				{
					session ('message', "La note à été ajouté à la liste.", true);
				}
				else
				{
					session ('message', "Erreur lors de l'ajout de la note.", true);
				}
				redirrect ('action=voirnotes');
			}
			else
			{
				session ('message', "La note est invalide, elle doit être entre 0 et 20.", true);
				redirrect ('action=ajouternote');
			}
		}
		else
		{
			session ('message', "Vous devez remplir tous les champs", true);
			redirrect ('action=ajouternote');
		}
	}
	else
	{
		$listeEtudiant = modeleListeEtudiants ();
	}
}
?>