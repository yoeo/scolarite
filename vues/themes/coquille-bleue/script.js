function generer ()
{
	for (i in document.identification)
	{
		document.write ("<div>");
		document.write ("<b>" + i + "</b> ");
		document.write ("<a href='#'>" + document.identification[i] + "</a>");
		document.write ("</div>");
	}
}

function enregistrementVerification ()
{
	if (document.identification.identifiant.value == '' ||
		document.identification.mot_de_passe.value == '')
	{
		alert ('Veuillez entrer l\'identifiant et le mot de passe');
	}
	else
	{
		document.identification.submit ();
	}
	return false;
}