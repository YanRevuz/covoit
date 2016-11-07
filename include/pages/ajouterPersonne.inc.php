<?php
	$db = new Mypdo();
	$managerP = new PersonneManager($db);
	$managerDiv = new DivisionManager($db);
	$managerDep = new DepartementManager($db);
	$managerEtu = new EtudiantManager($db);
	$managerFon = new FonctionManager($db);
	$managerSal = new SalarieManager($db);

	if(!isset($_POST['nom']) and !isset($_POST['prenom']) and !isset($_POST['telPersonne']) and !isset($_POST['mail']) and !isset($_POST['login']) and !isset($_POST['motdepasse']) and !isset($_POST['categorie']) and !isset($_POST['division']) and !isset($_POST['departement']) and !isset($_POST['telPersonnePro'])and !isset($_POST['fonction'])){
?>
<h1>Ajouter une personne</h1>
<form action="#" method="post">
	<table class="AjoutPers">
		<tr>
			<td><label>Nom :</label></td><td><input class="champ" type="text" name="nom" required></td>
			<td><label>Prénom :</label></td><td><input class="champ" type="text" name="prenom" required><br /></td>
		</tr>
		<tr>
			<td><label>Téléphone :</label></td><td><input class="champ" type="text" name="telPersonne" required pattern="(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d).{10}" title="Le format requis est 0000000000"/></td>
			<td><label>Mail :</label></td><td><input class="champ" type="email" name="mail" required><br /></td>
		</tr>
		<tr>
			<td><label>Login</label></td><td><input class="champ" type="text" name="login" required></td>
			<td><label>Mot de passe :</label></td><td><input class="champ" type="password" name="motdepasse" required><br /></td>
		</tr>
	</table>
	<label>Catégorie :</label>
	<input class="radio" type="radio" name="categorie" value="etudiant" checked><label>Étudiant</label>
	<input class="radio" type="radio" name="categorie" value="personnel"><label>Personnel</label><br />
	<input class="bouton" type="submit" value="Valider">
</form>
<?php
	}else if(isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['telPersonne']) and isset($_POST['mail']) and isset($_POST['login']) and isset($_POST['motdepasse']) and isset($_POST['categorie'])){

		$salt = "48@!alsd";
		$mdpCrypt = sha1(sha1($_POST['motdepasse']).$salt);
		$personne = new Personne(array('per_nom'=>$_POST['nom'],'per_prenom'=>$_POST['prenom'],'per_tel'=>$_POST['telPersonne'],'per_mail'=>$_POST['mail'],'per_login'=>$_POST['login'],'per_pwd'=>$mdpCrypt));
		$managerP->add($personne);
		if($_POST['categorie']=='etudiant'){
?>
<h1>Ajouter un étudiant</h1>
<form action="#" method="post">
	<label>Année :</label>
	<select name="division">
		<?php
			$listeDivision = $managerDiv->getList();
			foreach ($listeDivision as $division) {
				echo "<option value=\"".$division->getDivNum()."\">".$division->getDivNom()."</option>" ;
			}
		?>
	</select><br />
	<label>Département :</label>
	<select name="departement">
		<?php
			$listeDepartement = $managerDep->getList();
			foreach ($listeDepartement as $departement) {
				echo "<option value=\"".$departement->getDepNum()."\">".$departement->getDepNom()."</option>" ;
			}
		?>
	</select><br />
	<input class="bouton" type="submit" value="Valider">
</form>
<?php
		}else{
?>
<h1>Ajouter un salarié</h1>
<form action="#" method="post">
	<label>Téléphone professionnel :</label>
	<input class="champ" type="text" name="telPersonnePro" required pattern="(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d)(?=.*\d).{10}" title="Le format requis est 0000000000"/>
	<label>Fonction :</label>
	<select name="fonction">
		<?php
			$listeFonction = $managerFon->getList();
			foreach ($listeFonction as $fonction) {
				echo "<option value=\"".$fonction->getFonNum()."\">".$fonction->getFonLib()."</option>" ;
			}
		?>
	</select><br />
	<input class="bouton" type="submit" value="Valider">
</form>
<?php
		}
	}else if(isset($_POST['division']) and isset($_POST['departement']) and !isset($_POST['fonction']) and !isset($_POST['categorie'])){
		$etudiant = New Etudiant(array('per_num'=>$managerP->getLastPers(),'div_num'=>$_POST['division'],'dep_num'=>$_POST['departement']));
		$managerEtu->add($etudiant);
		echo "<p>L'étudiant a bien été ajouté</p>";
	}else if(!isset($_POST['division']) and !isset($_POST['departement']) and isset($_POST['fonction']) and empty($_POST['categorie'])){
		$salarie = New Salarie(array('per_num'=>$managerP->getLastPers(),'sal_telprof'=>$_POST['telPersonnePro'],'fon_num'=>$_POST['fonction']));
		$managerSal->add($salarie);
		echo "<p>Le salarié a bien été ajouté</p>";
	}else{
		echo "<p>Merci de remplir de remplir le formulaire";
	}
?>