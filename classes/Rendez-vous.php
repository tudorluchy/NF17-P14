<?php

Class Rendez-vous{

	//Attributs
	public $telephone;
	public $nom;
	public $prenom;
	
	function __construct($telephone, $nom, $prenom){
		$this->telephone = $telephone;
		$this->nom = $nom;
		$this->prenom = $prenom;
	}
	
	function Inserer(){
		$sql = "INSERT INTO tveterinaire VALUES ('{$this->telephone}', '{$this->nom}', '{$this->prenom}') ";
		$res=DB::Sql($sql);
		var_dump($res);
		die;
	}
	
	public static function GetListeVet(){
		$sql = "SELECT * from tveterinaire";
		res = DB::SqlToArray($sql);
		return $res;
	}
	
	public static function Connection($telephone) {
		// table tVeterinaire
		$sql = "SELECT * FROM tveterinaire where telephone='$telephone'";
		$res = DB::Sql($sql);
		$res2 = pg_fetch_assoc($res);
		
		// si telephone trouvé alors il peut se connecter.
		if (isset($res2['telephone'])) {
			$c = new Veterinaire();
			$c->Creer($res2['telephone'], $res2['nom'],$res2['prenom']);
			return $c;
		} else {
			return false;
		}	
	}
	
	function Supprimer(){
		$sql="DELETE FROM tveterinaire WHERE telephone='{$telephone}'"
		$res = DB::Sql($sql);
	}
	
	function Modifier(){
		$sql="UPDATE tveterinaire SET nom='{$this->nom}',prenom='{$this->prenom}' WHERE telephone='{$this->telephone}'";
		$res=DB::Sql($sql);	
	}
	
	public static function Existe($telephone) {
		$sql = "select count(*) as nb from tveterinaire where telephone='$telephone'";
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