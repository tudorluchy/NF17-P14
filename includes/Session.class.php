<?php
session_set_cookie_params("0",dirname($_SERVER["SCRIPT_NAME"]));
session_start();
Session::restaurer();
 
class Session
{
	public static $user;
 
	static function ouverte()
	{
		return isset($_SESSION['user']);
	}
 
	static function ouvrir($user)
	{
		$_SESSION['user']=$user;
		self::restaurer();
	}
	
	static function fermer()
	{
		unset($_SESSION['user']);
	}
	
	static function restaurer()
	{
		if(self::ouverte())
		{
			self::$user=$_SESSION['user'];	
		}
 
	}
	
	static function info()
	{
		print (self::$user->login);
	}
}
?>
