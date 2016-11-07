<?php
class EtudiantManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function add($etudiant){
		$req = $this->db->prepare('INSERT INTO etudiant(per_num, dep_num, div_num) values (:per_num, :dep_num, :div_num);');
		$req->bindValue(':per_num',$etudiant->getPerNum(),PDO::PARAM_STR);
		$req->bindValue(':dep_num',$etudiant->getDepNum(),PDO::PARAM_STR);
		$req->bindValue(':div_num',$etudiant->getDivNum(),PDO::PARAM_STR);
		$req->execute();
	}
}