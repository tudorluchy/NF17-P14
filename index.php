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
		<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
		<script src="js/slider/jquery.bxslider.min.js"></script>
		<script src="js/tuupola-jquery_chained-edd3742/jquery.chained.min.js"></script>
		<link href="css/slider/jquery.bxslider.css" rel="stylesheet" />
		<link href="css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
		<script type="text/javascript">
		$(document).ready(function(){
			  $('.bxslider').bxSlider();
			});
			
			 $( "#date_naiss" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
				  dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
				  dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
				  gotoCurrent: true,
				  monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
				  monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Juin", "Juil", "Aoû", "Sep", "Oct", "Nov", "Dec" ],
				  prevText: "Préc",
				  nextText: "Suiv",
				  yearRange: "1990:2014"
				});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#race").chained("#espece"); /* or $("#series").chainedTo("#mark"); */
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
					<a href="?module=Employe">Employe</a>
					<ul class="cbp-tm-submenu">
						<li><a href="?module=Employe&action=ajout_rdv" class="cbp-tm-icon-archive">Ajouter un rendez-vous</a></li>
						<li><a href="?module=Employe&action=ajout_animal" class="cbp-tm-icon-pencil">Ajouter un animal</a></li>
					</ul>
				</li>
				<li>
					<a href="?module=Veterinaire">Veterinaire</a>
					<ul class="cbp-tm-submenu">
						<li><a href="?module=Veterinaire" class="cbp-tm-icon-archive">Mes rendez-vous</a></li>
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
										<li><a href="?module=Personne&action=administration_menu">Menu administration</a></li>
									<?php
									}
									?>
									<?php
									if (Session::isConnected() && Session::isEmploye()) {
									?>
										<li><a href="?module=Personne&action=employe_menu">Menu employé</a></li>
									<?php
									}
									?>
									<?php
									if (Session::isConnected() && Session::isVeterinaire()) {
									?>
										<li><a href="?module=Personne&action=veterinaire_menu">Menu vétérinaire</a></li>
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
