<?php

define("PRESTATION",1);
define("INTERVENTION",2);
define("CONSULTATION",3);

Class Prestation {
	
	//Attributs
	public $nom;
	
	function __construct ($nom){
		$this->nom=$nom;
	}

	function Inserer($type=PRESTATION){
		$sql = "INSERT INTO tprestation VALUES ('{$this->nom}')";
		$res=DB::Sql($sql);
		
		if ($type == INTERVENTION) {
			$sql = "INSERT INTO tintervention VALUES ('{$this->nom}')";
			$res=DB::Sql($sql);
		} else if ($type == CONSULTATION) {
			$sql = "INSERT INTO tconsultation VALUES ('{$this->nom}')";
			$res=DB::Sql($sql);
		}
	}
	
	public static function GetListeInterventionsAvecPrix() {
		$sql = "SELECT i.nom_inter, pi.nom_espece, pi.nom_race, pi.prix FROM tintervention i LEFT JOIN prixintervention pi ON i.nom_inter = pi.nom_inter";
		$res=DB::SqlToArray($sql);
		
		return $res;
	}
	
	public static function GetListeConsultationsAvecPrix() {
		$sql = "SELECT c.nom, pc.nom_espece, pc.prix FROM tconsultation c LEFT JOIN prixconsultation pc ON c.nom = pc.nom_consult";
		$res=DB::SqlToArray($sql);
		
		return $res;
	}
	
	public static function Existe($nom) {
		$sql = "select count(*) as nb from tprestation where nom='$nom'";
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
	
	public static function isIntervention($nom) {
		$sql = "select count(*) as nb from tintervention where nom='$nom'";
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

	public static function isConsultation($nom) {
		$sql = "select count(*) as nb from tconsultation where nom='$nom'";
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