<!-- ICI JE NE MET QUE DU PHP!!! -->
<?php
Header::set_title("Facture");

include(CLASSES."Facture.class.php");
include(INCLUDES."Session.class.php");

switch ( Form::get('action') ){	
	case 'detail' : 
		detail();
		break;
	
}



function detail() {
	$facture = facture::detailfacture($_GET['reference']);
	include('detail.php');
}









