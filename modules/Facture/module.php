<!-- Module Facture -->

<?php
Header::set_title("Facture");

include(CLASSES."Facture.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'ajout_facture' :
		ajout_facture();
		break;
	case 'consulter_facture' :
		consulter_facture();
		break;
	case 'detail' : 
		detail();
		break;
	
}

function ajout_facture() {
	include('ajout_facture.php');
}

function consulter_facture() {
	include('consulter_animal.php');
}

function detail() {
	$facture = facture::detailfacture($_GET['reference']);
	include('detail.php');
}

function validation_facture() {
	$facture = new Facture(Form::get('reference'),Form::get('montant'),Form::get('etat'),Form::get('mode_reglement'),Form::get('date_reglement'),Form::get('date_edition'),Form::get('telephone_emp'),Form::get('num_dossier'),Form::get('telephone_pers'),Form::get('race'),Form::get('espece'));
	
	$error[] = Site::verif_Number('Montant', Form::get('montant'));
	
	$error[] = Site::verif_Number('Etat', Form::get('etat'));
	
	$error[] = Site::verif_Text('Mode de Règlement', Form::get('mode_reglement'));
	
	$error[] = Site::verif_Date('Date de Règlement', Form::get('date_reglement'));
	
	$error[] = Site::verif_Date('Date d\'Edition', Form::get('date_edition'));
	
	$error[] = Site::verif_Telephone('Telephone Employé', Form::get('telephone_emp'));

	$error[] = Site::verif_Number('Numéro Dossier Animal', Form::get('num_dossier'));
	
	$error[] = Site::verif_Telephone('Telephone Client', Form::get('telephone_pers'));
	
	$error[] = Site::verif_Text('Race', Form::get('race'));
		
	$error[] = Site::verif_Text('Espèce', Form::get('espece'));
	
	if (!Site::affiche_erreur($error)) {
	
		$facture->Inserer();
		Site::message_info("La facture concernant l'animal $facture->num_dossier a correctement été ajoutée.");
	}
	else {
		include('ajout_facture.php');
	}
}









