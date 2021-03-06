<?php

Class RendezVous{

	//Attributs
	public $dateRDV;
	public $telVet;
	public $telEmp;
	public $num_dossier;
	public $duree;
	
	function __construct($dateRDV, $telVet, $telEmp, $num_dossier, $duree){
		$this->dateRDV = $dateRDV;
		$this->telVet = $telVet;
		$this->telEmp = $telEmp;
		$this->num_dossier = $num_dossier;
		$this->duree = $duree;
	}
	
	function Inserer(){
		$sql = "INSERT INTO tRendezvous VALUES ('{$this->dateRDV}', '{$this->telVet}', '{$this->telEmp}', '{$this->num_dossier}', '{$this->duree}'); ";
		$res=DB::Sql($sql);
	}
	
	public static function GetListeRDV(){
		$sql = "SELECT * from tRendezvous";
		$res = DB::SqlToArray($sql);
		return $res;
	}
	
	public static function GetListeRDV1veto($telVet){
		$sql = "SELECT * from tRendezvous where telephone_vet='{$telVet}'";
		$res = DB::SqlToArray($sql);
		return $res;
	}
	
	
	function Supprimer(){
		$sql="DELETE FROM tRendezvous WHERE date_rdv='{$dateRDV}' and telephone_vet='{$telVet}' and num_dossier='{$num_dossier}'";
		$res = DB::Sql($sql);
	}
	
	function Modifier(){
		$sql="UPDATE tRendezvous SET telephone_emp='{$this->telEmp}',  race='{$this->race}', espece='{$this->espece}' WHERE date_rdv='{$dateRDV}' and telephone_vet='{$telVet}' and num_dossier='{$num_dossier}'";
		$res=DB::Sql($sql);	
	}
	
	public static function Existe($dateRDV, $telVet, $num_dossier) {
		$sql = "select count(*) as nb from tRendezvous where date_rdv='{$dateRDV}' and telephone_vet='{$telVet}' and num_dossier='{$num_dossier}'";
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



?>