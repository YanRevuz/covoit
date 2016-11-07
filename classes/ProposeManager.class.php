<?php
class ProposeManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function add($propose){
		$req = $this->db->prepare('INSERT INTO propose(par_num,per_num,pro_date,pro_time,pro_place,pro_sens) values (:par_num,:per_num,:pro_date,:pro_time,:pro_place,:pro_sens);');
		$req->bindValue(':par_num',$propose->getParNum(),PDO::PARAM_STR);
		$req->bindValue(':per_num',$propose->getPerNum(),PDO::PARAM_STR);
		$req->bindValue(':pro_date',$propose->getProDate(),PDO::PARAM_STR);
		$req->bindValue(':pro_time',$propose->getProTime(),PDO::PARAM_STR);
		$req->bindValue(':pro_place',$propose->getProPlace(),PDO::PARAM_STR);
		$req->bindValue(':pro_sens',$propose->getProSens(),PDO::PARAM_STR);
		$req->execute();
	}

	public function getListVillePar(){
		$listeVillePar = array();
		$sql = "SELECT vil_num, vil_nom from ville where vil_num IN (SELECT vil_num1 from parcours) or vil_num IN(SELECT vil_num2 from parcours);";
		$req = $this->db->query($sql);
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listeVillePar[] = new Ville($ville);
		}
		return $listeVillePar;
		$req->closeCursor();
	}

	public function getListVilleArr($ville){
		$sql ="SELECT vil_num,vil_nom from ville v inner join parcours p on p.vil_num1=vil_num where vil_num2=".$ville." UNION SELECT vil_num, vil_nom from ville v inner join parcours p on p.vil_num2=vil_num where vil_num1=".$ville;
		$req = $this->db->query($sql);
		while($res = $req->fetch(PDO::FETCH_ASSOC)){
			$listeVillePar[] = new Ville($res);
		}
		return $listeVillePar;
		$req->closeCursor();
	}

	public function getListVilleDep(){
		$listeVillePar = array();
		$sql = "SELECT v.vil_num,vil_nom FROM VILLE v,(
    				SELECT vil_num1 as vil_num FROM parcours p
    				inner join propose pr on p.par_num = pr.par_num
    				where pr.pro_sens=0)T1
				WHERE v.vil_num=T1.vil_num
				UNION
				SELECT v.vil_num,vil_nom FROM VILLE v,(
    				SELECT vil_num2 as vil_num FROM parcours p
    				inner join propose pr on p.par_num = pr.par_num
    				where pr.pro_sens=1)T2
				WHERE v.vil_num=T2.vil_num";
		$req = $this->db->query($sql);
		while($ville = $req->fetch(PDO::FETCH_OBJ)){
			$listeVillePar[] = new Ville($ville);
		}
		return $listeVillePar;
		$req->closeCursor();
	}

	public function getListePropose($ville_dep,$ville_arr, $date, $heure, $ecart){
		$date_min = date_create($date);
		$date_max = date_create($date);
		//$date = str_replace('/', '-', $date);
		date_sub($date_min, date_interval_create_from_date_string($ecart."day"));
		date_add($date_max, date_interval_create_from_date_string($ecart."day"));
		$date_min = date_format($date_min, 'Y-m-d');
		$date_max = date_format($date_max, 'Y-m-d');
		$sql = "SELECT vil_num1, vil_num2, pro_date, pro_time, pro_place, per_num from parcours pr 
		INNER JOIN propose p on p.par_num = pr.par_num
		WHERE ((vil_num1=$ville_dep and vil_num2=$ville_arr and pro_sens=1) or (vil_num2=$ville_dep and vil_num1=$ville_arr and pro_sens=0))
		and pro_time > $heure and pro_date BETWEEN \"$date_min\" and \"$date_max\" ;";
		$req = $this->db->query($sql);
		while($res = $req->fetch(PDO::FETCH_ASSOC)){
			$listePropose[] = $res;
		}
		if(isset($listePropose)){
			return $listePropose;
		}else{
			return null;
		}
		
		$req->closeCursor();
	}
}