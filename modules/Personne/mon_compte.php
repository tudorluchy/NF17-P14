
<div id="moncompte">
	<h1> <?php echo($_SESSION['user']->prenom . " " . $_SESSION['user']->nom) ?></h1>  
	<li><a href="?module=Personne&action=modification_compte">Modifier mes informations personnelles</a></li>
	<h2>Mes Animaux : </h2>
	
	
	<?php 
	
		if (!empty($animal)) {
		?>
		<table>
			<tr>
			<th> Nom </th>
			<th> Poids </th>
			<th> Taille </th>
			<th> Genre </th>
			<th> Date de naissance </th>
			<th> Race </th>
			<th> Espèce </th>
			<th> </th>
			<th> </th>
		</tr>
		<?php
			var_dump($animal);
			foreach ($animal as $a) {
			echo("<tr><td>".$a['nom']."</td><td>".$a['poids']."</td><td>".$a['taille']."</td><td>".$a['genre']."</td><td>".$a['date_naiss']."</td><td>".$a['race']."</td><td>".$a['espece']."</td><td><div id='modifier'><a href='?module=Animal&action=modifier&animal=$a->num_dossier'><img src='template/icone_modifier.png'/></a></div></td><td><div id='supprimer'><a href='?module=Animal&action=supprimer&animal=$a->num_dossier'><img src='template/icone_supprimer.png'/></a></div></td></tr>"); 
			
			}?>
		
	</table>
		<?php
		}
		else
			echo("Vous n'avez pas encore enregistré d'animaux.");
		?>
		
		
		
	<h2>Mes Factures : </h2>
		<?php 
	
		if (!empty	($facture)) {
	?>
	<table>
		<tr>
			<th> Référence </th>
			<th> montant </th>
			<th> Mode Reglement </th>
			<th> Date de Reglement </th>
			<th> Date edition</th>
			<th> Telephone Employé</th>
			<th> N°Dossier</th> 
			<th></th>
		</tr>
		<?php
			foreach ($facture as $f) 
				echo("<tr><td>$f->reference</td><td>$f->montant €</td><td>$f->mode_reglement</td><td>$f->date_reglement</td><td>$f->date_edition</td><td>$f->telephone_emp</td><td>$f->num_dossier</td><td><a href='?module=facture&action=detail&reference=$f->reference'>Détail</a></td></tr>"); 
			
			?>
		
	</table>
		<?php
		}
		else
			echo("Vous n'avez pas encore effectué d'achat.");
		?>
			
</div>
