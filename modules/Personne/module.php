<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Personne");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'valide':
		validation();
		break;
	case 'valide_admin':
		validation_admin();
		break;
	case 'modif':
		if (session::ouverte()) { modif(); } else { site::redirect("?"); }
		break;
	default:
		if (session::ouverte()) { moncompte(); } else { inscription(); }
		break;
}

function modif() {
	$pers = new Personne ($_SESSION['user']->telephone, $_SESSION['user']->nom, $_SESSION['user']->prenom);
	include('inscription.php');
}

function moncompte() {
	$Cli = Client::ChercherParLogin($_SESSION['user']->login);	
	include('moncompte.php');
}

function validation() {
	$pers = new Personne($_POST['telephone'], $_POST['nom'], $_POST['prenom']);
	
	$error[] = site::verif_Text('nom', $_POST['nom']);
	
	$error[] = site::verif_Text('prenom', $_POST['prenom']);
	
	$error[] = site::verif_Telephone('telephone', $_POST['telephone']);
	
	
	if (!site::affiche_erreur($error)) {
		        
		if (!isset($_SESSION['user'])) {
			$pers->Inserer();
			$_SESSION["messages"] = 'Votre compte a correctement été créé';
			}
		else {
			$pers->Modifier($_SESSION['user']->telephone);
			session::fermer();
			$_SESSION["messages"] = 'Votre compte a correctement été modifié';
			}
		session::ouvrir($pers);
		site::redirect("?module=personne&action=moncompte");			
	}
	else 
		include('inscription.php');
}

function validation_admin() {
	$pers = new Personne($_POST['telephone'], $_POST['nom'], $_POST['prenom']);
	
	// problème : telephone existe déjà
	if (Personne::Existe($_POST['telephone'])) {
		site::affiche_erreur('Impossible de créer le compte puisque ce telephone existe déjà.');
		site::redirect("?module=personne&action=administration");
	}
	
	$error[] = site::verif_Text('nom', $_POST['nom']);
	
	$error[] = site::verif_Text('prenom', $_POST['prenom']);
	
	$error[] = site::verif_Telephone('telephone', $_POST['telephone']);
	
	$error[] = site::verif_Text('type', $_POST['type']);
	
	if (!site::affiche_erreur($error)) {
		if ($_POST['type'] == 'veterinaire') {
			$pers->InsererVeterinaire();
			$_SESSION["messages"] = 'Le compte veterinaire a correctement été créé';
		} else if ($_POST['type'] == 'employee') {
			$pers->InsererEmployee();
			$_SESSION["messages"] = 'Le compte employée a correctement été créé';
		} else {
			site::affiche_erreur('Les deux seuls types de comptes possibles à créer sont Veterinaire et Employée.');
		}
		site::redirect("?module=personne&action=administration");
	} else {
		include('administration.php');
	}
}

function inscription(){
	include('inscription.php');
}

function administration(){
	include('administration.php');
}




