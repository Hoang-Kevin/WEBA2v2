function valid(form)
{
	var erreur = (form.box.value == '');
	if (erreur)
		alert("Le formulaire est mal rempli !");
	return !erreur;
}
