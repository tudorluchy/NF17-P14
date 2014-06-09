<h1>Ajout d'une facture</h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Facture&action=validation_facture" method="POST">
	<fieldset>
	
		<label for="date_edition">Date d'Edition:</label>
		<input name="date_edition" type="text" id="date_edition" value="<?php if (isset($facture)) echo $facture->date_edition;?>">
		
		<label for="telephone_emp">Telephone Employé:</label>
		<input name="telephone_emp" type="text" id="telephone_emp" value="<?php if (isset($facture)) echo $facture->telephone_emp;?>">
		
		<label for="num_dossier">Numéro Dossier Animal:</label>
		<input name="num_dossier" type="text" id="num_dossier" value="<?php if (isset($facture)) echo $facture->num_dossier;?>">
		
		<label for="telephone_pers">Telephone Client:</label>
		<input name="telephone_pers" type="text" id="telephone_pers" value="<?php if (isset($facture)) echo $facture->telephone_pers;?>">

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
  

  $(function() {
	 var num_dossier = [
      <?php foreach($animal as $a) echo("\"".$a['num_dossier']."\","); ?>
      ""
    ];
    $( "#num_dossier" ).autocomplete({
      source: num_dossier
    });
  });
  
    $(function() {
	 var telephone_pers = [
      <?php foreach($pers as $p) echo("\"0".$p['telephone']."\","); ?>
      ""
    ];
    $( "#telephone_pers" ).autocomplete({
      source: telephone_pers
    });
  });
  
    $(function() {
	 var telephone_emp = [
      <?php foreach($emp as $e) echo("\"0".$e['telephone']."\","); ?>
      ""
    ];
    $( "#telephone_emp" ).autocomplete({
      source: telephone_emp
    });
  });

</script>



