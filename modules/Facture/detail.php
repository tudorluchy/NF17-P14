<div id='detail_facture'>
	<h1> Facture n°<?php echo($facture->reference);?> </h1>

	<ul>
		<li><b>Référence : </b><?php echo($facture->reference);?> </li>
		<li><b>Montant : </b><?php if($facture->etat = 't') echo($facture->montant);?> €</li>
		<li><b>Mode de reglement : </b><?php if($facture->etat = 't') echo($facture->mode_reglement);?></li>
		<li><b>Date du reglement : </b><?php if($facture->etat = 't') echo($facture->date_reglement);?></li>
		<li><b>Date d'édition : </b><?php echo($facture->date_edition);?>  </li>
		<li><b>Télephone de l'employé : </b><?php echo($facture->telephone_emp);?> </li>
		<li><b>Numéro de dossier :</b> <?php echo($facture->num_dossier);?>   </li>
		<li><b>Telephone du client : </b><?php echo($facture->telephone_pers);?> </li>
		<li><b>Race de l'animal : </b><?php echo($facture->race);?> </li>
		<li><b>Espèce de l'animal : </b><?php echo($facture->espece);?> </li> 
	</ul>
	<br/>
	<?php 
		echo("<a href=\"?module=".$_SESSION['PREV_URL']."\"> Retour </a>"); ?>
</div>