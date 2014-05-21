<?php 
	echo("<h1>Création d'une nouvelle race</h1>");
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_inscription_race" method="POST">
	<fieldset>
		
		<label>Espèce</label>
		<select id='espece' name='espece'>
		<?php 
		foreach ($liste_especes as $espece) {
		?>
			<option value=<?php echo "'".$espece['nom']."'"; ?> <?php // echo "selected=selected"; ?> ><?php echo $espece['nom']; ?></option>
		<?php 
		}
		?>
		</select>

		<label for="nom">Nom race :</label>
		<input name="nom" type="text" id="nom" value="<?php if (isset($pers)) echo $pers->nom;?>">
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
