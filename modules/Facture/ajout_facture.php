<h1>Ajout d'une facture</h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Facture&action=validation_facture" method="POST">
	<fieldset>
	
		<?php if (isset($facture)) {
		?>
		<label for="reference">Référence :</label>
		<input name="reference" type="text" id="reference" readonly value="<?php echo $facture->reference;?>">
		<?php } ?>
		
		<label for="montant">Montant :</label>
		<input name="montant" type="text" id="montant" value="<?php if (isset($facture)) echo $facture->montant;?>">
		
		<label for="etat">Etat:</label>
		<select id='etat' name='etat'>
			<option value='0' > Non Payée </option>
			<option value='1' <?php if(isset($facture) and ($facture->etat=='1')) echo "selected"; ?> > Payée </option>
		</select>
		
		<label for="mode_reglement">Mode de Règlement:</label>
		<input name="mode_reglement" type="text" id="mode_reglement" value="<?php if (isset($facture)) echo $facture->mode_reglement;?>">
		
		<label for="date_reglement">Date de Règlement:</label>
		<input name="date_reglement" type="text" id="date_reglement" value="<?php if (isset($facture)) echo $facture->date_reglement;?>">
		
		<label for="date_edition">Date d'Edition:</label>
		<input name="date_edition" type="text" id="date_edition" value="<?php if (isset($facture)) echo $facture->date_edition;?>">
		
		<label for="telephone_emp">Telephone Employé:</label>
		<input name="telephone_emp" type="text" id="telephone_emp" value="<?php if (isset($facture)) echo $facture->telephone_emp;?>">
		
		<label for="num_dossier">Numéro Dossier Animal:</label>
		<input name="num_dossier" type="text" id="num_dossier" value="<?php if (isset($facture)) echo $facture->num_dossier;?>">
		
		<label for="telephone_pers">Telephone Client:</label>
		<input name="telephone_pers" type="text" id="telephone_pers" value="<?php if (isset($facture)) echo $facture->telephone_pers;?>">
		
		<label for="race">Race:</label>
		<input name="race" type="text" id="race" value="<?php if (isset($facture)) echo $facture->race;?>">
		
		<label for="espece">Espèce:</label>
		<input name="espece" type="text" id="espece" value="<?php if (isset($facture)) echo $facture->espece;?>">
		
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 

 <script>
 
  $(function() {
    $( "#date_reglement" ).datepicker();
  });
  
    $(function() {
    $( "#date_edition" ).datepicker();
  });
  
</script>


