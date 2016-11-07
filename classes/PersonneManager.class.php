<?php
class PersonneManager{

	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function add($personne){
		$req = $this->db->prepare('INSERT INTO personne(per_nom,per_prenom,per_tel,per_mail,per_login,per_pwd) values (:per_nom,:per_prenom,:per_tel,:per_mail,:per_login,:per_pwd);');
		$req->bindValue(':per_nom',$personne->getPerNom(),PDO::PARAM_STR);
		$req->bindValue(':per_prenom',$personne->getPerPrenom(),PDO::PARAM_STR);
		$req->bindValue(':per_tel',$personne->getPerTel(),PDO::PARAM_STR);
		$req->bindValue(':per_mail',$personne->getPerMail(),PDO::PARAM_STR);
		$req->bindValue(':per_login',$personne->getPerLogin(),PDO::PARAM_STR);
		$req->bindValue(':per_pwd',$personne->getPerPwd(),PDO::PARAM_STR);
		$req->execute();
	}

	public function getLastPers(){
		$sql = "SELECT per_num FROM personne order by per_num desc limit 1";
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result['per_num'];
	}

	public function getList(){
		$listePersonne = array();
		$sql = "SELECT per_num, per_nom, per_prenom, per_tel, per_mail, per_login FROM personne";
		$req = $this->db->query($sql);
		while($personne = $req->fetch(PDO::FETCH_OBJ)){
			$listePersonne[] = new Personne($personne);
		}
		return $listePersonne;
		$req->closeCursor();
	}

	public function estEtu($id){
		$sql = "SELECT per_num FROM etudiant where per_num=".$id.";";
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result['per_num'];
	}

	public function getPersonne($id){
		if($this->estEtu($id)){
			$sql = "SELECT per_nom, per_prenom, per_mail, per_tel, dep_nom, vil_nom FROM personne p
			INNER JOIN etudiant e on p.per_num=e.per_num
			INNER JOIN departement d on d.dep_num=e.dep_num
			INNER JOIN ville v on d.vil_num=v.vil_num
			WHERE p.per_num=".$id.";";
		}else{
			$sql = "SELECT per_nom, per_prenom, per_mail, per_tel, sal_telprof, fon_libelle FROM personne p
			INNER JOIN salarie s on p.per_num=s.per_num
			INNER JOIN fonction f on s.fon_num=f.fon_num
			WHERE p.per_num=".$id.";";
		}
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function verifConnexion($login,$mdp){
		$sql = "SELECT per_login from personne where per_login=\"".$login."\" and per_pwd=\"".$mdp."\";";
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		if(empty($result)){
			return false;
		}else{
			return true;
		}
	}

	public function getPersonneLogin($login){
		$sql = "SELECT * from personne where per_login=\"".$login."\";";
		$req = $this->db->query($sql);
		$res = $req->fetch(PDO::FETCH_OBJ);
		$personne = new Personne($res);
		return $personne;
	}
}