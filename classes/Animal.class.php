<?php

Class Animal {
	
	//Attributs
	public $num_dossier;
	public $nom;
	public $poids;
	public $taille;
	public $genre;
	public $date_naiss;
	public $race;
	public $espece;
	public $telephone;
	
	function __construct ($num_dossier, $nom, $poids, $taille, $genre, $date_naiss, $race, $espece, $telephone){
		$this->num_dossier = $num_dossier;
		$this->nom = $nom;
		$this->poids = $poids;
		$this->taille = $taille;
		$this->genre = $genre;
		$this->date_naiss = $date_naiss;
		$this->race = $race;
		$this->espece = $espece;
		$this->telephone = $telephone;
	}
	
	public static function mesanimaux($telephone) {
		$sql = "SELECT * FROM tanimal WHERE telephone='$telephone'";
		$res=DB::SqlToArray($sql);
		
		$res2 = array();
		
		foreach($res as $row) {
			$res2[] = new Animal($row['num_dossier'], $row['nom'], $row['poids'], $row['taille'], $row['genre'], $row['date_naiss'], $row['photo'], $row['race'], $row['espece'], $row['telephone']);
		}
		
		return $res2;
	}
	

	function Inserer(){
		$sql = "INSERT INTO tanimal VALUES ('{$this->num_dossier}','{$this->nom}','{$this->poids}','{$this->taille}','{$this->genre}','{$this->date_naiss}', '{$this->race}','{$this->espece}','{$this->telephone}')";
		$res=DB::Sql($sql);
		var_dump($res);
		die;
	}
};

?>
