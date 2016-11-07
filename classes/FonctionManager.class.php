<?php
class FonctionManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function getList(){
		$listeFonctions = array();
		$sql = "SELECT fon_num, fon_libelle FROM fonction ORDER BY fon_num";
		$req = $this->db->query($sql);
		while($fonction = $req->fetch(PDO::FETCH_OBJ)){
			$listeFonctions[] = new Fonction($fonction);
		}
		return $listeFonctions;
		$req->closeCursor();
	}

}