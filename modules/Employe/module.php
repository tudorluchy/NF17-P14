<?php
Header::set_title("Employe");

include(CLASSES."Espece.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'ajout_animal':
		ajout_animal();
		break;
	case 'ajout_rdv':
		ajout_rdv();
		break;
	case 'validation_animal':
		validation_animal();
		break;
	case 'test' :
		test();
		break;
	default:
		Employe();
		break;
}

function ajout_animal() {
	//$espece = Espece::GetListeEspeces();
	$espece[] = 'chien';
	$espece[] = 'chat';
	$espece[] = 'hamster';
	include('ajout_animal.php');
}

function ajout_rdv() {
	//$pers = Personne::GetListePersonnes();
	//$vet = Personne::GetListeVeterinaires();
	include('ajout_rdv.php');
}


function validation_animal() {
	$animal = new Animal(Form::get('num_dossier'), Form::get('nom'), Form::get('poids'), Form::get('taille'), Form::get('genre'), Form::get('date_naiss'), Form::get('race'), Form::get('espece'), Form::get('telephone'));

	$error[] = Site::verif_Text('Numéro de dossier', Form::get('num_dossier'));
	
	$error[] = Site::verif_Text('Nom', Form::get('nom'));
	
	$error[] = Site::verif_Text('Poids', Form::get('poids'));
	
	$error[] = Site::verif_Text('Taille', Form::get('taille'));
	
	$error[] = Site::verif_Date('Date de naissance', Form::get('date_naiss'));
	
	$error[] = Site::verif_Text('Race', Form::get('race'));
	
	$error[] = Site::verif_Text('Espece', Form::get('espece'));
	
	$error[] = Site::verif_Telephone('telephone', Form::get('telephone'));
	
	
	if (!Site::affiche_erreur($error)) {
	
		$animal->Inserer();
		Site::message_info("$animal->nom à correctement été ajouté");
	}
	else {
		include('ajout_animal.php');
	}
}


function validation_rdv() {
	$rdv = new Rendez-vous(Form::get('date_rdv'), Form::get('duree'), Form::get('tel_vet'), Form::get('tel_prop'));

	$error[] = Site::verif_Date('Date du rendez-vous', Form::get('date_rdv'));
	
	$error[] = Site::verif_Number('Duree du rendez-vous', Form::get('duree'));
		
	$error[] = Site::verif_Telephone('Téléphone de l\'employé', Form::get('tel_prop'));
	
	$error[] = Site::verif_Telephone('Téléphone du vétérinaire', Form::get('tel_vet'));
	
	if (!Site::affiche_erreur($error)) {
		$rdv->Inserer();
		Site::message_info("Le rendez-vous à correctement été ajouté");
	}
	else {
		include('ajout_rdv.php');
	}

}


