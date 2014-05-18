<?php

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
	function Inserer(){
		$vConn = site::fconnect();
		$vSql = "INSERT INTO tpersonne VALUES ('{$this->telephone}','{$this->nom}','{$this->prenom}')";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
	}

	function InsererVeterinaire(){
		$vConn = site::fconnect();
		$vSql = "INSERT INTO tpersonne VALUES ('{$this->telephone}','{$this->nom}','{$this->prenom}')";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
		
		$vSql = "INSERT INTO tveterinaire VALUES ('{$this->telephone}')";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
	}
	
	function InsererEmployee(){
		$vConn = site::fconnect();
		$vSql = "INSERT INTO tpersonne VALUES ('{$this->telephone}','{$this->nom}','{$this->prenom}')";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
		
		$vSql = "INSERT INTO temployee VALUES ('{$this->telephone}')";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
	}
	
	public static function Connection($telephone) {
		$vConn = site::fconnect();
		$vSql = "SELECT * FROM tpersonne WHERE telephone='$telephone'";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);
		
		return new Personne($vResult['telephone'], $vResult['nom'], $vResult['prenom']);
	}
	
	
	function Modifier($telephone){	
		$vConn = site::fconnect();
		$vSql = "UPDATE tpersonne SET telephone='{$this->telephone}',nom='{$this->nom}',prenom='{$this->prenom}' WHERE telephone='$telephone';";
		$vQuery=pg_query($vConn, $vSql);
		$vResult = pg_fetch_array($vQuery);	
	}		
	/*
	public function Supprimer(){
		$sql="DELETE FROM ... WHERE id='{$this->id}'";
		$res=DB::Sql($sql);
		$this->id=0;
	}

		//Méthodes statiques

	
	public static function ChercherParLogin($login) {
		$sql = "select * from tclient where login='$login'";
		$res = DB::Sql($sql);
		$res2 = pg_fetch_assoc($res);
		
		// si login et mdp trouvés alors, il peut se connecter.
		if (!empty($res2)) {
			$c = new Client();
			$c->Creer($res2['login'],$res2['mdp'],$res2['nom'],$res2['prenom'],$res2['adresse'],$res2['age'],$res2['adresse'],$res2['pointfidelite'],'client');
			return $c;
		} else {
			return false;
		}
	}
	
	*/
	
	public static function Existe($telephone) {
		$sql = "select count(*) as nb from tpersonne where telephone='$telephone'";
		$res = DB::Sql($sql);
		$res2 = pg_fetch_assoc($res);

		// si telephone trouvé
		if ($res2['nb'] != 0) {
			return true;
		} else {
			return false;
		}
	}

	
};

?>
