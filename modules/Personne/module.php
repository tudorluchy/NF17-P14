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
	case 'modification_compte':
		if (Session::ouverte()) {
			 modification_compte(); 
		} else { 
			Site::message_info('Veuillez vous connecter avant.');
			Site::redirect("?"); 
		}
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
	case 'employe_menu':
		employe_menu();
		break;
	case 'employe_inscription_espece':
		employe_inscription_espece();
		break;
	case 'employe_inscription_race':
		employe_inscription_race();
		break;
	case 'employe_inscription_prestation':
		employe_inscription_prestation();
		break;
	case 'employe_inscription_prestation_intervention_prix':
		employe_inscription_prestation_intervention_prix();
		break;
	case 'employe_inscription_prestation_consultation_prix':
		employe_inscription_prestation_consultation_prix();
		break;
	case 'employe_inscription_produit':
		employe_inscription_produit();
		break;
	case 'employe_liste_prestation':
		employe_liste_prestation();
		break;
	case 'modifier_prestation':
		modifier_prestation();
		break;
	case 'employe_liste_produit':
		employe_liste_produit();
		break;
	case 'modifier_produit':
		modifier_produit();
		break;
	case 'validation_employe_inscription_espece':
		validation_employe_inscription_espece();
		break;
	case 'validation_employe_inscription_race':
		validation_employe_inscription_race();
		break;
	case 'validation_employe_inscription_prestation':
		validation_employe_inscription_prestation();
		break;
	case 'validation_employe_inscription_produit':
		validation_employe_inscription_produit();
		break;
	case 'validation_employe_inscription_prestation_intervention_prix':
		validation_employe_inscription_prestation_intervention_prix();
		break;
	case 'validation_employe_inscription_prestation_consultation_prix':
		validation_employe_inscription_prestation_consultation_prix();
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

function employe_menu(){
	include('employe_menu.php');
}

function employe_inscription_espece(){
	include('employe_inscription_espece.php');
}

function employe_inscription_race(){
	$liste_especes = Espece::GetListeEspeces();
	include('employe_inscription_race.php');
}

function employe_inscription_prestation(){
	include('employe_inscription_prestation.php');
}

function employe_inscription_prestation_intervention_prix() {
	$liste_especes = Espece::GetListeEspeces();
	$liste_interventions = Prestation::GetListeInterventions();
	include('employe_inscription_prestation_intervention_prix.php');

}

function employe_inscription_prestation_consultation_prix() {
	$liste_especes = Espece::GetListeEspeces();
	$liste_consultations = Prestation::GetListeConsultations();
	include('employe_inscription_prestation_consultation_prix.php');
}

function employe_inscription_produit(){
	include('employe_inscription_produit.php');
}

function employe_liste_prestation() {
	$liste_interventions = Prestation::GetListeInterventionsAvecPrix();
	$liste_consultations = Prestation::GetListeConsultationsAvecPrix();
	include('employe_liste_prestation.php');
}

function employe_liste_produit() {
	$liste_produits = Produit::GetListeProduits();
	$liste_medicaments = Produit::GetListeMedicaments();
	include('employe_liste_produit.php');
}

function modifier_produit() {
	$nom_produit = Form::get('nom');
	$produit = Produit::GetProduitByName($nom_produit);
	include('employe_inscription_produit.php');
}

