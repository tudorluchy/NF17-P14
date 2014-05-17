<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Personne");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'valide':
		validation();
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

function inscription(){
	include('inscription.php');
}






