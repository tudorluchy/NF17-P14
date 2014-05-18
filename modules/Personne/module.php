<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Personne");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");
include(INCLUDES."Site.class.php");

switch ( Form::get('action') ){	
	case 'verifConnexion':
		verifConnexion();
		break;
	case 'deco':
		deco();
		break;
/*	case 'login':
		login();
		break;
*/
	case 'valide':
		validation();
		break;
	case 'valide_admin':
		validation_admin();
		break;
	case 'modif':
		if (Session::ouverte()) { modif(); } 
		else { 
			Site::message_info('Veuillez vous connecter avant.');
			Site::redirect("?"); 
			}
		break;
	default:
		if (Session::ouverte()) { moncompte(); } else { inscription(); }
		break;
}

// verification connexion
function verifConnexion() {
	
	$error[] = Site::verif_Telephone('telephone', $_POST['telephone']);
	
	if (!Site::affiche_erreur($error)) {
		$pers = Personne::Connection($_POST['telephone']);	
		
		Session::ouvrir($pers);
		Site::message_info('Vous êtes désormais connecté sous le nom de ' . $pers->nom);
		Site::redirect("?");
	} else {
		login();
	}
}

function deco() {
	if (Session::ouverte())
	Session::fermer();
	Site::message_info('Vous avez correctement été déconnecté');
	Site::redirect("?");
}

function login(){
	if (!Session::ouverte())
		include('login.php');
	else {
		Site::message_info('Vous êtes déjà connecté');
		Site::redirect("?");
	}
}

function modif() {
	$pers = new Personne ($_SESSION['user']->telephone, $_SESSION['user']->nom, $_SESSION['user']->prenom);
	echo "coucou";
	include('inscription.php');
}

function moncompte() {
	$animal = Animal::mesanimaux($_SESSION['user']->telephone);	
	$facture = Facture::mesfactures($_SESSION['user']->telephone);
	include('moncompte.php');
}

function validation() {
	$pers = new Personne($_POST['telephone'], $_POST['nom'], $_POST['prenom']);
	
	// problème : telephone existe déjà
	if (Personne::Existe($_POST['telephone'])) {
		Site::affiche_erreur('Impossible de créer le compte puisque ce telephone existe déjà.');
		Site::redirect("?module=personne");
	}
	
	$error[] = Site::verif_Text('nom', $_POST['nom']);
	
	$error[] = Site::verif_Text('prenom', $_POST['prenom']);
	
	$error[] = Site::verif_Telephone('telephone', $_POST['telephone']);
	
	
	if (!Site::affiche_erreur($error)) {
		        
		if (!isset($_SESSION['user'])) {
			$pers->Inserer();
			Site::message_info('Votre compte a correctement été créé');
			}
		else {
			$pers->Modifier($_SESSION['user']->telephone);
			Session::fermer();
			Site::message_info('Votre compte a correctement été modifié');
			}
		Session::ouvrir($pers);
		Site::redirect("?module=personne&action=moncompte");			
	}
	else 
		include('inscription.php');
}

function validation_admin() {
	$pers = new Personne($_POST['telephone'], $_POST['nom'], $_POST['prenom']);
	
	// problème : telephone existe déjà
	if (Personne::Existe($_POST['telephone'])) {
		Site::affiche_erreur('Impossible de créer le compte puisque ce telephone existe déjà.');
		Site::redirect("?module=Personne&action=administration");
	}
	
	$error[] = Site::verif_Text('nom', $_POST['nom']);
	
	$error[] = Site::verif_Text('prenom', $_POST['prenom']);
	
	$error[] = Site::verif_Telephone('telephone', $_POST['telephone']);
	
	$error[] = Site::verif_Text('type', $_POST['type']);
	
	if (!Site::affiche_erreur($error)) {
		if ($_POST['type'] == 'veterinaire') {
			$pers->Inserer(constant('VETERINAIRE'));
			Site::message_info('Le compte veterinaire a correctement été créé');
		} else if ($_POST['type'] == 'employee') {
			$pers->Inserer(constant('EMPLOYE'));
			Site::message_info('Le compte employée a correctement été créé');
		} else {
			Site::affiche_erreur('Les deux seuls types de comptes possibles à créer sont Veterinaire et Employée.');
		}
		Site::redirect("?module=Personne&action=administration");
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
