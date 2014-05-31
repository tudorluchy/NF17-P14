<!-- Module Par défaut -->

<?php
Header::set_title("Clinique vétérinaire");

include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'equipe':
		afficher_equipe();
		break;
	case 'plan_acces':
		plan_acces();
		break;
	case 'partenaires':
		partenaires();
		break;
	default:
		afficher();
		break;
}

function afficher(){
	include('default.php');
}

function afficher_equipe(){
	include('equipe.php');
}

function plan_acces(){
	include('plan.php');
}

function partenaires(){
	include('partenaires.php');
}




?>
