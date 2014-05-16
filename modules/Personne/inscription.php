<form  enctype="multipart/form-data" name="inscription" action="?module=personne&action=valide" method="POST">
	<fieldset>
		
		<?php if (!isset($pers)) {
		?>
			<h1>Inscription d'un nouvel utilisateur</h1>
		<?php } else {
		?>
			<h1>Modification compte</h1>
		<?php
		}	
		?>
			<label for="nom">Nom :</label>
			<input name="nom" type="text" id="nom" value="<?php if (isset($pers)) echo $pers->nom;?>">
			
			<label for="prenom">Prénom :</label>
			<input name="prenom" type="text" id="prenom" value="<?php if (isset($pers)) echo $pers->prenom;?>">
			
			<label for="telephone">Télephone</label>
			<input name="telephone" type="text" id="telephone" value="<?php if (isset($pers)) echo $pers->telephone; ?>">
			
			
		<p>
			<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
			</div>
		</p>
		
	</fieldset>			
</form>	 
