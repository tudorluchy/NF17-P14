<h1>Consulter les rendez-vous</h1>

<?php

foreach ($liste_rdv as $rdv)
{
?>
	
	<h2>
		Rendez-vous du <?php echo $rdv['date_rdv']; ?>
		avec animal numéro <?php echo $rdv['num_dossier']; ?>
	</h2>

		<table>
			<tr>
				<th>Date</th>
				<th>Téléphone vétérinaire</th>
				<th>Téléphone employé</th>
				<th>Dossier</th>
				<th>Durée</th>
			</tr>
			<tr>
				<td><?php echo $rdv['date_rdv'] ?></td>
				<td>0<?php echo $rdv['telephone_vet'] ?></td>
				<td>0<?php echo $rdv['telephone_emp'] ?></td>
				<td><?php echo $rdv['num_dossier'] ?></td>
				<td><?php echo $rdv['duree'] ?></td>
			</tr>
		</table>
<?php
}
?>