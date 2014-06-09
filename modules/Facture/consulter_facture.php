<h1>Créer une Facture</h1>
<center><a href='?module=Facture&action=creer_facture'>Créer une Facture</a></center>
<br />
<h1>Consulter les Factures</h1>

<?php

foreach ($facture as $f)
{
	?>
	<a class='facture' id='facture' href='' onclick='bascul(<?php echo $f['reference']; ?>); return false;'>
		<h2>
			Facture #<?php echo $f['reference']; ?>
		</h2>
	</a>
	<div id='<?php echo $f['reference']; ?>' Style='display:none;'>
		<table>
			<tr>
				<th>Etat</th>
				<th>Montant</th>
				<th>Mode Règlement</th>
				<th>Date Règlement</th>
				<th>Date Edition</th>
				<th>Employé</th>
				<th>Animal</th>
				<th>Client</th>
			</tr>
			<tr>
				<td><?php if($f['etat']=='f') echo "Non Payée"; else echo "Payée"; ?></td>
				<td><?php echo $f['montant'] ?> €</td>
				<?php if($f['etat']=='f') {?>
				<td colspan='2'><a href='?module=Facture&action=regler_facture&facture=<?php echo $f['reference']; ?>'>Régler la Facture</a></td>
				<?php } else {?>
				<td><?php echo $f['mode_reglement'] ?></td>
				<td><?php echo $f['date_reglement'] ?></td>
				<?php } ?>
				<td><?php echo $f['date_edition'] ?></td>
				<td>0<?php echo $f['telephone_emp'] ?></td>
				<td><?php echo $f['num_dossier'] ?></td>
				<td>0<?php echo $f['telephone_pers'] ?></td>
			</tr>
		</table>
		<table>
			<tr>
				<td>~~Prestations~~</td>
				<td></td>
				<td></td>
				<td><?php if ($f['etat']=='f') echo "<a href='?module=Facture&action=ajout_prestation&facture=".$f['reference']."'><img src='./template/add.gif'></a>"; ?></td>
			</tr>
	<?php
	$prixplus=0;
	$remiseprestation = RemisePrestation::getRemisePrestation($f['reference']);
	foreach ($remiseprestation as $r)
	{
		$type = RemisePrestation::getEspeceRace($f['num_dossier']);
		if (Prestation::isConsultation($r['nom_prest'])==true)
		{
			$prix = RemisePrestation::getPrixConsultation($r['nom_prest'],$type['espece']);
		}
		else
		{
			$prix = RemisePrestation::getPrixIntervention($r['nom_prest'],$type['espece'],$type['race']);
		}
		$prixplus+=round($prix['prix']-($prix['prix']*$r['remise']/100),2);

	?>
			<tr>
				<td></td>
				<td><?php echo $r['nom_prest']; ?></td>
				<td><?php echo $r['remise']; ?> %</td>
				<td><?php echo round($prix['prix']-($prix['prix']*$r['remise']/100),2);?> €</td>
			</tr>
	<?php
	}
	?>
		<tr>
			<td></td>
			<td>Total:</td>
			<td></td>
			<td><?php echo $prixplus; ?> €</td>
		</tr>
		</table>
		<table>
			<tr>
				<td>~~Produits~~</td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php if ($f['etat']=='f') echo "<a href='?module=Facture&action=ajout_produit&facture=".$f['reference']."'><img src='./template/add.gif'></a>"; ?></td>
			</tr>
	<?php
	$achat = Achat::getAchat($f['reference']);
	$prixplus=0;
	$qttplus=0;
	foreach ($achat as $a)
	{
	$prix = Achat::MontantProduit($a['nom_produit']);
	$prixplus+=round(($prix['prix']-($prix['prix']*$a['remise']/100))*$a['quantite'],2);
	$qttplus+=$a['quantite'];
		?>
			<tr>
				<td></td>
				<td><?php echo $a['nom_produit']; ?></td>
				<td><?php echo $a['quantite']; ?></td>
				<td><?php echo $a['remise']; ?> %</td>
				<td><?php echo round(($prix['prix']-($prix['prix']*$a['remise']/100))*$a['quantite'],2);?> €</td>
			</tr>
	<?php
	}
	?>
			<tr>
				<td></td>
				<td>Total:</td>
				<td><?php echo $qttplus; ?></td>
				<td></td>
				<td><?php echo $prixplus; ?> €</td>
			</tr>
		</table>
	</div>
	<?php
}
?>


<script language="javascript" type="text/javascript">
function bascul(elem)
   {
   etat=document.getElementById(elem).style.display;
   if(etat=="none"){
   document.getElementById(elem).style.display="block";
   }
   else{
   document.getElementById(elem).style.display="none";
   }
   }
</script>

