<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Vétérinaire");

//include(CLASSES."Veterinaire.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){
		default :
			mes_rdv();
}

function mes_rdv() {
	include("mes_rdv.php");

}









