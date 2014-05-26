<?php

Class Ordonnance {
	
	//Attributs
	public $reference;
	public $date_ord;
	public $telephone;
	public $num_dossier;

	function __construct ($reference, $date_ord, $telephone, $num_dossier){
		$this->reference = $reference;
		$this->date_ord = $date_ord;
		$this->telephone = $telephone;
		$this->num_dossier = $num_dossier;
	}
	

	function Inserer(){
		$sql = "INSERT INTO tordonnance VALUES ('{$this->reference}','{$this->date_ord}','{$this->telephone}','{$this->num_dossier}')";
		return $res=DB::Sql($sql);
	}
	
	public static function GetOrdonnance($reference) {
	
		$sql = "SELECT * FROM tordonnance WHERE reference='$reference'";
		$res=DB::Sql($sql);
		$vResult = pg_fetch_array($res);
		
		return new Ordonnance($vResult['reference'], $vResult['date_ord'], $vResult['telephone'], $vResult['num_dossier']);
	}
};

?>
