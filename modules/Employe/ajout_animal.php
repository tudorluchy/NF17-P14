<h1>Ajout d'un nouvel animal</h1>

<form  enctype="multipart/form-data" name="validation_animal" action="?module=Employe&action=validation_animal" method="POST">
        <fieldset>

                <label for="num_dossier">Numéro de dossier :</label>
                <input name="num_dossier" type="text" id="num_dossier" value="<?php if (isset($animal)) echo $animal->num_dossier;?>">

                <label for="nom">Nom :</label>
                <input name="nom" type="text" id="nom" value="<?php if (isset($animal)) echo $animal->nom;?>">

                <label for="poids">Poids :</label>
                <input name="poids" type="text" id="poids" value="<?php if (isset($animal)) echo $animal->poids; ?>">

                <label for="taille">Taille :</label>
                <input name="taille" type="text" id="taille" value="<?php if (isset($animal)) echo $animal->taille; ?>">

                <label for="genre">Genre : </label>
                <select id='genre' name='genre'>
                        <option> M </option>
                        <option> F </option>
                </select>

                <label for="date_naiss">Date de naissance :</label>
                <input name="date_naiss" type="text" id="date_naiss" value="<?php if (isset($animal)) echo $animal->date_naiss; ?>">

                <label for="espece">Espèce :</label>
                <select id='espece' name='espece' readonly>
                <?php
                foreach ($espece as $e) {
                ?>
                        <option value=<?php echo "'".$e['nom']."'"; ?>><?php echo $e['nom']; ?></option>
                <?php
                }
                ?> 
                </select>
        
                <label for="race">Race :</label>
                <select id='race' name='race' readonly>
                <?php
                foreach ($race as $r) {
                ?> 
                        <option value=<?php echo "'".$r['nom']."'"; ?>><?php echo $r['nom']; ?></option>
                <?php
                }
                ?> 
                </select>
                
                <label for="telephone">Télephone du propriétaire :</label>
                <input name="telephone" type="text" id="telephone" value="<?php if (isset($animal)) echo $animal->telephone; ?>">
		
		 <div class="bloc_inscrip">
                        <input  type="reset" name="reset" value="Reset"/>
                        <input  type="submit" name="valider" value="Valider"/>
                </div>

        </fieldset>
</form>

<script>
 
  $(function() {
    $( "#date_naiss" ).datepicker();
 
         var telephone = [
      <?php foreach($pers as $p) echo("\"0" . $p['telephone'] ."\",") ?>
      ""
    ];
    $( "#telephone" ).autocomplete({
      source: telephone
    });

  });

</script>
                              