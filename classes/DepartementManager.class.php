<?php
class DepartementManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function getList(){
		$listeDepartement = array();
		$sql = "SELECT dep_num,dep_nom,vil_num FROM departement ORDER BY dep_num";
		$req = $this->db->query($sql);
		while($departement = $req->fetch(PDO::FETCH_OBJ)){
			$listeDepartement[] = new Departement($departement);
		}
		return $listeDepartement;
		$req->closeCursor();
	}
}