<?php

define("PRODUIT",1);
define("MEDICAMENT",2);

Class Produit {
	
	//Attributs
	public $nom;
	public $stock;
	public $prix;
	
	function __construct ($nom, $stock, $prix){
		$this->nom=$nom;
		$this->stock=$stock;
		$this->prix=$prix;
	}

	function Inserer($type=PRODUIT){
		$sql = "INSERT INTO tproduit VALUES ('{$this->nom}', '{$this->stock}', '{$this->prix}')";
		$res=DB::Sql($sql);
		
		if ($type == MEDICAMENT) {
			$sql = "INSERT INTO tmedicament VALUES ('{$this->nom}')";
			$res=DB::Sql($sql);
		}
	}
	
	public static function Existe($nom) {
		$sql = "select count(*) as nb from tproduit where nom='$nom'";
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
	
	public static function isMedicament($nom) {
		$sql = "select count(*) as nb from tmedicament where nom='$nom'";
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