<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Personne");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");
include(INCLUDES."Site.class.php");

switch ( Form::get('action') ){	
	case 'verif_connexion':
		verif_connexion();
		break;
	case 'deco':
		deco();
		break;
/*	case 'connexion':
		connexion();
		break;
*/
	case 'valide':
		validation();
		break;
	case 'administration':
		administration();
		break;
	case 'valide_admin':
		validation_admin();
		break;
	case 'modif':
		if (Session::ouverte()) {
			 modif(); 
		} else { 
			Site::message_info('Veuillez vous connecter avant.');
			Site::redirect("?"); 
		}
		break;
	default:
		if (Session::ouverte()) { 
			moncompte(); 
		} else { 
			inscription(); 
		}
		break;
}

// verification connexion
function verif_connexion() {
	
	$error[] = Site::verif_Telephone('telephone', Form::get('telephone'));
	
	if (!Site::affiche_erreur($error)) {
		$pers = Personne::Connection(Form::get('telephone'));	
		
		Session::ouvrir($pers);
		Site::message_info('Vous êtes désormais connecté sous le nom de ' . $pers->nom);
		Site::redirect("?");
	} else {
		connexion();
	}
}

function deco() {
	if (Session::ouverte()) {
		Session::fermer();
	}
	Site::message_info('Vous avez correctement été déconnecté');
	Site::redirect("?");
}

function connexion() {
	if (!Session::ouverte()) {
		include('connexion.php');
	} else {
		Site::message_info('Vous êtes déjà connecté');
		Site::redirect("?");
	}
}

function modif() {
	$pers = new Personne ($_SESSION['user']->telephone, $_SESSION['user']->nom, $_SESSION['user']->prenom);
	include('inscription.php');
}

function inscription(){
	include('inscription.php');
}

function administration(){
	include('administration.php');
}

function moncompte() {
	$animal = Animal::mesanimaux($_SESSION['user']->telephone);	
	$facture = Facture::mesfactures($_SESSION['user']->telephone);
	include('moncompte.php');
}

function validation() {
	$error[] = Site::verif_Text('nom', Form::get('nom'));
	$error[] = Site::verif_Text('prenom', Form::get('prenom'));
	$error[] = Site::verif_Telephone('telephone', Form::get('telephone'));
	
	if (!Site::affiche_erreur($error)) {
		
		$pers = new Personne(Form::get('telephone'), Form::get('nom'), Form::get('prenom'));
		        
		if (!isset($_SESSION['user'])) {
			// problème : telephone existe déjà
			if (Personne::Existe(Form::get('telephone'))) {
				Site::affiche_erreur('Impossible de créer le compte puisque ce telephone existe déjà.');
				Site::redirect("?module=personne");
			}
			$pers->Inserer();
			Site::message_info('Votre compte a correctement été créé');
		} else {
			$pers->Modifier($_SESSION['user']->telephone);
			Session::fermer();
			Site::message_info('Votre compte a correctement été modifié');
		}
		Session::ouvrir($pers);
		Site::redirect("?module=personne&action=moncompte");			
	} else { 
		if (Session::ouverte()) {
			modif();
		} else {
			inscription();
		}
	}
}

function validation_admin() {
	// problème : telephone existe déjà
	if (Personne::Existe(Form::get('telephone'))) {
		Site::affiche_erreur('Impossible de créer le compte puisque ce telephone existe déjà.');
		Site::redirect("?module=Personne&action=administration");
	}
	
	$error[] = Site::verif_Text('nom', Form::get('nom'));
	$error[] = Site::verif_Text('prenom', Form::get('prenom'));
	$error[] = Site::verif_Telephone('telephone', Form::get('telephone'));
	$error[] = Site::verif_Text('type', Form::get('type'));
	
	if (!Site::affiche_erreur($error)) {
		$pers = new Personne(Form::get('telephone'), Form::get('nom'), Form::get('prenom'));
		
		if (Form::get('type') == 'veterinaire') {
			$pers->Inserer(constant('VETERINAIRE'));
			Site::message_info('Le compte veterinaire a correctement été créé');
		} else if (Form::get('type') == 'employe') {
			$pers->Inserer(constant('EMPLOYE'));
			Site::message_info('Le compte employée a correctement été créé');
		} else {
			Site::affiche_erreur('Les deux seuls types de comptes possibles à créer sont Veterinaire et Employée.');
		}
		Site::redirect("?module=Personne&action=administration");
	} else {
		administration();
	}
}

