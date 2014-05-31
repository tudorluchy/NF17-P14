<h1>Prescription d'une ordonnance</h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Veterinaire&action=validation_ordonnance" method="POST">
	<fieldset>
		<label for="num_dossier">Numéro de dossier de l'animal</label>
		<input name="num_dossier" type="text" id="num_dossier" value="<?php if(isset($ord)) echo($ord->num_dossier); ?>">
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
	</fieldset>			
</form>	 

<script>
  $(function() {
	 var num_dossier = [
      <?php foreach($animal as $a) echo("\"".$a['num_dossier']."\","); ?>
      ""
    ];
    $( "#num_dossier" ).autocomplete({
      source: num_dossier
    });
  });

</script>
