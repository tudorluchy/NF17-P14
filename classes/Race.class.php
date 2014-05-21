<?php

Class Race {
	
	//Attributs
	public $nom;
	public $espece;
	
	function __construct ($nom, $espece) {
		$this->nom = $nom;
		$this->espece = $espece;
	}
	
	public static function GetListeRaces() {
		$sql = "SELECT * FROM trace";
		$res=DB::SqlToArray($sql);
		return $res;
	}
	
	function Inserer(){
		$sql = "INSERT INTO trace VALUES ('{$this->nom}', '{$this->espece}')";
		$res=DB::Sql($sql);
	}
	
	public static function Existe($nom, $espece) {
		$sql = "select count(*) as nb from trace where nom='$nom' and espece='$espece'";
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