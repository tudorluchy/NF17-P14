<?php

Class Facture {
	//Attributs
	public $reference;
	public $montant;
	public $etat;
	public $mode_reglement;
	public $date_reglement;
	public $date_edition;
	public $telephone_emp;
	public $num_dossier;
	public $telephone_pers;
	public $race;
	public $espece;


	function __construct ($reference, $montant, $etat, $mode_reglement, $date_reglement, $date_edition, $telephone_emp, $num_dossier, $telephone_pers, $race, $espece){
		$this->reference=$reference;
		$this->montant=$montant;
		$this->etat=$etat;
		$this->mode_reglement=$mode_reglement;
		$this->date_reglement=$date_reglement;
		$this->date_edition=$date_edition;
		$this->telephone_emp=$telephone_emp;
		$this->num_dossier=$num_dossier;
		$this->telephone_pers=$telephone_pers;
		$this->race=$race;
		$this->espece=$espece;
	}
	
	public static function mesfactures($telephone){
		$vConn = site::fconnect();
		$vSql = "SELECT * FROM tfacture WHERE telephone_pers='$telephone'";
		$vQuery=pg_query($vConn, $vSql);
		
		while($vResult = pg_fetch_array($vQuery)){
			$res[] = new Facture($vResult['reference'], $vResult['montant'], $vResult['etat'], $vResult['mode_reglement'], $vResult['date_reglement'], $vResult['date_edition'], $vResult['telephone_emp'], $vResult['num_dossier'], $vResult['telephone_pers'], $vResult['race'], $vResult['espece']);
		} 
		return $res;
	}
	
	public static function detailfacture($reference){
		$vConn = site::fconnect();
		$vSql = "SELECT * FROM tfacture WHERE reference='$reference'";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
		return new Facture($vResult['reference'], $vResult['montant'], $vResult['etat'], $vResult['mode_reglement'], $vResult['date_reglement'], $vResult['date_edition'], $vResult['telephone_emp'], $vResult['num_dossier'], $vResult['telephone_pers'], $vResult['race'], $vResult['espece']);
		
	}
};

?>
