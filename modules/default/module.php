<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Clinique vétérinaire");

include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	default:
		afficher();
		break;
}

function afficher(){
	include('default.php');
}

?>
