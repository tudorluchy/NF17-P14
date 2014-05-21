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
	
	public static function Existe($nom) {
		$sql = "select count(*) as nb from tprestation where telephone='$nom'";
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
		$sql = "select count(*) as nb from tintervention where telephone='$nom'";
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
		$sql = "select count(*) as nb from tconsultation where telephone='$nom'";
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