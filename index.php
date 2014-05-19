<!doctype html>
	
<?php
	header('Content-type:text/html; charset=utf-8');
	ini_set('display_errors',1);

	require("toolbox/header.php");
	require("toolbox/frontcontroller.php");

	require_once("includes/Params.ini.php");
	require_once("includes/Autoload.php");;

	Header::set_title("Titre site");
	Header::set_favicon("template/favicon.png");
	Controller::load_content();	
?>

<html>
	<head>
		<?php echo '<title>'.Header::get_title().'</title>'; ?>
		<?php 
			echo '<link rel="icon" type="image/png" href="'.Header::get_favicon().'"/>'; 
			header('X-Frame-Options: GOFORIT'); 
		?>
		<!-- Css -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/menu/default.css" />
		<link rel="stylesheet" type="text/css" href="css/menu/component.css" />
		<script src="js/menu/modernizr.custom.js"></script>
		<script src="js/jquery-2.1.1.min.js"></script>
		<script src="js/slider/jquery.bxslider.min.js"></script>
		<link href="css/slider/jquery.bxslider.css" rel="stylesheet" />
		<script type="text/javascript">
		$(document).ready(function(){
			  $('.bxslider').bxSlider();
			});
		</script>
	</head>
	<body>
		<div id='page'>
			<div id='header'>
				<h1>Clinique vétérinaire</h1>
				<img src="./template/header.jpg">
			</div>
				<ul id="cbp-tm-menu" class="cbp-tm-menu">
				<li>
					<a href="?">Accueil</a>
				</li>
				<li>
					<a href="#">Veggie made</a>
					<ul class="cbp-tm-submenu">
						<li><a href="#" class="cbp-tm-icon-archive">Sorrel desert</a></li>
						<li><a href="#" class="cbp-tm-icon-cog">Raisin kakadu</a></li>
						<li><a href="#" class="cbp-tm-icon-location">Plum salsify</a></li>
						<li><a href="#" class="cbp-tm-icon-users">Bok choy celtuce</a></li>
						<li><a href="#" class="cbp-tm-icon-earth">Onion endive</a></li>
						<li><a href="#" class="cbp-tm-icon-location">Bitterleaf</a></li>
						<li><a href="#" class="cbp-tm-icon-mobile">Sea lettuce</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Pepper tatsoi</a>
					<ul class="cbp-tm-submenu">
						<li><a href="#" class="cbp-tm-icon-archive">Brussels sprout</a></li>
						<li><a href="#" class="cbp-tm-icon-cog">Kakadu lemon</a></li>
						<li><a href="#" class="cbp-tm-icon-link">Juice green</a></li>
						<li><a href="#" class="cbp-tm-icon-users">Wine fruit</a></li>
						<li><a href="#" class="cbp-tm-icon-earth">Garlic mint</a></li>
						<li><a href="#" class="cbp-tm-icon-location">Zucchini garnish</a></li>
						<li><a href="#" class="cbp-tm-icon-mobile">Sea lettuce</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Sweet melon</a>
					<ul class="cbp-tm-submenu">
						<li><a href="#" class="cbp-tm-icon-screen">Sorrel desert</a></li>
						<li><a href="#" class="cbp-tm-icon-mail">Raisin kakadu</a></li>
						<li><a href="#" class="cbp-tm-icon-contract">Plum salsify</a></li>
						<li><a href="#" class="cbp-tm-icon-pencil">Bok choy celtuce</a></li>
						<li><a href="#" class="cbp-tm-icon-article">Onion endive</a></li>
						<li><a href="#" class="cbp-tm-icon-clock">Bitterleaf</a></li>
					</ul>
				</li>
			</ul>
			<div id="message_erreur"></div>
			<div id="message_warning"></div>
			<div id="message_info"></div>
			
			<ul class="bxslider">
			    <li><img src="template/slide1.jpg" /></li>
 			    <li><img src="template/slide2.jpg" /></li>
 			    <li><img src="template/slide3.jpg" /></li>
 			    <li><img src="template/slide4.jpg" /></li>
			</ul>
			<div id='corps'>
				<div id="colonne_gauche">
					
					<div id="bloc">
						<h3>Menu Utilisateur</h3>
						<hr>
						<ul>
							<?php
								if (!Session::isConnected()) {
									include_once ("./modules/Personne/connexion.php");?>
									<li><a href="?module=Personne">Créer un nouveau compte</a></li>
							<?php	}
								else { ?>
									<li><a href="?module=Personne&action=mon_compte">Mon Compte</a></li>
									<?php
									if (Session::isConnected() && Session::isAdmin()) {
									?>
										<li><a href="?module=Personne&action=administration_menu">Administration</a></li>
									<?php
									}
									?>
									<li><a href="?module=Personne&action=deconnection">Se déconnecter</a></li>
									
							<?php	}?>
						</ul>
					</div>
						<div id="bloc">
							<h3>Utilisateurs en ligne</h3>
							<hr>
							<p><?php
							if (empty($_SESSION['user']->telephone))
									echo('Il y a actuellement 0 utilisateur connecté.');
							else {
								echo('Les utilisateurs connectés sont : ');
								echo ('<ul>');
								echo ("<li>". $_SESSION['user']->nom ."</li>");
								echo ('</ul>');
							} ?>
							</p>
						</div>
						
						<div style='clear: both'></div>
					</div>
					<?php
						// Vous Ãªtes dÃ©connectÃ© / connectÃ©
						if (Site::messages())
							Site::liste_message();
					?>
					<div id='contenu'>
						<?php
							Controller::get_content();
						?>	
					</div>
					<?php
						// Vous Ãªtes dÃ©connectÃ© / connectÃ©
						if(Site::messages())
							Site::liste_message();
					?>
				</div>
			</div>
		<div id='footer'>
			Texte footer
		</div>
		<script src="js/menu/cbpTooltipMenu.min.js"></script>
		<script>
			var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );
		</script>
	</body>	
			
</html>
