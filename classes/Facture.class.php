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
		$sql = "SELECT * FROM tfacture WHERE telephone_pers='$telephone'";
		$res=DB::SqlToArray($sql);

		$res2 = array();
		
		foreach($res as $row) {
			$res2[] = new Facture($row['reference'], $row['montant'], $row['etat'], $row['mode_reglement'], $row['date_reglement'], $row['date_edition'], $row['telephone_emp'], $row['num_dossier'], $row['telephone_pers'], $row['race'], $row['espece']);
		}
		
		return $res2;
	}
	
	public static function detailfacture($reference){
		$sql = "SELECT * FROM tfacture WHERE reference='$reference'";
		$res=DB::Sql($sql);
		
		$res2 = pg_fetch_array($res);
		return new Facture($res2['reference'], $res2['montant'], $res2['etat'], $res2['mode_reglement'], $res2['date_reglement'], $res2['date_edition'], $res2['telephone_emp'], $res2['num_dossier'], $res2['telephone_pers'], $res2['race'], $res2['espece']);
	}
};

?>
