<h1>Ajout d'une instruction</h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Veterinaire&action=validation_instruction&ref=<?php echo(Form::get('ref'));?> " method="POST">
	<fieldset>
		<label for="nom_med">Nom du médicament</label>
		<input name="nom_med" type="text" id="nom_med" value="<?php if(isset($instr)) echo($instr->nom_med); ?>">
		
		<label for="quantite_prescrite">Quantité</label>
		<input name="quantite_prescrite" type="text" id="quantite_prescrite" value="<?php if(isset($instr)) echo($instr->quantite_prescrite); ?>">
		
		<label for="instruction">Instruction</label>
		<textarea name="instruction" id="tel_vet" value="<?php if(isset($instr)) echo($instr->instruction); ?>" rows=10 cols=70> </textarea>
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
	</fieldset>			
</form>	 

<script>
  $(function() {
    var nom_med = [
      <?php foreach($med as $m) echo("\"".$m['nom']."\",") ?>
      ""
    ];
    $( "#nom_med" ).autocomplete({
      source: nom_med
    });
	
  });
</script>
