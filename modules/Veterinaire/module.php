<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Vétérinaire");

include(CLASSES."Personne.class.php");
include(CLASSES."Animal.class.php");
//include(CLASSES."Ordonnance.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){
		case 'ajout_ordonnance' :
			ajout_ordonnance();
				break;
		case 'validation_ordonnance' :
			validation_ordonnance();
			break;
		case 'ordonnance' :
			ordonnance();
			break;
		default :
			mes_rdv();
}

function mes_rdv() {
	include("mes_rdv.php");
}

function ordonnance() {
	

	include("ordonnance.php");

}

function ajout_ordonnance(){
	//$vet = Personne::GetTelephoneVeterinaire();
	//$animal = Animal::GetNomDossier();
	include("ajout_ordonnance.php");
}


function validation_ordonnance(){
	//$ord = new Ordonnance (Form::get('num_dossier'), Form::get('date_ord'), Form::get('tel_vet'));
	//$error[] = Site::verif_Text('Numéro de dossier', Form::get('num_dossier'));
	//$error[] = Site::verif_Date('Date de l\'ordonnance', Form::get('date_ord'));
	//$error[] = Site::verif_Telephone('Téléphone du vétérinaire', Form::get('tel_vet'));
	
	if (!Site::affiche_erreur($error)) {
			//$ord->inserer();
			Site::message_info('Votre prescription a correctement été enregistrée');
			Site::redirect("?module=Veterinaire&action=ordonnance");

	} else {
		ajout_ordonnance();
	}
}












