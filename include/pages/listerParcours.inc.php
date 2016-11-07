<?php
	$db = new Mypdo();
	$manager = new ParcoursManager($db);
?>
<h1>Lister les parcours</h1>
<p>Actullement <?php echo $manager->getNbParcours(); ?> parcours sont enregistrés</p>
<table id="tab_parcours">
	<th>Numéro</th>
	<th>Nom Ville</th>
	<th>Nom Ville</th>
	<th>Nombre de Km</th>
<?php
	$listeParcours = $manager->getList();
	foreach ($listeParcours as $parcours) {
		echo "<tr>";
		echo "<td>".$parcours->getParcoursNum()."</td>";
		echo "<td>".$manager->getNomVille($parcours->getVilleNum1())."</td>";
		echo "<td>".$manager->getNomVille($parcours->getVilleNum2())."</td>";
		echo "<td>".$parcours->getParcoursKm()."</td>";
		echo "</tr>";
	}
?>
</table>