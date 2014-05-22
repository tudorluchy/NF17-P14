<?php 
	echo("<h1>Modification d'une prestation</h1>");
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_modification_prestation_intervention" method="POST">
	<fieldset>
		
		<label for="nom">Nom :</label>
		<input name="nom" type="text" id="nom" value="<?php if (isset($prestation)) echo $prestation['nom_inter'];?>">

		<label>Nom espèce</label>
		<select id='espece' name='espece'>
		<?php 
		foreach ($liste_especes as $espece) {
		?>
			<option value=<?php echo "'".$espece['nom']."'"; ?> <?php // echo "selected=selected"; ?> ><?php echo $espece['nom']; ?></option>
		<?php 
		}
		?>
		</select>		
		
		<label for="race">Nom race :</label>
		<input name="race" type="text" id="race" readonly disabled value="<?php if (isset($prestation)) echo $prestation['nom_race'];?>">
		 
		<label for="prix">Prix :</label>
		<input name="prix" type="text" id="prix" value="<?php if (isset($prestation)) echo $prestation['prix'];?>">
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
