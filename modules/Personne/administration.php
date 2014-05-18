<?php 
if (!isset($pers)) {
	echo("<h1>Inscription d'un nouvel utilisateur</h1>");
} else { 
	echo("<h1>Modification du compte</h1>");
}
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=valide_admin" method="POST">
	<fieldset>
		
		<label for="nom">Nom :</label>
		<input name="nom" type="text" id="nom" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<label for="prenom">Prénom :</label>
		<input name="prenom" type="text" id="prenom" value="<?php if (isset($pers)) echo $pers->prenom;?>">
		
		<label for="telephone">Télephone</label>
		<input name="telephone" type="text" id="telephone" value="<?php if (isset($pers)) echo $pers->telephone; ?>">
		
		<label for="v">Vétérinaire</label>
		<input type="radio" name="type" value="veterinaire" id="v">
		<label for="e">Employé</label>
		<input type="radio" name="type" value="employe" id="e" checked>
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
