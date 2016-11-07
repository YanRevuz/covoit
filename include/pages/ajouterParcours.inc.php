<?php
	$db = new Mypdo();
	$manager = new ParcoursManager($db);
	$managerV = new VilleManager($db);
	if(!isset($_POST['ville1']) and !isset($_POST['ville2']) and !isset($_POST['nb_km'])){
?>
<h1>Ajouter un parcours</h1>
<form action="#" method="post">
	<label>Ville 1:</label>
	<select name="ville1">
		<?php
			$listeVille = $managerV->getList();
			foreach ($listeVille as $ville) {
				echo "<option value=\"".$ville->getVilleNum()."\">";
				echo $ville->getVilleNom()."</option>";
			}
		?>
	</select>

	<label>Ville 2:</label>
	<select name="ville2">
		<?php
			$listeVille = $managerV->getList();
			foreach ($listeVille as $ville) {
				echo "<option value=\"".$ville->getVilleNum()."\">";
				echo $ville->getVilleNom()."</option>";
			}
		?>
	</select>
	<label>Nombre de kilomètre(s)
	<input class="champ" type="number" name="nb_km" required /><br />
	<input class="bouton" type="submit" value="Valider" />
</form>
<?php
	}else if($_POST['ville1'] == $_POST['ville2']){
		echo "<p>Les villes ne peuvent pas être les mêmes.</p>";
	}else{
		$Ville1 = $_POST['ville1'];
		$Ville2 = $_POST['ville2'];
		$Km = $_POST['nb_km'];
		if($manager->verif_exist($Ville1,$Ville2) or $manager->verif_exist($Ville2,$Ville1)){
			echo "<p>Le parcours existe déjà.</p>";
		}else{
			$Parcours = new Parcours(array('vil_num1' => $Ville1,'vil_num2' => $Ville2,'par_km' => $Km));
			$manager->add($Parcours);
			echo "<p>Le parcours a bien été inséré.</p>";
		}
	}
	
?>