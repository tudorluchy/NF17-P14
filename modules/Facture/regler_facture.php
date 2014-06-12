<h1>Règlement d'une facture</h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Facture&action=validation_reglement" method="POST">
	<fieldset>
	
		<label for="mode_reglement">Mode de Règlement:</label>
		<select id='mode_reglement' name='mode_reglement'>
			<option value='none'>Aucuns</option>
			<option value='CB' <?php if(isset($facture) and ($facture->mode_reglement=='CB')) echo "selected"; ?> >Carte Bleue</option>
			<option value='cheque' <?php if(isset($facture) and ($facture->mode_reglement=='cheque')) echo "selected"; ?> >Chèque</option>
			<option value='especes' <?php if(isset($facture) and ($facture->mode_reglement=='especes')) echo "selected"; ?> >Espèces</option>
		</select>
		
		<label for="date_reglement">Date de Règlement:</label>
		<input name="date_reglement" type="date" id="date_reglement" value="<?php if (isset($facture)) echo $facture->date_reglement;?>">
		
		<input type='hidden' value='<?php echo $_GET['facture']; ?>' name='ref'>

		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>			
</form>	 
<!--
 <script>
 
  $(function() {
    $( "#date_reglement" ).datepicker();
  });
  
    $(function() {
    $( "#date_edition" ).datepicker();
  });

</script>

-->

