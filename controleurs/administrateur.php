<?php
defined('PAS_D_ACCES_DIRECT') or die('<h1>Acc&egrave;s Restreint</h1>');

// Vérification de sécurité
// -- Début
$idValide = false;
$id = session ('id');
$admin = null;
if (!empty ($id))
{
	if ($admin = modeleInfosAdministrateur ($id))
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
$action 	= get ('action', 'accueil');
$vueAction		= $vue.'/accueil';
$liste		= array ();
if (in_array ($action, array (
								'accueil', 'deconnecter',
								'voiretudiants', 'supprimeretudiant', 'ajouteretudiant',
								'voirenseignants', 'supprimerenseignant', 'ajouterenseignant'
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

//
// Gestion des étudiants
//
function voiretudiants ()
{
	global $liste;
	$liste = modeleListeEtudiants ();
}

function supprimeretudiant ()
{
	global $message;
	$id = get ('id');
	
	$etudiant = modeleChercherEtudiants ($id);
	if ($etudiant)
	{
		if (modeleSupprimerEtudiants ($id))
		{
			session ('message', "L'étudiant $etudiant->nom $etudiant->prenom à été supprimé.", true);
		}
		else
		{
			session ('message', "Erreur lors de la supression de l'étudiant $etudiant->nom $etudiant->prenom.", true);
		}
	}
	else
	{
		session ('message', "L'étudiant numéro $id n'existe pas.", true);
	}
	redirrect ('action=voiretudiants');
}

function ajouteretudiant ()
{
	if (post ('existe', false))
	{
		if (post('nom') && post ('prenom') && post ('identifiant') && post ('pass') && post ('matricule') && post ('filiere'))
		{
			if (modeleIdentifiantUnique (post ('identifiant')))
			{
				if (modeleAjouterEtudiants (post('nom'), post ('prenom'), post ('identifiant'),
											md5 (post ('pass')), post ('matricule'), post ('filiere')))
				{
					session ('message', "L'étudiant ".post('nom')." ".post ('prenom')." à été ajouté à la liste", true);
				}
				else
				{
					session ('message', "Erreur lors de l'ajout de l'étudiant ".post('nom')." ".post ('prenom').
							", vérifier que le matricule n'est pas déja attribué", true);
				}
				redirrect ('action=voiretudiants');
			}
			else
			{
				session ('message', "L'identifiant que vous avez donné existe déjà.", true);
				redirrect ('action=ajouteretudiant');
			}
		}
		else
		{
			session ('message', "Vous devez remplir tous les champs.", true);
			redirrect ('action=ajouteretudiant');
		}
	}
}

//
// Gestion des enseignants
//
function voirenseignants ()
{
	global $liste;
	$liste = modeleListeEnseignants ();
}

function supprimerenseignant ()
{
	global $message;
	$id = get ('id');
	
	$enseignant = modeleChercherEnseignants ($id);
	if ($enseignant)
	{
		if (modeleSupprimerEnseignants ($id))
		{
			session ('message', "L'enseignant $enseignant->nom $enseignant->prenom à été supprimé.", true);
		}
		else
		{
			session ('message', "Erreur lors de la supression de l'enseignant $enseignant->nom $enseignant->prenom.", true);
		}
	}
	else
	{
		session ('message', "L'enseignant numéro $id n'existe pas.", true);
	}
	redirrect ('action=voirenseignants');
}

function ajouterenseignant ()
{
	if (post ('existe', false))
	{
		if (post('nom') && post ('prenom') && post ('matiere') && post ('identifiant') && post ('pass'))
		{
			if (modeleIdentifiantUnique (post ('identifiant')))
			{
				if (modeleAjouterEnseignants (post('nom'), post ('prenom'), post ('matiere'), post ('identifiant'), md5 (post ('pass'))))
				{
					session ('message', "L'enseignant ".post('nom')." ".post ('prenom')." à été ajouté à la liste", true);
				}
				else
				{
					session ('message', "Erreur lors de l'ajout de l'enseignant ".post('nom')." ".post ('prenom'), true);
				}
				redirrect ('action=voirenseignants');
			}
			else
			{
				session ('message', "L'identifiant que vous avez donné existe déjà.", true);
				redirrect ('action=ajouteretudiant');
			}
		}
		else
		{
			session ('message', "Vous devez remplir tous les champs", true);
			redirrect ('action=ajouterenseignant');
		}
	}
}
?>