<?php
class VilleManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function add($ville){
		$req = $this->db->prepare('INSERT INTO ville(vil_nom) values (:vil_nom);');
		$req->bindValue(':vil_nom',$ville->getVilleNom(),PDO::PARAM_STR);
		$req->execute();
	}

	public function getList(){
		$listeVilles = array();
		$sql = "SELECT vil_num, vil_nom FROM ville ORDER BY vil_nom";
		$req = $this->db->query($sql);
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listeVilles[] = new Ville($ville);
		}
		return $listeVilles;
		$req->closeCursor();
	}

	public function getNbVilles(){
		$sql = "SELECT count(*) as nb_villes FROM ville" ;
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result['nb_villes'];
	}
}
?>