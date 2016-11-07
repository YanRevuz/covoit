<h1>Pour vous connecter</h1>
<?php
	$db = new Mypdo();
	$manager = new PersonneManager($db); 
	if(empty($_POST['nom']) or empty($_POST['motdepasse']) or empty($_POST['numero'])){
?>
<form action="#" method="post">
	<label>Nom d'utilisateur :</label><br />
	<input class="champ" type="text" name="nom" required><br />

	<label>Mot de passe</label><br />
	<input class="champ" type="password" name="motdepasse" required><br />

	<?php
		$img1 = rand(1,9);
		$img2 = rand(1,9);
		$_SESSION['total'] = $img1 + $img2 ;
		echo "<img src=\"../covoit/image/nb/".$img1.".jpg\"alt=\"img1\"><label> + </label><img src=\"../covoit/image/nb/".$img2.".jpg\"alt=\"img2\"><label>=</label><br />";
	?>
	<input class="champ" type="number" name="numero"><br />
	<input class="bouton" type="submit" value="Valider"><br />
</form>
<?php
	}else{
		if($_SESSION['total']!=$_POST['numero']){
			echo "<p>La somme est incorrecte</p>";
		}else{
			$salt = "48@!alsd";
			$mdpCrypt = sha1(sha1($_POST['motdepasse']).$salt);
			if($manager->verifConnexion($_POST['nom'],$mdpCrypt)){
				//echo "<p>Bonjour ".$_POST['nom']."</p>";
				$_SESSION['login'] = $_POST['nom'];
				header('Location: index.php');
			}else{
				echo "<p>Erreur lors de la connexion</p>";
			}
		}
	}
?>