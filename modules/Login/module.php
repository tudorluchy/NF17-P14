<?php

switch(Form::get('action')) {
	// connection Client
	case 'Login':  
		login_client();
		break;
	case 'Deconnect' : 
		Session::fermer(); 
		Site::message_info("Vous êtes déconnecté");
		Site::redirect("index.php");
		break;
	default:
		// si déjà connecté
		if (Session::ouverte()) {
			echo "<p><a href='?module=login&action=Deconnect'>Déconnexion</a></p>";
		} else {
print <<<ENDFORM
		<form action='?module=Login&action=Login' method='post' class='login'>
			<input type='text' name='Login' title='Login de connexion'>
			<input type='password' name='Pass' title='Mot de passe'>
			<input type='submit' value='Connexion'>
		</form>
ENDFORM;
		}
}

function login_client()
{
	if (Site::messages())
		Site::liste_message();
		
	$user = Client::Connection(Form::get('Login'),Form::get('Pass'));
	
	if (!$user) {
		Site::message_info("Mot de passe ou login invalide");
		Site::redirect("index.php");
	} else {
		Session::ouvrir($user);
		Site::message_info("Vous êtes connecté");
		Site::redirect("index.php");
	}
}
	
?>
