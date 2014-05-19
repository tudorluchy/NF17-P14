<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Veterinaire");

include(CLASSES."Veterinaire.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'ajout_animal':
		ajout_animal();
		break;
	case 'validation_animal':
		validation_animal();
		break;
	default:
		veterinaire();
		break;
}

function ajout_animal() {
	include('ajout_animal.php');
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


