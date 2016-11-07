<?php
class SalarieManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function add($salarie){
		$req = $this->db->prepare('INSERT INTO salarie(per_num, sal_telprof, fon_num) values (:per_num, :sal_telprof, :fon_num);');
		$req->bindValue(':per_num',$salarie->getPerNum(),PDO::PARAM_STR);
		$req->bindValue(':sal_telprof',$salarie->getSalTel(),PDO::PARAM_STR);
		$req->bindValue(':fon_num',$salarie->getFonNum(),PDO::PARAM_STR);
		$req->execute();
	}
}