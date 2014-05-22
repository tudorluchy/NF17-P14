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
		<th>Supprimer</th>
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
				echo "<td>";
					if (!empty($intervention['prix'])) {
						echo "<a href='?module=Personne&action=supprimer_prix_intervention&nom={$intervention['nom_inter']}&nom_espece={$intervention['nom_espece']}&nom_race={$intervention['nom_race']}'><img src='template/delete.png' title='Supprimer un prix intervention'/></a>";
					} else {
						echo "<i>Impossible</i>";
					}
				echo "</td";
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
		<th>Supprimer</th>
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
				echo "<td>";
					if (!empty($consultation['prix'])) {
						echo "<a href='?module=Personne&action=supprimer_prix_consultation&nom={$consultation['nom']}&nom_espece={$consultation['nom_espece']}'><img src='template/delete.png' title='Supprimer un prix consultation'/></a>";
					} else {
						echo "<i>Impossible</i>";
					}
				echo "</td";
			echo"</tr>";
		}
	} else {
		echo"Aucune consultation trouvée.<br /><br />";
	}
	?>
</table>

