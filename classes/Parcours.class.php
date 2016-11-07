<?php
class Parcours{
	private $ParcoursNum;
	private $ParcoursKm;
	private $VilleNum1;
	private $VilleNum2;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'par_num':
					$this->setParcoursNum($valeur);
					break;
				
				case 'par_km':
					$this->setParcoursKm($valeur);
					break;

				case 'vil_num1':
					$this->setVilleNum1($valeur);
					break;

				case 'vil_num2':
					$this->setVilleNum2($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setParcoursNum($ParcoursNum){
		$this->ParcoursNum = $ParcoursNum;
	}

	public function setParcoursKm($ParcoursKm){
		$this->ParcoursKm = $ParcoursKm;
	}

	public function setVilleNum1($VilleNum1){
		$this->VilleNum1 = $VilleNum1;
	}

	public function setVilleNum2($VilleNum2){
		$this->VilleNum2 = $VilleNum2;
	}

	public function getParcoursNum(){
		return $this->ParcoursNum;
	}

	public function getParcoursKm(){
		return $this->ParcoursKm;
	}

	public function getVilleNum1(){
		return $this->VilleNum1;
	}

	public function getVilleNum2(){
		return $this->VilleNum2;
	}
}
?>