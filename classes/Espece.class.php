<?php

Class Espece {
	
	//Attributs
	public $nom;
	
	function __construct ($nom) {
		$this->nom = $nom;
	}
	
	public static function GetListeEspeces() {
		$sql = "SELECT * FROM tespece";
		$res=DB::SqlToArray($sql);
		return $res;
	}
	
	function Inserer(){
		$sql = "INSERT INTO tespece VALUES ('{$this->nom}')";
		$res=DB::Sql($sql);
	}
	
	public static function Existe($nom) {
		$sql = "select count(*) as nb from tespece where nom='$nom'";
		$res = DB::Sql($sql);
		if (!$res) {
			return false;
		}
		$res2 = pg_fetch_assoc($res);

		// si nom trouvé
		if ($res2['nb'] != 0) {
			return true;
		} else {
			return false;
		}
	}
}