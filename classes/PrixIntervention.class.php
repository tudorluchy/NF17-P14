<?php

Class PrixIntervention {

	//Attributs
	public $nom_race;
	public $nom_espece;
	public $nom_inter;
	public $prix;

	function __construct ($nom_race, $nom_espece, $nom_inter, $prix){
		$this->nom_race=$nom_race;
		$this->nom_espece=$nom_espece;
		$this->nom_inter=$nom_inter;
		$this->prix=$prix;
	}

	function Inserer() {
		$sql = "INSERT INTO prixintervention VALUES ('{$this->nom_race}', '{$this->nom_espece}', '{$this->nom_inter}', '{$this->prix}')";
		$res=DB::Sql($sql);
	}

	function Modifier() {
		$sql = "UPDATE prixintervention SET nom_race='{$this->nom_race}', nom_espece='{$this->nom_espece}', nom_inter='{$this->nom_inter}',prix='{$this->prix}'
		WHERE nom_race='{$this->nom_race}', nom_espece='{$this->nom_espece}', nom_inter='{$this->nom_inter}'";
		$res=DB::Sql($sql);
	}
	
	public static function SupprimerPrixIntervention($nom_race, $nom_espece, $nom_inter) {
		$sql = "DELETE FROM prixintervention where nom_race='$nom_race' and nom_espece='$nom_espece' and nom_inter='$nom_inter'";
		$res=DB::Sql($sql);
	}

	public static function Existe($nom_race, $nom_espece, $nom_inter) {
		$sql = "select count(*) as nb from prixintervention where nom_race='$nom_race' and nom_espece='$nom_espece' and nom_inter='$nom_inter'";
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