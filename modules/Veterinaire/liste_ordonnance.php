	
		
	<h1>Liste des Ordonnances</h1>
	<table>
		<tr>
			<th>Reference</th>
			<th>Date Création</th>
			<th>Telephone Vétérinaire</th>
			<th>Dossier Animal</th>
			<th>Actions</th>
		</tr>
	
	<?php		
	foreach ($ord as $o)
		{
		?>
			<tr>
				<td><?php echo $o['reference']; ?></td>
				<td><?php echo $o['date_ord']; ?></td>
				<td>0<?php echo $o['telephone']; ?></td>
				<td><?php echo $o['num_dossier']; ?></td>
				<td><a href='?module=Veterinaire&action=ordonnance&ref=<?php echo $o['reference'];?>'><img src='./template/icone_modifier.png' width='50px'></a></td>
			</tr>


<?php
}
?>
</table>
		
