<?php

Class Achat {
	//Attributs
	public $nom_produit;
	public $reference_fac;
	public $remise;
	public $quantite;



	function __construct ($nom_produit,$reference_fac,$remise,$quantite){
		$this->nom_produit=$nom_produit;
		$this->reference_fac=$reference_fac;
		$this->remise=$remise;
		$this->quantite=$quantite;
	}
		
	function Inserer(){
		$sql = "INSERT INTO tachat VALUES ('$this->nom_produit','$this->reference_fac','$this->remise','$this->quantite')";
		return $res=DB::Sql($sql);
	}
	
	public static function GetAchat($ref) {
		$sql = "SELECT * FROM tachat WHERE reference_fac='$ref'";
		return DB::SqlToArray($sql);
	}
	
	public static function MontantProduit($nom_produit){
		$sql = "SELECT prix FROM tproduit WHERE nom='$nom_produit'";
		return pg_fetch_assoc(DB::Sql($sql));
	}
};

?>
