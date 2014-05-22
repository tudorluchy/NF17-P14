<?php 
	echo("<h1>Liste des prestations avec leurs prix</h1>");
?>

<?php
	if(!empty($liste_interventions)) {
?>
<h2>Prix interventions</h2>
<table border=1 id="table">
	<tr>
		<th>Nom</th>
		<th>Espece</th>
		<th>Race</th>
		<th>Prix</th>
		<!-- <th>Modifier prix</th> -->
	</tr>
	<?php
		foreach($liste_interventions as $intervention) {
			echo"<tr>";
				echo"<td>".$intervention['nom_inter']."</td>";
				echo"<td>"; 
				if (empty($intervention['nom_espece'])) 
					echo "<i>A definir...</i>";
				else 	
					 echo $intervention['nom_espece'];
				echo "</td>";
				echo"<td>"; 
				if (empty($intervention['nom_race'])) 
					echo "<i>A definir...</i>";
				else 	
					 echo $intervention['nom_race'];
				echo "</td>";
				echo"<td>"; 
				if (empty($intervention['prix'])) 
					echo "<i>A definir...</i>";
				else 	
					 echo $intervention['prix'];
				echo "</td>";
				/*
				echo "<td>";
					if ($intervention['prix']) {
						echo "<a href='?module=Personne&action=modifier_prestation&nom={$intervention['nom_inter']}'><img src='template/edit.png' title='Modifier une prestation'/></a>";
					} else {
						echo "<i>Impossible</i>";
					}
				echo "</td";
				*/
			echo"</tr>";
		}
	} else {
		echo"Aucune intervention trouvée.<br /><br />";
	}
	?>
</table>

<br/>

<?php
	if(!empty($liste_consultations)) {
?>
<h2>Prix consultations</h2>
<table border=1 id="table">
	<tr>
		<th>Nom</th>
		<th>Espece</th>
		<th>Prix</th>
		<!-- <th>Modifier prix</th> -->
	</tr>
	<?php
		foreach($liste_consultations as $consultation) {
			echo"<tr>";
				echo"<td>".$consultation['nom']."</td>";
				echo"<td>"; 
				if (empty($consultation['nom_espece'])) 
					echo "<i>A definir...</i>";
				else 	
					 echo $consultation['nom_espece'];
				echo "</td>";
				echo"<td>"; 
				if (empty($consultation['prix'])) 
					echo "<i>A definir...</i>";
				else 	
					 echo $consultation['prix'];
				echo "</td>";
				/*
				echo "<td>";
					if (!empty($consultation['prix'])) {
						echo "<a href='?module=Personne&action=modifier_prestation&nom={$consultation['nom']}'><img src='template/edit.png' title='Modifier une prestation'/></a>";
					} else {
						echo "<i>Impossible</i>";
					}
				echo "</td";
				*/
			echo"</tr>";
		}
	} else {
		echo"Aucune consultation trouvée.<br /><br />";
	}
	?>
</table>

