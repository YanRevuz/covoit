<?php
	$db = new Mypdo();
	$manager = new ProposeManager($db);
	$managerP = new ParcoursManager($db);
	$managerPersonne = new PersonneManager($db);
?>
<h1>Rechercher un trajet</h1>
<?php
	if(!isset($_POST['ville_dep']) and !isset($_POST['ville_arr'])){
?>
<form action="#" method="post">
	<label>Ville de départ:</label><br />
	<select class="champ" name="ville_dep">
		<?php
			$listeVilleDep = $manager->getListVilleDep();
			foreach ($listeVilleDep as $ville) {
				echo "<option value=\"".$ville->getVilleNum()."\">";
				echo $ville->getVilleNom()."</option>";
			}
		?>
	</select><br />
	<input class="bouton" type="submit" value="Valider">
</form>
<?php
	}else if(isset($_POST['ville_dep']) and !isset($_POST['ville_arr'])){
		$_SESSION['ville_dep']=$_POST['ville_dep'];
?>
<form action="#" method="post">
	<table class="AjoutPers">
		<tr>
			<td>
				<label>Ville de départ :</label>
			</td>
			<td>
				<?php echo $managerP->getNomVille($_POST['ville_dep']) ?>
			</td>
			<td>
				<label>Ville d'arrivée :</label>
			</td>
			<td>
				<select class="champ" name="ville_arr">
					<?php
						$listeVilleArr = $manager->getListVilleArr($_POST['ville_dep']);
						foreach ($listeVilleArr as $ville) {
							echo "<option value=\"".$ville->getVilleNum()."\">";
							echo $ville->getVilleNom()."</option>";
						}
					?>
				</select><br />
			</td>
		</tr>
		<tr>
			<td>
				<label>Date de départ :</label>
			</td>
			<td>
				<input required class="champ" type="date" name="date" value="<?php echo date("Y-m-d");?>" />
			</td>
			<td>
				<label>Précision :</label>
			</td>
			<td>
				<select class="champ" name="precision">
					<option value="0">Ce jour</option>
					<option value="1">+/- 1 jour</option>
					<option value="2">+/- 2 jours</option>
					<option value="3">+/- 3 jours</option>
				</select>
			</td>
		</tr>
		<tr>	
			<td>
				<label>A partir de : </label>
			</td>
			<td>
				<select class="champ" name="heure">
					<?php
						for($i = 0; $i < 25; $i++){
							echo "<option value=\"".$i."\">".$i."h</option>";
						}
					?>
				</select>
			</td>
		</tr>

	</table>
	<input class="bouton" type="submit" value="Valider" />
</form>
<?php
	}else{
		if($manager->getListePropose($_SESSION['ville_dep'],$_POST['ville_arr'],$_POST['date'],$_POST['heure'],$_POST['precision'])!= null){
?>

	<table>
		<tr>
			<th>Ville départ</th>
			<th>Ville arrivée</th>
			<th>Date départ</th>
			<th>Heure départ</th>
			<th>Nombre de place</th>
			<th>Nom du covoitureur</th>
		</tr>
		<?php
			$listePropose = $manager->getListePropose($_SESSION['ville_dep'],$_POST['ville_arr'],$_POST['date'],$_POST['heure'],$_POST['precision']);
			foreach ($listePropose as $propose) {
				echo "<tr>";
				echo "<td>".$managerP->getNomVille($propose['vil_num1'])."</td>";
				echo "<td>".$managerP->getNomVille($propose['vil_num2'])."</td>";
				echo "<td>".str_replace('-', '/', date("d-m-Y", strtotime($propose['pro_date'])))."</td>";
				echo "<td>".$propose['pro_time']."</td>";
				echo "<td>".$propose['pro_place']."</td>";
				$personne = $managerPersonne->getPersonne($propose['per_num']);
				$personne = new Personne($personne);
				echo "<td><a>".$personne->getPerPrenom()." ".$personne->getPerNom()."</a></td>";
				echo "</tr>";
			}
		?>
	</table>

<?php
		}else{
			echo "<p><img style=\"vertical-align:middle;\" src=\"../covoit/image/erreur.png\"> <b>Désolé, pas de trajet disponible !</b></p>" ;
		}
		
	}
?>