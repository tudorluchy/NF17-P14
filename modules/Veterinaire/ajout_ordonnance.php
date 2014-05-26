<h1>Prescription d'une ordonnance</h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Veterinaire&action=validation_ordonnance" method="POST">
	<fieldset>
		<label for="num_dossier">Numéro de dossier</label>
		<input name="num_dossier" type="text" id="num_dossier" value="<?php if(isset($ord)) echo($ord->num_dossier); ?>">
		
		<label for="date_ord">Date de l'ordonnance :</label>
		<input name="date_ord" type="text" id="date_ord" value="<?php if(isset($ord)) echo($ord->date_ord); ?>">
		
		<label for="tel_vet">Téléphone du vétérinaire</label>
		<input name="tel_vet" type="text" id="tel_vet" value="<?php if(isset($ord)) echo($ord->telephone); ?>">
		
		<div class="bloc_inscrip">
			<input  type="reset" name="reset" value="Reset"/>
			<input  type="submit" name="valider" value="Valider"/>	
		</div>
	</fieldset>			
</form>	 

<script>
 
  $(function() {
    $( "#date_ord" ).datepicker();
  });


  $(function() {
    var tel_vet = [
      <?php foreach($vet as $v) echo("\"$v->telephone\",") ?>
      ""
    ];
    $( "#tel_vet" ).autocomplete({
      source: tel_vet
    });
	
	 var num_dossier = [
      <?php foreach($animal as $a) echo("\"$a->num_dossier : $a->nom\",") ?>
      ""
    ];
    $( "#num_dossier" ).autocomplete({
      source: tel_prop
    });
  });

</script>
