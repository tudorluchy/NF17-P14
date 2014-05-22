<?php

Class PrixConsultation {

	//Attributs
	public $nom_espece;
	public $nom_consult;
	public $prix;

	function __construct ($nom_espece, $nom_consult, $prix){
		$this->nom_espece=$nom_espece;
		$this->nom_consult=$nom_consult;
		$this->prix=$prix;
	}

	function Inserer() {
		$sql = "INSERT INTO prixconsultation VALUES ('{$this->nom_espece}', '{$this->nom_consult}', '{$this->prix}')";
		$res=DB::Sql($sql);
	}

	function Modifier() {
		$sql = "UPDATE prixconsultation SET nom_espece='{$this->nom_espece}',nom_consult='{$this->nom_consult}',prix='{$this->prix}'
		WHERE nom_espece='{$this->nom_espece}' and nom_consult='{$this->nom_consult}'";
		$res=DB::Sql($sql);
	}

	public static function Existe($nom_espece, $nom_consult) {
		$sql = "select count(*) as nb from prixconsultation where nom_espece='$nom_espece' and nom_consult='$nom_consult'";
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