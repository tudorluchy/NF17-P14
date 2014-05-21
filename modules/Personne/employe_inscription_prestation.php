<?php 
if (!isset($pers)) {
	echo("<h1>Création d'une nouvelle prestation</h1>");
} else { 
	echo("<h1>Modification du compte</h1>");
}
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_inscription_prestation" method="POST">
	<fieldset>
		
		<label for="nom">Nom :</label>
		<input name="nom" type="text" id="nom" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<label for="i">Intervention</label>
		<input type="radio" name="type" value="intervention" id="i">
		<label for="c">Consultation</label>
		<input type="radio" name="type" value="consultation" id="c" checked>
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
