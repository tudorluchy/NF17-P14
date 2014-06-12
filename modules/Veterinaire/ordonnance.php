<h1>Ordonnance n°<?php if(isset($ord->reference)) echo($ord->reference);?>  </h1>

	<ul>
		<li><b>Numéro de dossier : </b><?php if(isset($ord->num_dossier)) echo($ord->num_dossier);?> </li>
		<li><b>Date de l'ordonnance : </b><?php if(isset($ord->date_ord)) echo($ord->date_ord);?> </li>
		<li><b>Téléphonne du Vétérinaire :  </b><?php if(isset($ord->telephone)) echo("0".$ord->telephone);?> </li>
	</ul>

<div id="liste_instruct">
	<a href="?module=Veterinaire&action=ajout_instruction&ref=<?php echo($ord->reference);?>">Ajouter une instruction</a><br /><br />


		<?php 

		if (!empty($instr)) {
		?>
		<table>
			<tr>
				<th> Nom du médicament</th>
				<th> Quantité </th>
				<th> Instruction </th>
				<th></th>
			</tr>
			<?php
				foreach ($instr as $i) {
					echo("<tr><td>".$i['nom_med']."</td><td>".$i['quantite_prescrite']."</td><td>".$i['instruction']."</td><td><div id='supprimer'><a href='?module=Veterinaire&action=suppression_instruction&instruction=".$i['reference_ord']."&ref=".$ord->reference."'><img src='template/icone_supprimer.png'/></a></div></td></tr>"); 
				}?>
			
		</table>
			<?php
			}
			else
				echo("Vous n'avez pas encore enregistré d'instruction.");
			?>





	<form  enctype="multipart/form-data" name="inscription" action="?module=Veterinaire&action=validation_finale_ordonnance" method="POST">
		<fieldset>	
			<div class="bloc_inscrip">
				<input  type="submit" name="valider" value="Valider"/>	
				
			</div>
		</fieldset>			
	</form>	 
</div>
