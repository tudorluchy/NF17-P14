<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Personne");

include(CLASSES."Personne.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'valide':
		validation();
		break;
	case 'newCompte':
		newCompte();
		break;
	case 'modifCompte':
		modifCompte();
		break;
	default:
		inscription();
		break;
}

function newCompte() {
	include('vueNewModifCompte.php');
}	

function modifCompte() {

	$Cli = Client::ChercherParLogin($_SESSION['user']->login);	
	include('vueNewModifCompte.php');
}

function validation() {
	$pers = new Personne($_POST['telephone'], $_POST['nom'], $_POST['prenom']);
	
	$error[] = site::verif_Text('nom', $_POST['nom']);
	
	$error[] = site::verif_Text('prenom', $_POST['prenom']);
	
	$error[] = site::verif_Telephone('telephone', $_POST['telephone']);
	
	
	if (!site::affiche_erreur($error)) {
		//$pers.enregistrer();          // A FAIRE QUAND LA BASE FONCTIONNERA
		
	}
	else 
		include('inscription.php');
	

}

function inscription(){
	include('inscription.php');
}






