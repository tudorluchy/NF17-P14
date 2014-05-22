<?php
	echo("<h1>Liste des espèces et races</h1>");
?>

<form>
	<fieldset>
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
	</fieldset>
</form>