<?php
	$db = new Mypdo();
	$manager = new ProposeManager($db);
	$managerP = new ParcoursManager($db);
	$managerPer = new PersonneManager($db);
?>
<h1>Proposer un trajet</h1>
<?php
	if(!isset($_POST['ville_dep']) and !isset($_POST['nb_places'])){
?>
<form action="#" method="post">
	<label>Ville de départ:</label><br />
	<select class="champ" name="ville_dep">
		<?php
			$listeVillePar = $manager->getListVillePar();
			foreach ($listeVillePar as $ville) {
				echo "<option value=\"".$ville->getVilleNum()."\">";
				echo $ville->getVilleNom()."</option>";
			}
		?>
	</select><br />
	<input class="bouton" type="submit" value="Valider">
</form>
<?php
	}else if(isset($_POST['ville_dep']) and !isset($_POST['nb_places'])){
		$_SESSION['vil_dep']=$_POST['ville_dep'];
?>
<form action="#" method="post">
	<table class="AjoutPers">
		<tr><td><label>Ville de départ :</label></td><td><label><?php echo $managerP->getNomVille($_POST['ville_dep']) ?></td></label>
		<td><label>Ville d'arrivée :</label></td>
			<td><select class="champ" name="ville_arr">
				<?php
					$listeVilleParArr = $manager->getListVilleArr($_POST['ville_dep']);
					foreach ($listeVilleParArr as $ville) {
						echo "<option value=\"".$ville->getVilleNum()."\">";
						echo $managerP->getNomVille($ville->getVilleNum())."</option>";
					}
				?>
			</select></td></tr><br />
			<tr><td><label>Date de départ :</label></td>
			<td><input required class="champ" type="date" name="date" value="<?php echo date("Y-m-d");?>" /></td>
			<td><label>Heure de départ :</label></td>
			<td><input required class="champ" type="time" name="temps" step="1" value="<?php echo date("H:i:s");?>"/></td></tr><br />

			<tr><td><label>Nombre de places</label></td>
			<td><input required class="champ" type="number" name="nb_places" /></td></tr>
			<br />
	</table>
		<input class="bouton" type="submit" value="Valider" />
</form>
<?php		
	}else{
		
		$managerP->getParcours($_SESSION['vil_dep'],$_POST['ville_arr']);
		$parcours = $managerP->getParcours($_SESSION['vil_dep'],$_POST['ville_arr']);
		if ($_SESSION['vil_dep']==$parcours->getVilleNum1()){
			$sens = 0;
		}else{
			$sens = 1;
		}
		
		$propose = array('par_num'=>$parcours->getParcoursNum(),'per_num'=>$managerPer->getPersonneLogin($_SESSION['login'])->getPerNum(),
			'pro_date'=>$_POST['date'],'pro_time'=>$_POST['temps'],'pro_place'=>$_POST['nb_places'],'pro_sens'=>$sens);
		$trajet = new Propose($propose);
		$manager->add($trajet);
		echo "<p>Insertion réussie</p>";
	}
?>