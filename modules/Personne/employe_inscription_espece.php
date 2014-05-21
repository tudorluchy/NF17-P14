<?php 
	echo("<h1>Création d'une nouvelle espèce</h1>");
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_inscription_espece" method="POST">
	<fieldset>
		
		<label for="nom">Nom espèce :</label>
		<input name="nom" type="text" id="nom" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