function modifier_prestation() {
	$nom_prestation = Form::get('nom');
	if (Prestation::isIntervention($nom_prestation)) {
		$prestation = Prestation::GetInterventionAvecPrix($nom_prestation);
		$prestation = $prestation[0];
		$liste_especes = Espece::GetListeEspeces();
		include('employe_modification_prestation_intervention.php');	
	} else if ((Prestation::isConsultation($nom_prestation))) {
		$prestation = Prestation::GetConsultationAvecPrix($nom_prestation);
		$prestation = $prestation[0];
		$liste_especes = Espece::GetListeEspeces();
		include('employe_modification_prestation_consultation.php');
	}
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
		Site::message_info('Impossible de créer le compte puisque ce telephone existe déjà.');
		Site::redirect("?module=Personne&action=administration_menu");
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
			Site::message_info('Les deux seuls types de comptes possibles à créer sont Veterinaire et Employé.');
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

function validation_employe_inscription_espece() {
	// problème : espece existe déjà
	if (Espece::Existe(Form::get('nom'))) {
		Site::message_info('Impossible de créer l\'espèce puisque celle-ci existe déjà.');
		Site::redirect("?module=Personne&action=employe_menu");
	}
	
	$error[] = Site::verif_Text('espece', Form::get('nom'));
	
	if (!Site::affiche_erreur($error)) {
		$espece = new Espece(Form::get('nom'));
		
		$espece->Inserer();
		Site::message_info('Votre espèce a correctement été créé');
	} else {
		employe_inscription_espece();
	}
}

function validation_employe_inscription_race() {
	// problème : race existe déjà
	if (Race::Existe(Form::get('nom'), Form::get('espece'))) {
		Site::message_info('Impossible de créer la race puisque celle-ci existe déjà.');
		Site::redirect("?module=Personne&action=employe_menu");
	}
	
	$error[] = Site::verif_Text('espece', Form::get('espece'));
	$error[] = Site::verif_Text('nom', Form::get('nom'));
	
	if (!Site::affiche_erreur($error)) {
		$race = new Race(Form::get('nom'), Form::get('espece'));
		
		$race->Inserer();
		Site::message_info('Votre race a correctement été créé');
	} else {
		employe_inscription_race();
	}
}

function validation_employe_inscription_prestation() {
	// problème : prestation existe déjà
	if (Prestation::Existe(Form::get('nom'))) {
		Site::message_info('Impossible de créer la prestation puisque celle-ci existe déjà.');
		Site::redirect("?module=Personne&action=employe_menu");
	}
	
	$error[] = Site::verif_Text('nom', Form::get('nom'));
	$error[] = Site::verif_Text('type', Form::get('type'));
	
	if (!Site::affiche_erreur($error)) {
		$prestation = new Prestation(Form::get('nom'));
		
		if (Form::get('type') == 'intervention') {
			$prestation->Inserer(constant('INTERVENTION'));
			Site::message_info('La prestation de type intervention a correctement été créé');
		} else if (Form::get('type') == 'consultation') {
			$prestation->Inserer(constant('CONSULTATION'));
			Site::message_info('La prestation de type consultation a correctement été créé');
		} else {
			Site::message_info('Les deux seuls types de prestations possibles à créer sont Intervention et Consultation.');
		}
		Site::redirect("?module=Personne&action=employe_menu");
	} else {
		employe_inscription_prestation();
	}
}

function validation_employe_inscription_prestation_intervention_prix() {

}

function validation_employe_inscription_prestation_consultation_prix() {

	$error[] = Site::verif_Text('consultation', Form::get('consultation'));
	$error[] = Site::verif_Text('espece', Form::get('espece'));
	$error[] = Site::verif_Real('prix', Form::get('prix'));

	if (!Site::affiche_erreur($error)) {
		$prix_consultation = new PrixConsultation(Form::get('espece'), Form::get('consultation'), Form::get('prix'));

		// inscription
		if (!PrixConsultation::Existe(Form::get('espece'), Form::get('consultation'))) {
			$prix_consultation->Inserer();
			Site::message_info('Le prix a correctement été créé');
		// modification
		} else if (PrixConsultation::Existe(Form::get('espece'), Form::get('consultation'))) {
			$prix_consultation->Modifier();
			Site::message_info('Le prix a correctement été modifié.');
		}
		Site::redirect("?module=Personne&action=employe_liste_prestation");
	} else {
		employe_inscription_prestation_consultation_prix();
	}
}

function validation_employe_inscription_produit() {
	
	$error[] = Site::verif_Text('nom', Form::get('nom'));
	$error[] = Site::verif_Number('stock', Form::get('stock'));
	$error[] = Site::verif_Real('prix', Form::get('prix'));
	$error[] = Site::verif_Text('type', Form::get('type'));
	
	if (!Site::affiche_erreur($error)) {
		$produit = new Produit(Form::get('nom'), Form::get('stock'), Form::get('prix'));
		
		// inscription
		if (!Produit::Existe(Form::get('nom'))) {
			if (Form::get('type') == 'produit') {
				$produit->Inserer();
				Site::message_info('Le produit simple a correctement été créé');
			} else if (Form::get('type') == 'medicament') {
				$produit->Inserer(constant('MEDICAMENT'));
				Site::message_info('Le médicament a correctement été créé');
			} else {
				Site::message_info('Les deux seuls types de produits possibles à créer sont Produit simple et Médicament.');
			}
		// modification
		} else if (Produit::Existe(Form::get('nom'))) { 
			$produit->Modifier();
			if (Form::get('type') == 'produit') {
				Produit::SupprimerMedicamentByName(Form::get('nom'));
			} else if (Form::get('type') == 'medicament') {
				Produit::AjouterMedicamentByName(Form::get('nom'));
			}
			Site::message_info('Le produit a correctement été modifié.');
		}
		Site::redirect("?module=Personne&action=employe_liste_produit");
	} else {
//		Site::redirect("?module=Personne&action=employe_liste_produit");
		employe_inscription_produit();
	}
}
