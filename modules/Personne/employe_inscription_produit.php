<?php 
if (!isset($pers)) {
	echo("<h1>Création d'un nouveau produit</h1>");
} else { 
	echo("<h1>Modification du compte</h1>");
}
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_inscription_produit" method="POST">
	<fieldset>
		
		<label for="nom">Nom :</label>
		<input name="nom" type="text" id="nom" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<label for="stock">Stock :</label>
		<input name="stock" type="text" id="stock" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<label for="prix">Prix :</label>
		<input name="prix" type="text" id="prix" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<label for="p">Produit simple</label>
		<input type="radio" name="type" value="produit" id="p">
		<label for="m">Medicament</label>
		<input type="radio" name="type" value="medicament" id="m" checked>
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
