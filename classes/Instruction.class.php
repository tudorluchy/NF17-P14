<?php
Class Instruction {
	
	//Attributs
	public $reference_ord;
	public $nom_med;
	public $instruction;
	public $quantite_prescrite;

	function __construct ($reference_ord, $nom_med, $instruction, $quantite_prescrite){
		$this->reference_ord = $reference_ord;
		$this->nom_med = $nom_med;
		$this->instruction = $instruction;
		$this->quantite_prescrite = $quantite_prescrite;
	}
	

	function Inserer(){
		$sql = "INSERT INTO tinstruction VALUES ('{$this->reference_ord}','{$this->nom_med}','{$this->instruction}','{$this->quantite_prescrite}')";
		$res=DB::Sql($sql);
	}
	
	public static function GetInstructions($reference) {
	
		$sql = "SELECT * FROM tinstruction WHERE reference_ord='$reference'";
		$res=DB::SqlToArray($sql);
			
		return $res;
	}
	
		
	public static function GetInstruction($reference) {
	
		$sql = "SELECT * FROM tinstruction WHERE reference_ord='$reference'";
		$res=DB::Sql($sql);
		$vResult = pg_fetch_array($res);
		
		return new Ordonnance($vResult['reference_ord'], $vResult['nom_med'], $vResult['instruction'], $vResult['quantite_prescrite']);
	}
	
	public static function SupprimerParReference($reference){
			$sql="DELETE FROM tinstruction WHERE reference_ord='$reference'";
			$res=DB::Sql($sql);
	}
};

?>
