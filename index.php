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

			$("#race").chained("#espece");
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
					<a href="?module=default&action=equipe">L'équipe</a>
				</li>
				<li>
					<a href="?module=default&action=plan_acces">Plan d'accès</a>
				</li>
				<li>
					<a href="?module=default&action=partenaires">Partenaires</a>
				</li>					
				<?php
				if (Session::isConnected() && (Session::isEmploye())) { 	?>
					<li>
						<a href="?module=Employe">Employe</a>
						<ul class="cbp-tm-submenu">
							<li><a href="?module=Employe&action=ajout_rdv" class="cbp-tm-icon-archive">Ajouter un rendez-vous</a></li>
							<li><a href="?module=Employe&action=ajout_animal" class="cbp-tm-icon-pencil">Ajouter un animal</a></li>
							<li><a href="?module=Personne&action=employe_inscription_espece">Création d'une nouvelle espece</a></li>
							<li><a href="?module=Personne&action=employe_inscription_race">Création d'une nouvelle race</a></li>
							<li><a href="?module=Personne&action=employe_liste_especes_races">Liste des espèces et races</a></li>
							<li><a href="?module=Personne&action=employe_inscription_prestation">Création d'une nouvelle prestation</a></li>
							<li><a href="?module=Personne&action=employe_inscription_prestation_intervention_prix">Création d'un prix intervention</a></li>
							<li><a href="?module=Personne&action=employe_inscription_prestation_consultation_prix">Création d'un prix consultation</a></li>
							<li><a href="?module=Personne&action=employe_liste_prestation">Liste des prestations avec leurs prix</a></li>
							<li><a href="?module=Personne&action=employe_inscription_produit">Création d'un nouveau produit</a></li>
							<li><a href="?module=Personne&action=employe_liste_produit">Liste des produits</a></li>
						</ul>
					</li>						
				<?php } ?>	

				<?php
					if (Session::isConnected() && (Session::isVeterinaire())) { ?>
						<li>
							<a href="?module=Veterinaire">Veterinaire</a>
							<ul class="cbp-tm-submenu">
								<li><a href="?module=Veterinaire" class="cbp-tm-icon-archive">Mes rendez-vous</a></li>
								<li><a href="?module=Veterinaire&action=ajout_ordonnance" class="cbp-tm-icon-pencil">Prescrire une ordonnance</a></li>
							</ul>
						</li>
				<?php } ?>			

				<?php if (Session::isConnected() && Session::isAdmin()) { ?>
				<li>
					<a href="?module=Personne&action=administration_menu">Administration</a>	
										

					<ul class="cbp-tm-submenu">
						<li><a href="?module=Personne&action=administration_inscription" class="cbp-tm-icon-pencil">Ajout d'un Compte</a></li>
						<li><a href="?module=Personne&action=administration_suppresion" class="cbp-tm-icon-screen">Suppression d'un Compte</a></li>	
					</ul>
				</li>
				<?php } ?>
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
									<li><a href="?module=Personne&action=deconnection">Se déconnecter</a></li>
							<?php	}?>
						</ul>
					</div>
						<div id="bloc">
							<h3>Coordonnées</h3>
							<hr>
							<ul>
								<li>Rue Roger Couttolenc</li>
								<li>60203 Compiègne Cedex</li>
								<li>+33 3 44 23 44 23</li>
								<li><a href="mailto:srp@utc.fr">Contact BF</a></p></li>
							</ul>
						</div>
					
						<div id="bloc">
							<h3>Utilisateurs en ligne</h3>
							<hr>
							<ul><?php
							if (empty($_SESSION['user']->telephone))
									echo('<li> Il y a actuellement 0 utilisateur connecté. </li>');
							else {
								echo('Les utilisateurs connectés sont : ');
								echo ("<li>". $_SESSION['user']->nom ."</li>");
							} ?>
							</ul>
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
			<p><b>NF17 - SUJET N°1 : CLINIQUE VETERINAIRE </b><br><br>Tudor Luchiancenco - Clémence Geffray - Thibault Brocheton - Benoît Sénéchal</p>
		</div>
		<script src="js/menu/cbpTooltipMenu.min.js"></script>
		<script>
			var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );
		</script>
	</body>	
			
</html>
