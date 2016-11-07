<?php
	$db = new Mypdo();
	$manager = new VilleManager($db);
?>
<h1>Lister les villes</h1>
<p>Actullement <?php echo $manager->getNbVilles(); ?> ville(s) sont enregistrées</p>
<table id="tab_ville">
	<th>Numéro</th>
	<th>Nom</th>
<?php
	$listeVille = $manager->getList();
	foreach ($listeVille as $ville) {
		echo "<tr>";
		echo "<td>".$ville->getVilleNum()."</td>";
		echo "<td>".$ville->getVilleNom()."</td>";
		echo "</tr>";
	}
?>
</table>
