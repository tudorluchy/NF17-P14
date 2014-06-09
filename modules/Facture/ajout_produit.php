<h1>Ajout d'un Produit pour la Facture #<?php echo $ref ?></h1>

<form  enctype="multipart/form-data" name="inscription" action="?module=Facture&action=validation_produit" method="POST">
	<fieldset>
	
		<label for="nom_produit">Produit :</label>
		<input name="nom_produit" type="text" id="nom_produit" value="<?php if (isset($achat)) echo $achat->nom_produit;?>">
		
		<label for="quantite">Quantité :</label>
		<input name="quantite" type="text" id="quantite" value="<?php if (isset($achat)) echo $achat->quantite;?>">
		
		<label for="remise">Remise :</label>
		<input name="remise" type="text" id="remise" value="<?php if (isset($achat)) echo $achat->remise;?>">

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
	 var nom_produit = [
      <?php foreach($produit as $p) echo("\"".$p['nom']."\","); ?>
      ""
    ];
    $( "#nom_produit" ).autocomplete({
      source: nom_produit
    });
  });

</script>



