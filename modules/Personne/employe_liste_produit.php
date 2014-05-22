<?php 
	echo("<h1>Liste des produits</h1>");
?>

<?php
	if(!empty($liste_produits)) {
?>
<h2>Produits</h2>
<table border=1 id="table">
	<tr>
		<th>Nom</th>
		<th>Stock</th>
		<th>Prix</th>
		<th>Medicament</th>
		<th>Modifier</th>
	</tr>
	<?php
		foreach($liste_produits as $produit) {
			echo"<tr>";
				echo"<td>".$produit['nom']."</td>";
				echo"<td>"; 
				if (empty($produit['stock'])) 
					echo "A definir...";
				else {	
					// attention stock !
					if ($produit['stock'] < 10) { 
						echo "<b>".$produit['stock']."</b>";
					} else {
						echo $produit['stock'];
					}
				}
				echo "</td>";
				echo"<td>"; 
				if (empty($produit['prix'])) 
					echo "A definir..."; 
				else 	
					 echo $produit['prix'];
				echo "</td>";
				echo"<td>"; 
				if (Produit::isMedicament($produit['nom'])) {
					echo "Oui"; 
				} else {
					echo "Non";
				}
				echo"</td>"; 
				echo "<td>";
					echo "<a href='?module=Personne&action=modifier_produit&nom={$produit['nom']}'><img src='template/edit.png' title='Modifier un produit'/></a>";
				echo "</td";
			echo"</tr>";
		}
	} else {
		echo"Aucun produit trouvé.<br /><br />";
	}
	?>
</table>

<br/>