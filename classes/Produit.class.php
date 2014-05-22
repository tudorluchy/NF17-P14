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
	
	function Modifier() {	
		$sql = "UPDATE tproduit SET nom='{$this->nom}',stock='{$this->stock}',prix='{$this->prix}' WHERE nom='{$this->nom}'";
		$res=DB::Sql($sql);
	}
	
	public static function GetListeProduits() {
		$sql = "SELECT * FROM tproduit order by nom asc";
		$res=DB::SqlToArray($sql);
		
		return $res;
	}
	
	public static function GetListeMedicaments() {
		$sql = "SELECT * FROM vmedicament order by nom asc";
		$res=DB::SqlToArray($sql);
		
		return $res;
	}
	
	public static function GetProduitByName($nom) {
		$sql = "SELECT * FROM tproduit where nom='$nom'";
		$res=DB::SqlToArray($sql);
		
		return new Produit($res[0]['nom'], $res[0]['stock'], $res[0]['prix']);
	}
	
	public static function SupprimerMedicamentByName($nom) {
		$sql = "DELETE FROM tmedicament where nom='$nom'";
		$res=DB::Sql($sql);
	}
	
	public static function AjouterMedicamentByName($nom) {
		$sql = "INSERT INTO tmedicament VALUES ('$nom')";
		$res=DB::Sql($sql);
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