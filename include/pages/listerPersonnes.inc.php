<?php
	$db = new Mypdo();
	$manager = new PersonneManager($db);
?>
<!-- Demander pour pouvoir rendre le http://localhost dynamique -->
<?php
	if(!isset($_GET['id'])){
?>
	<h1>Lister les personnes</h1>
	<table id="tab_personne">
		<th>Numéro</th>
		<th>Nom</th>
		<th>Prénom</th>
	<?php
		$listePersonne = $manager->getList();
		foreach ($listePersonne as $personne) {
			echo "<tr>";
			echo "<td><a href=\"index.php?page=2&id=".$personne->getPerNum()."\">".$personne->getPerNum()."</a></td>";
			echo "<td>".$personne->getPerNom()."</td>";
			echo "<td>".$personne->getPerPrenom()."</td>";
			echo "</tr>";
		}
	?>
	</table>
<?php
	}else{
		$personne = $manager->getPersonne($_GET['id']);
		echo "<table>" ;
		if($manager->estEtu($_GET['id'])){
			echo "<h1>Détails sur l'étudiant ".$personne['per_nom']."</h1>";
			echo "<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>";
			echo "<tr>";
			echo "<td>".$personne['per_prenom']."</td>";
			echo "<td>".$personne['per_mail']."</td>";
			echo "<td>".$personne['per_tel']."</td>";
			echo "<td>".$personne['dep_nom']."</td>";
			echo "<td>".$personne['vil_nom']."</td>";
			echo "</tr>";
		}else{
			echo "<h1>Détails sur le salarié ".$personne['per_nom']."</h1>";
			echo "<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr>";
			echo "<tr>";
			echo "<td>".$personne['per_prenom']."</td>";
			echo "<td>".$personne['per_mail']."</td>";
			echo "<td>".$personne['per_tel']."</td>";
			echo "<td>".$personne['sal_telprof']."</td>";
			echo "<td>".$personne['fon_libelle']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
?>
			