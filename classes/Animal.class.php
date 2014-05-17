<?php

Class Animal {
	
	//Attributs
	public $num_dossier;
	public $nom;
	public $poids;
	public $taille;
	public $genre;
	public $date_naiss;
	public $photo;
	public $race;
	public $espece;
	public $telephone;
	
	function __construct ($num_dossier, $nom, $poids, $taille, $genre, $date_naiss, $photo, $race, $espece, $telephone){
		$this->num_dossier = $num_dossier;
		$this->nom = $nom;
		$this->poids = $poids;
		$this->taille = $taille;
		$this->genre = $genre;
		$this->date_naiss = $date_naiss;
		$this->photo = $photo;
		$this->race = $race;
		$this->espece = $espece;
		$this->telephone = $telephone;
	}
	
	public static function mesanimaux($telephone) {
		$vConn = site::fconnect();
		$vSql = "SELECT * FROM tanimal WHERE telephone='$telephone'";
		$vQuery=pg_query($vConn, $vSql);
		
		while($vResult = pg_fetch_array($vQuery)){
			$res[] = new Animal($vResult['num_dossier'], $vResult['nom'], $vResult['poids'], $vResult['taille'], $vResult['genre'], $vResult['date_naiss'], $vResult['photo'], $vResult['race'], $vResult['espece'], $vResult['telephone']);
		} 
		return $res;
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
	
	public static function Existe($login) {
		$sql = "select count(*) as nb from tclient where login='$login'";
		$res = DB::Sql($sql);
		$res2 = pg_fetch_assoc($res);

		// si login trouvér.
		if ($res2['nb'] != 0) {
			return true;
		} else {
			return false;
		}
	}

	*/
};

?>
