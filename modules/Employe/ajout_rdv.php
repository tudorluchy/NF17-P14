<h1>Ajout d'un rendez-vous</h1>

<form  enctype="multipart/form-data" name="rdv" action="?module=Employe&action=validation_rdv" method="POST">
        <fieldset>
                <label for="date_rdv">Date du rendez-vous :</label>
                <input name="date_rdv" type="text" id="date_rdv">
                
                <label for="duree">Durée du rendez-vous :</label>
                <input name="duree" type="number" id="duree">
                
                <label for="tel_vet">Téléphone du vétérinaire</label>
                <input name="tel_vet" type="text" id="tel_vet">
                
                <label for="tel_prop">Téléphone de l'employé</label>
                <input name="tel_prop" type="text" id="tel_prop">
                
                <label for="num_dossier">Numéro de dossier</label>
                <input name="num_dossier" type="text" id="num_dossier">
                
                <div class="bloc_inscrip">
                        <input  type="reset" name="reset" value="Reset"/>
                        <input  type="submit" name="valider" value="Valider"/>  
                </div>
        </fieldset>                     
</form>  

<script>
 
  $(function() {
    $( "#date_rdv" ).datepicker();
  });


  $(function() {
    var tel_vet = [
      <?php foreach($vet as $v) echo("\"0".$v['telephone']."\",") ?>
      ""
    ];
    $( "#tel_vet" ).autocomplete({
      source: tel_vet
    });
        
          var tel_prop = [
      <?php foreach($pers as $p) echo("\"0" . $p['telephone'] ."\",") ?>
      ""
    ];
    $( "#tel_prop" ).autocomplete({
      source: tel_prop
    });
