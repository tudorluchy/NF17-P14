<?php 
	echo("<h1>Suppresion d'un compte</h1>");
?>

<form action="?module=Personne&action=validation_administration_suppresion" autocomplete="on" method="POST">
	<fieldset>
			<label>Telephone</label><input type="text" name="telephone" />
			<div class="bloc_inscrip">
				<input  type="submit" name="suppresion" value="Suppresion"/>	
			</div>
	</fieldset>			
</form>	 
