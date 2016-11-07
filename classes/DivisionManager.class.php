<?php
class DivisionManager{

	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function getList(){
		$listeDivision = array();
		$sql = "SELECT div_num,div_nom FROM division ORDER BY div_num";
		$req = $this->db->query($sql);
		while($division = $req->fetch(PDO::FETCH_OBJ)){
			$listeDivision[] = new Division($division);
		}
		return $listeDivision;
		$req->closeCursor();
	}
}