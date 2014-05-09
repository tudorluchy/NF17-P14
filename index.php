<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">	
<?php
	header('Content-type:text/html; charset=utf-8');
	ini_set('display_errors',1);

	require("toolbox/header.php");
	require("toolbox/frontcontroller.php");

	require_once("includes/Params.ini.php");
	require_once("includes/Autoload.php");

	Header::set_title("Titre site");
	Header::set_favicon("template/default.png");
	Controller::load_content();	
?>

<meta http-equiv="X-UA-Compatible" content="IE=7">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo '<title>'.Header::get_title().'</title>'; ?>
		<?php 
			echo '<link rel="icon" type="image/png" href="'.Header::get_favicon().'"/>'; 
			header('X-Frame-Options: GOFORIT'); 
		?>
		<!-- Css -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<div id='header'>
			<?php 
				// le client non-admin ne voit pas le menu admistrateur
				if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']->type != 'client')) {
			?>
			<a href="?module=administration">Accès Administration</a><br />
			<?php
				}
			?>
		</div>
		<div id='menu'>
			<div id='login'>
				<!-- Espace connection -->
				<?php require_once('modules/Login/module.php');?>		
			</div>
			
			<?php 
				/* Afficher le menu en fonction du type personne */
				
				// si c'est le client
				if (isset($_SESSION['user']) && $_SESSION['user']->type == 'client') {
			?>
			<div id='liens'>
				<a href="?module=UnModule">UnModule</a>
				<a href="?module=Client&action=modifCompte">Modification compte</a>
			</div>
			<?php
				// cas d'un visiteur
				} else { 
            ?>
			<div id='liens'>
				<a href="?module=Client&action=newCompte">Inscription</a>
			</div>
            <?php
				}
			?>
		</div>
		
		<?php
			// Vous êtes déconnecté / connecté
			if (Site::messages())
				Site::liste_message();
		?>
		<div id='contenu'>
			<?php
				Controller::get_content();
			?>	
		</div>
		<?php
			// Vous êtes déconnecté / connecté
			if(Site::messages())
				Site::liste_message();
		?>
	</body>				
</html>
