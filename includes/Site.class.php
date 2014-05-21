<?php
 
define("TEXTE", '/^[a-zA-Z0-9]+([\-\_\!\?\/][a-zA-Z0-9])*/');
define("MAXTEXT", 50);
define("MINTEXT", 2);  

define("TEL", '#^0[1-68][0-9]{8}$#');
define("TAILLETEL", 10);


define("MAXTEXTAREA", 20000);
define("MINTEXTAREA", 2);  

define("DATES", "^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$");	

define("MAIL", '#^([a-zA-Z0-9]+(([\.\-\_]?[a-zA-Z0-9]+)+)?)\@(([a-zA-Z0-9]+[\.\-\_])+[a-zA-Z])#');
define("MAXMAIL", 30);
define("MINMAIL", 6); 

define("MINPWD", 6);
define("MAXPWD", 30);
define("PWD", "/^[a-zA-Z0-9]{6,25}$/"); 
 
define("ALERTE",1);
define("ERREUR",2);
define("OK",4);
define("INFO",8);

$_SESSION['PREV_URL']="";

if(isset($_SESSION['CUR_URL'])&&$_SESSION['PREV_URL']!=Form::get('module')) 
	$_SESSION['PREV_URL']=$_SESSION['CUR_URL'];

$_SESSION['CUR_URL']=Form::get('module');

	
class Site {
		/**
		* affiche la trace d'exécution courante
		*
		* $backtrace : retour d'un debug_backtrace lors de l'appel à debug
		* si NULL, inclus l'appel de debug dans la trace d'exécution
		*/
		static function trace($backtrace)
		{
			$chaine='';
			if($backtrace)
				$trace=array_reverse($backtrace);
			else
				$trace=array_reverse(debug_backtrace());
			$fonction=NULL;
			$decalage='';
			foreach($trace as $appel)
			{
				$chaine.= $decalage.$appel['file'].', ligne '.$appel['line'];
				if($fonction)
				{
					$chaine.=" : $fonction()\n";
					$decalage="  ".$decalage;
				}
				else
				{
					$decalage="  +--";
					$chaine.= "\n";
				}
				$fonction=$appel['function'];
			}
			return $chaine;
		}


		//envoie un header de redirection au navigateur
		//et quitte le script
		static function redirect($url)
		{
			header("Location: $url");
			exit();
		}
		
		static function page_precedente()
		{	
			self::redirect("?module=".$_SESSION['PREV_URL']);
		}		
		
		 		 
		/*
		* affiche les éventuels messages d'infos stockés
		* et les supprime
		*/
		static function liste_message()
		{
			
			if(empty($_SESSION["messages"]))
				return;

			foreach($_SESSION["messages"] as $message=>$type)
			{

				self::message($message,$type);
			}
			self::effacer_message_info();
		}
		 
		 
		/**
		* 
		*/
		static function messages()
		{
			if(isset($_SESSION["messages"]))
				return true;
			else
				return false;
		}
		
		static function message_info($message,$type=INFO)
		{
			$_SESSION["messages"][$message]=$type;
		}
		 
		/**
		* 
		*/
		static function effacer_message_info()
		{
			unset($_SESSION["messages"]);
		}
		 
		
		
		/**
		* affiche un message de debug, avec la trace d'exécution
		*
		* $message : chaine, tableau, etc...
		*/
		static function debug($message)
		{
			echo "<pre class='debug'>";
			echo "<b>";
			print_r($message);
			echo "</b>\n";
			echo self::trace(debug_backtrace()); 
			echo "</pre>";
		}
		 

