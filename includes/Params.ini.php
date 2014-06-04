<?php

// local
if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
	// données pour la connexion à la base de données local
    define("DB_HOST","tuxa.sme.utc");
	define("DB_USER","nf17p026");
	define("DB_PASS","5OzDifpQ");
	define("BASE","dbnf17p026");

    // affiche toutes les erreurs et warnings PHP en local
    error_reporting(E_ALL);
// distant
} else {
	// données pour la connexion à la base de données en prod
	define("DB_HOST","tuxa.sme.utc");
	define("DB_USER","nf17p026");
	define("DB_PASS","5OzDifpQ");
	define("BASE","dbnf17p026");

    // affiche aucune erreur ou warning PHP en production
    error_reporting(0);
}

define('DEBUG',0);

define('CLASSES',dirname($_SERVER["SCRIPT_FILENAME"])."/classes/");
define('INCLUDES',dirname($_SERVER["SCRIPT_FILENAME"])."/includes/");
define('SCRIPTS',dirname($_SERVER["SCRIPT_FILENAME"])."/scripts/");

$_SESSION['GLOBAL_CATEGORIE'] = array(	1 => "x",
										2 => "y",
										3 => "z"
								);

?>

