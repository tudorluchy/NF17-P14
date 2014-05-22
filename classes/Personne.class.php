<?php

define("PERSONNE",1);
define("VETERINAIRE",2);
define("EMPLOYE",3);

Class Personne {
	
	//Attributs
	public $telephone;
	public $nom;
	public $prenom;
	
	function __construct ($telephone, $nom, $prenom){
		$this->telephone=$telephone;
		$this->nom=$nom;
		$this->prenom=$prenom;
	}
	// Méthodes de classe privées
	function Inserer($type=PERSONNE){
		$sql = "INSERT INTO tpersonne VALUES ('{$this->telephone}','{$this->nom}','{$this->prenom}')";
		$res=DB::Sql($sql);
		
		if ($type == VETERINAIRE) {
			$sql = "INSERT INTO tveterinaire VALUES ('{$this->telephone}')";
			$res=DB::Sql($sql);
		} else if ($type == EMPLOYE) {
			$sql = "INSERT INTO temploye VALUES ('{$this->telephone}')";
			$res=DB::Sql($sql);
		}
	}

	public static function Connection($telephone) {
	
		$sql = "SELECT * FROM tpersonne WHERE telephone='$telephone'";
		$res=DB::Sql($sql);
		$vResult = pg_fetch_array($res);
		
		return new Personne($vResult['telephone'], $vResult['nom'], $vResult['prenom']);
	}
	
	
	function Modifier($telephone){	
		$sql = "UPDATE tpersonne SET telephone='{$this->telephone}',nom='{$this->nom}',prenom='{$this->prenom}' WHERE telephone='$telephone';";
		$res=DB::Sql($sql);
	}
			
	
	public static function SupprimerParTelephone($telephone){
		if (self::isVeterinaire($telephone)) {
			$sql="DELETE FROM tveterinaire WHERE telephone='$telephone'";
			$res=DB::Sql($sql);	
		} else if (self::isEmploye($telephone)) {
			$sql="DELETE FROM temploye WHERE telephone='$telephone'";
			$res=DB::Sql($sql);	
		}
		$sql="DELETE FROM tpersonne WHERE telephone='$telephone'";
		$res=DB::Sql($sql);
	}

	
	public static function Existe($telephone) {
		$sql = "select count(*) as nb from tpersonne where telephone='$telephone'";
		$res = DB::Sql($sql);
		if (!$res) {
			return false;
		}
		$res2 = pg_fetch_assoc($res);

		// si telephone trouvé
		if ($res2['nb'] != 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function isVeterinaire($telephone) {
		$sql = "select count(*) as nb from tveterinaire where telephone='$telephone'";
		$res = DB::Sql($sql);
		if (!$res) {
			return false;
		}
		$res2 = pg_fetch_assoc($res);

		// si telephone trouvé
		if ($res2['nb'] != 0) {
			return true;
		} else {
			return false;
		}
	}

	public static function isEmploye($telephone) {
		$sql = "select count(*) as nb from tEmploye where telephone='$telephone'";
		$res = DB::Sql($sql);
		if (!$res) {
			return false;
		}
		$res2 = pg_fetch_assoc($res);

		// si telephone trouvé
		if ($res2['nb'] != 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function GetListePersonnes() {
		$sql = "SELECT * FROM tpersonne";
		$res=DB::SqlToArray($sql);
		return $res;
	}
	
};

?>
