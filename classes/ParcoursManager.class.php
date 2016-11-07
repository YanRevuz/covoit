<?php
class ParcoursManager{
	private $db;

	public function __construct($db){
		$this->db = $db ;
	}

	public function add($parcours){
		$req = $this->db->prepare('INSERT INTO parcours(par_km,vil_num1,vil_num2) values (:par_km,:vil_num1,:vil_num2);');
		$req->bindValue(':par_km',$parcours->getParcoursKm(),PDO::PARAM_STR);
		$req->bindValue(':vil_num1',$parcours->getVilleNum1(),PDO::PARAM_STR);
		$req->bindValue(':vil_num2',$parcours->getVilleNum2(),PDO::PARAM_STR);
		$req->execute();
	}

	public function verif_exist($ville1,$ville2){
		$sql = "SELECT * FROM PARCOURS WHERE vil_num1=".$ville1." and vil_num2=".$ville2.";";
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getList(){
		$listeParcours = array();
		$sql = "SELECT par_num,vil_num1,vil_num2,par_km FROM Parcours ORDER BY par_num";
		$req = $this->db->query($sql);
		while($parcours = $req->fetch(PDO::FETCH_OBJ)){
			$listeParcours[] = new Parcours($parcours);
		}
		return $listeParcours;
		$req->closeCursor();
	}

	public function getNomVille($ville){
		$sql = "SELECT vil_nom FROM ville where vil_num=".$ville.";";
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result['vil_nom'];
	}

	public function getNbParcours(){
		$sql = "SELECT count(*) as nb_parcours FROM parcours" ;
		$req = $this->db->query($sql);
		$result = $req->fetch(PDO::FETCH_ASSOC);
		return $result['nb_parcours'];
	}

	public function getParcours($ville1, $ville2){
		$sql = "SELECT * from parcours where (vil_num1=".$ville1." and vil_num2=".$ville2.") or (vil_num1=".$ville2." and vil_num2=".$ville1.");";
		$req = $this->db->query($sql);
		$res = $req->fetch(PDO::FETCH_OBJ);
		$parcours = new Parcours($res);
		return $parcours;
	}
}
?>