		static function message($message, $type='INFO') {
			switch($type) {
				case INFO : { $div = "#message_info"; $img = 'information'; break;}
				case ERREUR : { $div = "#message_erreur"; $img = 'erreur'; break;}
				case ALERTE : { $div = "#message_warning"; $img = 'warning'; break;}
			}			
			
			echo(
					"<script type=\"text/javascript\">
						
					if($(\"$div\").html() != \"\")
						$(\"$div\").append(\"$message\").delay(4000).fadeOut();
					else
						$(\"$div\").show().append(\"<img src='template/$img.png'/><h3>$message</h3><div style='clear: both'></div>\").delay(8000).fadeOut();
					</script>"
			);
		}
		
		/*
		 static function fconnect () {
  
			  $vHost="tuxa.sme.utc";
			  $vDbname="dbnf17p026";
			  $vPort="5432";
			  $vUser="nf17p026";
			  $vPassword="5OzDifpQ";
			  $vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");	

			  return $vConn;
		}
		*/
		
		
	static function verif_Text($champs, $text) {
		$error = "";
		
		if($text == '') 
			if ($champs == '')
				$error = "Veuillez remplir ce champ svp";
			else	
				$error = "Veuillez remplir le champ '".$champs."' svp";
				
		else {
			if ((MAXTEXT < strlen($text)) || (MINTEXT > strlen($text)))
				if ($champs == '')
					$error = "La taille de ce champ doit être comprise entre ".MINTEXT." et ".MAXTEXT." caractères";
				else
					$error = "La taille de votre champ '".$champs."' doit être comprise entre ".MINTEXT." et ".MAXTEXT." caractères";

			else if(! preg_match(TEXTE, $text))
				if ($champs == '')
					$error = "Veuillez remplir correctement ce champ svp";
				else
					$error = "Veuillez remplir correctement le champ '".$champs."' svp";
		}
			return ($error);
	}
	
	static function verif_Telephone($champs, $tel) {
		$error = "";
		
		if($tel == '') 
			if ($champs == '')
				$error = "Veuillez remplir ce champ svp";
			else	
				$error = "Veuillez remplir le champ '".$champs."' svp";
				
		else {
			if (TAILLETEL != strlen($tel))
				if ($champs == '')
					$error = "La taille de ce champ doit être de ".TAILLETEL." caractères";
				else
					$error = "La taille de votre champ '".$champs."' doit être de ".TAILLETEL." caractères";

			else if(! preg_match(TEL, $tel))
				if ($champs == '')
					$error = "Veuillez remplir correctement ce champ svp";
				else
					$error = "Veuillez remplir correctement le champ '".$champs."' svp";
		}
			return ($error);
	}
	
	
	
	static function verif_mail($champs, $mail) {
		$error = "";
	
		if($mail == '')	
			if ($champs == '')
				$error = "Veuillez remplir ce champ svp";
			else
				$error = "Veuillez remplir le champ '".$champs."' svp";
		else {

			if(! preg_match(MAIL, $mail))
				if ($champs == '')
					$error = "Veuillez remplir correctement ce champ svp";
				else
					$error = "Veuillez remplir correctement le champ '".$champs."' svp";

			if ((MAXMAIL < strlen($mail)) || (MINMAIL > strlen($mail)))
				if ($champs == '')
					$error = "La taille de ce champ doit être comprise entre ".MINMAIL." et ".MAXMAIL." caractères";
				else
					$error = "La taille de votre champ '".$champs."' doit être comprise entre ".MINMAIL." et ".MAXMAIL." caractères";
		}
		return ($error);
	
	}
	
	static function verif_Date($champs, $date) {
		$error = "";
		
		if($date == '')	
			if ($champs == '')
				$error = "Veuillez remplir ce champ svp";
			else
				$error = "Veuillez remplir le champ '".$champs."' svp";
		else { 
			if(! preg_match(DATES, $date))
				if ($champs == '')
					$error = "Veuillez remplir correctement ce champ svp";
				else
					$error = "Veuillez remplir correctement le champ '".$champs."' svp";
		}
	
		return ($error);
	}
	
	
	static function affiche_erreur($tab){
		$error = false;
		
		foreach ($tab as $t) {
			if ($t != "") {
				site::message_info($t);
				$error = true;
			}		
		}
		return ($error);
	}
			
}
?>
