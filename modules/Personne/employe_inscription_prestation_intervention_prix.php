<?php
	echo("<h1>Création d'un prix pour une intervention</h1>");
?>

<form  enctype="multipart/form-data" name="inscription" action="?module=Personne&action=validation_employe_inscription_prestation_intervention_prix" method="POST">
	<fieldset>

		<label>Nom intervention</label>
		<select id='intervention' name='intervention' readonly>
		<?php
		foreach ($liste_interventions as $intervention) {
		?>
			<option value=<?php echo "'".$intervention['nom_inter']."'"; ?> <?php // echo "selected=selected"; ?> ><?php echo $intervention['nom_inter']; ?></option>
		<?php
		}
		?>
		</select>

		<label>Nom espèce</label>
		<select id='espece' name='espece' readonly>
		<?php
		foreach ($liste_especes as $espece) {
		?>
			<option value=<?php echo "'".$espece['nom']."'"; ?> <?php // echo "selected=selected"; ?> ><?php echo $espece['nom']; ?></option>
		<?php
		}
		?>
		</select>

 		<label>Nom race</label>
		<select id='race' name='race' readonly>
		<?php
		foreach ($liste_races as $race) {
		?>
			<option value=<?php echo "'".$race['nom']."'"; ?> class=<?php echo "'".$race['espece']."'"; ?> <?php // echo "selected=selected"; ?> ><?php echo $race['nom']; ?></option>
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
