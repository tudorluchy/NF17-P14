<?php
	echo("<h1>Création d'un prix consultation</h1>");
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_inscription_prestation_consultation_prix" method="POST">
	<fieldset>

		<label>Nom consultation</label>
		<select id='consultation' name='consultation'>
		<?php
		foreach ($liste_consultations as $consultation) {
		?>
			<option value=<?php echo "'".$consultation['nom']."'"; ?> <?php // echo "selected=selected"; ?> ><?php echo $consultation['nom']; ?></option>
		<?php
		}
		?>
		</select>

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

		<label for="prix">Prix :</label>
		<input name="prix" type="text" id="prix" value="<?php if (isset($prestation)) echo $prestation['prix'];?>">

		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>
		</div>

	</fieldset>
</form>
