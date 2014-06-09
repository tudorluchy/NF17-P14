<!-- Module Vétérinaire -->
 
<?php
Header::set_title("Vétérinaire");

include(CLASSES."Personne.class.php");
include(CLASSES."Animal.class.php");
include(CLASSES."Instruction.class.php");
include(CLASSES."Ordonnance.class.php");
include(CLASSES."Produit.class.php");
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
		
		case 'mes_rdv':
			mes_rdv();
			break;
		
		case 'validation_finale_ordonnance' :
			validation_finale_ordonnance();
			break;	
			
		case 'ajout_instruction' :
			ajout_instruction();
			break;
		case 'suppression_instruction' :
			suppression_instruction();
			break;
		case 'validation_instruction' :
			validation_instruction();
			break;
		default :
			liste_ordonnance();
}

function mes_rdv() {
	$telVet=$_SESSION['user']->telephone;
	$rdv_veto = RendezVous::GetListeRDV1veto($telVet);
	include("mes_rdv.php");
}

function validation_finale_ordonnance() {
	Site::message_info('Votre ordonnance a correctement été prescrite');
	Site::redirect("?module=Veterinaire");
}

function ordonnance() {
	$ord = Ordonnance::GetDerniereOrdonnance();
	$instr= Instruction::GetInstructions(Form::get('ref'));

	include("ordonnance.php");

}

function ajout_ordonnance(){
	$vet = Personne::GetTelephoneVeterinaire();
	$animal = Animal::GetNum_dossier();

	include("ajout_ordonnance.php");
}

function liste_ordonnance(){
	$ord = Ordonnance::GetListeOrdonnance();
	include("liste_ordonnance.php");
}

function validation_ordonnance(){
	$last_ref = Ordonnance::getMaxReference();
	$ord = new Ordonnance ($last_ref['max']+1, date('j/m/Y'), $_SESSION['user']->telephone, Form::get('num_dossier'));
	$error[] = Site::verif_Number('Numéro de dossier', Form::get('num_dossier'));
	
	if (!Site::affiche_erreur($error)) {
			$res = $ord->inserer();
			if (isset ($res)) {
				Site::message_info('Votre prescription a correctement été enregistrée');
				Site::redirect("?module=Veterinaire&action=ordonnance&ref=".$last_ref['max']);
			}
			else  {
				Site::message_info('Problème lors de la création de l\'ordonnance');
				ajout_ordonnance();
			}
	} else {
		ajout_ordonnance();
	}
}


function ajout_instruction() {
	$med = Produit::GetListeNomMedicaments();
	include("ajout_instruction.php");
}

function suppression_instruction() {
	Instruction::SupprimerParReference(Form::get('instruction'));
	Site::redirect("?module=Veterinaire&action=ordonnance&ref=". Form::get('ref'));
}


function validation_instruction() {
	$instr = new Instruction (Form::get('ref'), Form::get('nom_med'), Form::get('instruction'), Form::get('quantite_prescrite'));
	$error[] = Site::verif_Text('Nom du médicament', Form::get('nom_med'));

	if (!Site::affiche_erreur($error)) {
			$instr->inserer();
			Site::message_info('Votre instruction a correctement été ajoutée');
			Site::redirect("?module=Veterinaire&action=ordonnance&ref=". Form::get('ref'));

	} else {
		ajout_instruction();
	}
}






