<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Connexion");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");
include(INCLUDES."Site.class.php");

switch ( Form::get('action') ){	
	case 'veriflogin':
		veriflogin();
		break;
		
	case 'deco':
		deco();
		break;
			
	default:
		login();
		break;
}

function veriflogin() {
	
	$error[] = site::verif_Telephone('telephone', $_POST['telephone']);
	
	if (!site::affiche_erreur($error)) {
		$pers = Personne::Connection($_POST['telephone']);	
		
		session::ouvrir($pers);
		site::message_info('Vous êtes désormais connecté sous le nom de ' . $pers->nom);
	}
	else 
		login();
}

function deco() {
	if (session::ouverte())
	session::fermer();
	site::message_info('Vous avez correctement été déconnecté');
	site::redirect("?");
}

function login(){
	if (!session::ouverte())
		include('login.php');
	else {
		site::message_info('Vous êtes déjà connecté');
		site::redirect("?");
	}
}
