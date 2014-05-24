<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Vétérinaire");

include(CLASSES."Personne.class.php");
include(CLASSES."Animal.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){
		case 'ajout_ordonnance' :
				ajout_ordonnance();
				break;
		default :
			mes_rdv();
}

function mes_rdv() {
	include("mes_rdv.php");

}

function ajout_ordonnance(){
	//$vet = Personne::GetTelephoneVeterinaire();
	//$animal = Animal::GetNomDossier();
	include("ordonnance.php");
}











