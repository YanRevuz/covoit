<?php
	$db = new Mypdo();
	$manager = new VilleManager($db);
	if(!isset($_POST['ville'])){
?>

<h1>Ajouter une ville</h1>
<form action="#" method="post">
	<label>Nom :</label>
	<input class="champ" type="text" name="ville">
	<input class="bouton" type="submit" value="Valider">
</form>

<?php
	}else{
		//echo "Bonjour Requete";
		$VilleNom = $_POST['ville'];
		$Ville = new Ville(array('vil_nom' => $VilleNom));
		$manager->add($Ville);
		echo "<p>La ville a été insérée</p>";
	};
?>