<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Personne");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");
include(INCLUDES."Site.class.php");

switch ( Form::get('action') ){	
	case 'verification_connexion':
		verification_connexion();
		break;
	case 'deconnection':
		deconnection();
		break;
	case 'validation_inscription':
		validation_inscription();
		break;
	case 'administration_menu':
		administration_menu();
		break;
	case 'administration_inscription':
		administration_inscription();
		break;
	case 'administration_suppresion':
		administration_suppresion();
		break;
	case 'validation_administration_inscription':
		validation_administration_inscription();
		break;
	case 'validation_administration_suppresion':
		validation_administration_suppresion();
		break;	
	case 'modification_compte':
		if (Session::ouverte()) {
			 modification_compte(); 
		} else { 
			Site::message_info('Veuillez vous connecter avant.');
			Site::redirect("?"); 
		}
		break;
	default:
		if (Session::ouverte()) { 
			mon_compte(); 
		} else { 
			inscription(); 
		}
		break;
}

function deconnection() {
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

// verification connexion
function verification_connexion() {

	$error[] = Site::verif_Telephone('telephone', Form::get('telephone'));
	
	if (!Site::affiche_erreur($error)) {
		$pers = Personne::Connection(Form::get('telephone'));	
		if (isset($pers->telephone)) {
			Session::ouvrir($pers);
			Site::message_info('Vous êtes désormais connecté sous le nom de ' . $pers->nom);
			Site::redirect("?");
		}
		else {
			Site::message_info('Les informations transmises n\'ont pas permis de vous authentifier.');
			connexion();
		}
	} else {
		connexion();
	}
}

function modification_compte() {
	$pers = new Personne ($_SESSION['user']->telephone, $_SESSION['user']->nom, $_SESSION['user']->prenom);
	include('inscription.php');
}

function inscription(){
	include('inscription.php');
}

function administration_menu(){
	include('administration_menu.php');
}

function administration_inscription(){
	include('administration_inscription.php');
}

function administration_suppresion(){
	include('administration_suppresion.php');
}

function mon_compte() {
	$animal = Animal::mesanimaux($_SESSION['user']->telephone);	
	$facture = Facture::mesfactures($_SESSION['user']->telephone);
	include('mon_compte.php');
}

function validation_inscription() {
	$error[] = Site::verif_Text('nom', Form::get('nom'));
	$error[] = Site::verif_Text('prenom', Form::get('prenom'));
	$error[] = Site::verif_Telephone('telephone', Form::get('telephone'));
	
	if (!Site::affiche_erreur($error)) {
		
		$pers = new Personne(Form::get('telephone'), Form::get('nom'), Form::get('prenom'));
		        
		if (!isset($_SESSION['user'])) {
			// problème : telephone existe déjà
			if (Personne::Existe(Form::get('telephone'))) {
				Site::message_info('Impossible de créer le compte puisque ce telephone existe déjà.');
				Site::redirect("?module=Personne");
			}
			$pers->Inserer();
			Site::message_info('Votre compte a correctement été créé');
		} else {
			$pers->Modifier($_SESSION['user']->telephone);
			Session::fermer();
			Site::message_info('Votre compte a correctement été modifié');
		}
		Session::ouvrir($pers);
		Site::redirect("?module=Personne&action=mon_compte");			
	} else { 
		if (Session::ouverte()) {
			modification_compte();
		} else {
			inscription();
		}
	}
}

function validation_administration_inscription() {
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
			Site::message_info('Les deux seuls types de comptes possibles à créer sont Veterinaire et Employée.');
		}
		Site::redirect("?module=Personne&action=administration_menu");
	} else {
		administration_inscription();
	}
}

function validation_administration_suppresion() {
	// telephone bien existant
	if (Personne::Existe(Form::get('telephone'))) {
		Personne::SupprimerParTelephone(Form::get('telephone'));
		Site::message_info('Le compte dont le téléphone est '.Form::get('telephone').' a correctement été supprimé');
	} else {
		Site::message_info('Impossible de supprimer un compte qui n\'existe pas');
	}
	Site::redirect("?module=Personne&action=administration_suppresion");
}

