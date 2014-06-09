<!-- Module Facture -->

<?php
Header::set_title("Facture");


include(CLASSES."Facture.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'creer_facture' :
		creer_facture();
		break;
	case 'detail' : 
		detail();
		break;
	case 'validation_facture':
		validation_facture();
		break;
	case 'validation_reglement':
		validation_reglement();
		break;
	case 'validation_produit':
		validation_produit();
		break;
	case 'validation_prestation':
		validation_prestation();
		break;
	case 'ajout_produit':
		ajout_produit();
		break;
	case 'regler_facture':
		regler_facture();
		break;
	case 'ajout_prestation':
		ajout_prestation();
		break;
	default:
		consulter_facture();
		break;
}

function detail() {
	$facture = Facture::detailfacture($_GET['reference']);
	include('detail.php');
}

function regler_facture(){
	include ('regler_facture.php');
}

function ajout_prestation()
{
	$ref=$_GET['facture'];
	if ($ref=='')
	{
		Site::message_info("Erreur: Accès à une page sans autorisations.");
		$facture = Facture::getListeFacture();
		include ('consulter_facture.php');
	}
	else
	{
		$prestation = Prestation::getListePrestation();
		include('ajout_prestation.php');
	}
}

function ajout_produit()
{
	$ref=$_GET['facture'];
	if ($ref=='')
	{
		Site::message_info("Erreur: Accès à une page sans autorisations.");
		$facture = Facture::getListeFacture();
		include ('consulter_facture.php');
	}
	else
	{
		$produit = Produit::GetListeProduits();
		include('ajout_produit.php');
	}
}

function validation_prestation()
{
	$prest = new RemisePrestation(Form::get('remise'),Form::get('ref'),Form::get('nom_prest'));
	
	$error[] = Site::verif_Number('Remise', Form::get('remise'));
	
	$error[] = Site::verif_Text('Nom Prestation', Form::get('nom_prest'));
	
	if (!Site::affiche_erreur($error)) {
		$prest->Inserer();
		
		if(Prestation::isIntervention(Form::get('nom_prest'))){
			$facture = Facture::detailfacture(Form::get('ref'));
			$type = RemisePrestation::getEspeceRace($facture->num_dossier);
			$prix = RemisePrestation::getPrixIntervention(Form::get('nom_prest'),$type['espece'],$type['race']);
		}
		else{
			$facture = Facture::detailfacture(Form::get('ref'));
			$type = RemisePrestation::getEspeceRace($facture->num_dossier);
			$prix = RemisePrestation::getPrixConsultation(Form::get('nom_prest'),$type['espece']);
		}
	
		$prix = round($prix['prix']-($prix['prix']*Form::get('remise')/100),2);
		$ancien = Facture::GetMontant(Form::get('ref'));
		$prix+=$ancien['montant'];
		Facture::UpdateMontant($prix,Form::get('ref'));
		
		Site::message_info("La prestation concernant la facture #".$facture->reference." a correctement été ajoutée.");
		$facture = Facture::getListeFacture();
		include('consulter_facture.php');
	}
	else {
		$ref=Form::get('ref');
		$produit = Produit::GetListeProduits();
		include('ajout_prestation.php');
	}

}


function validation_produit()
{
	$achat = new Achat(Form::get('nom_produit'),Form::get('ref'),Form::get('remise'),Form::get('quantite'));
	

	$error[] = Site::verif_Number('Remise', Form::get('remise'));
	
	$error[] = Site::verif_Number('Quantité', Form::get('quantite'));

	$error[] = Site::verif_Text('Nom Produit', Form::get('nom_produit'));
	
	if (!Site::affiche_erreur($error)) {
		$achat->Inserer();
		
		$prix = Achat::MontantProduit(Form::get('nom_produit'));
		$prix = round(($prix['prix']-($prix['prix']*Form::get('remise')/100))*Form::get('quantite'),2);
		$ancien = Facture::GetMontant(Form::get('ref'));
		$prix+=$ancien['montant'];
		Facture::UpdateMontant($prix,Form::get('ref'));
		
		Site::message_info("L'Achat concernant la facture ".$achat->nom_produit." a correctement été ajoutée.");
		$facture = Facture::getListeFacture();
		include('consulter_facture.php');
	}
	else {
		$ref=Form::get('ref');
		$produit = Produit::GetListeProduits();
		include('ajout_produit.php');
	}

}

function creer_facture() {
	$emp = Personne::GetTelephoneEmploye();
	$pers = Personne::GetTelephonePersonnes();
	$animal = Animal::GetNum_dossier();
	include('creer_facture.php');
}

function consulter_facture() {
	$facture = Facture::getListeFacture();
	include('consulter_facture.php');
}

function validation_reglement() {
	$facture = new Facture(Form::get('ref'),"","",Form::get('mode_reglement'),Form::get('date_reglement'),"","","");
	
	if (Form::get('mode_reglement')=='none') $error[] = "Merci d'indiquer le mode de paiement.";
	
	$error[] = Site::verif_Date('Date de reglement', Form::get('date_reglement'));

	if (!Site::affiche_erreur($error)) {
		$facture->Regler();
		Site::message_info("La facture numéro ".$facture->reference." a correctement été réglée.");
		$facture = Facture::getListeFacture();
		include('consulter_facture.php');
	}
	else {
		include('regler_facture.php');
	}
}

function validation_facture() {
	
	$facture = new Facture(Form::get('reference'),Form::get('montant'),Form::get('etat'),Form::get('mode_reglement'),Form::get('date_reglement'),Form::get('date_edition'),Form::get('telephone_emp'),Form::get('num_dossier'),Form::get('telephone_pers'));
	
	$error[] = Site::verif_Date('Date d\'Edition', Form::get('date_edition'));
	
	$error[] = Site::verif_Telephone('Telephone Employé', Form::get('telephone_emp'));

	$error[] = Site::verif_Number('Numéro Dossier Animal', Form::get('num_dossier'));
	
	$error[] = Site::verif_Telephone('Telephone Client', Form::get('telephone_pers'));

	
	if (!Site::affiche_erreur($error)) {
		$facture->Inserer();
		Site::message_info("La facture concernant l'animal $facture->num_dossier a correctement été ajoutée.");
		$facture = Facture::getListeFacture();
		include('consulter_facture.php');
	}
	else {
	$emp = Personne::GetTelephoneEmploye();
	$pers = Personne::GetTelephonePersonnes();
	$animal = Animal::GetNum_dossier();
		include('creer_facture.php');
	}
}