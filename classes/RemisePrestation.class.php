<?php

Class RemisePrestation {
	//Attributs
	public $remise;
	public $reference_fac;
	public $nom_prest;

	function __construct ($remise,$reference_fac,$nom_prest){
		$this->nom_prest=$nom_prest;
		$this->reference_fac=$reference_fac;
		$this->remise=$remise;
	}
		
	function Inserer(){
		$sql = "INSERT INTO remiseprestation VALUES ('$this->remise','$this->reference_fac','$this->nom_prest')";
		return DB::Sql($sql);
	}
	
	public static function GetRemisePrestation($ref) {
		$sql = "SELECT * FROM remiseprestation WHERE reference_fac='$ref'";
		return DB::SqlToArray($sql);
	}
	
	public static function getEspeceRace($num_dossier)
	{
		$sql="SELECT race,espece FROM tanimal WHERE num_dossier='$num_dossier' ";
		return pg_fetch_assoc(DB::Sql($sql));
	}
	
	public static function getPrixIntervention($nom,$espece,$race)
	{
		$sql = "SELECT prix FROM prixintervention WHERE nom_inter='$nom' and nom_espece='$espece' and nom_race='$race'";
		return pg_fetch_assoc(DB::Sql($sql));
	}
	
	public static function getPrixConsultation($nom,$espece)
	{
		$sql = "SELECT prix FROM prixconsultation WHERE nom_consult='$nom' and nom_espece='$espece'";
		return pg_fetch_assoc(DB::Sql($sql));
	}
	
	
};

?>
