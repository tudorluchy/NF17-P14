
<div id="mes_rdv">
	<h2>Mes rendez-vous de la journée : </h2>
	
	
	<?php 
		if (isset($rdv_jour)) {
			echo("Vous avez des rdv."); // A modifier
		}
		else
			echo("Vous n'avez pas de rendez-vous aujourd'hui.");
		?>
		
		
		
	<h2>Mes rendez-vous de la semaine : </h2>
		<?php 
	
		if (isset($rdv_sem)) {
			echo("Vous avez des rdv."); // A modifier
			}
		else
			echo("Vous n'avez pas de rendez-vous cette semaine.");
		?>
			
</div>
