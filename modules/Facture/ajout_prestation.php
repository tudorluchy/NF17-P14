<h1>Ajout d'une Prestation pour la Facture #<?php echo $ref ?></h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Facture&action=validation_prestation" method="POST">
	<fieldset>
	
		<label for="nom_prest">Prestation :</label>
		<input name="nom_prest" type="text" id="nom_prest" value="<?php if (isset($prest)) echo $prest->nom_prest;?>">
		
		<label for="remise">Remise :</label>
		<input name="remise" type="text" id="remise" value="<?php if (isset($prest)) echo $prest->remise;?>">

		<label for="ref"></label>
		<input type='hidden' value='<?php echo $ref; ?>' name='ref' id='ref'>
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
		
	</fieldset>
</form>	 

 <script>
 
  $(function() {
	 var nom_prest = [
      <?php foreach($prestation as $p) echo("\"".$p['nom']."\","); ?>
      ""
    ];
    $( "#nom_prest" ).autocomplete({
      source: nom_prest
    });
  });

</script>



