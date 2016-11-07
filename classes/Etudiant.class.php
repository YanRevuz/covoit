<?php
class Etudiant{
	private $PerNum ;
	private $DepNum ;
	private $DivNum ;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'per_num':
					$this->setPerNum($valeur);
					break;
				
				case 'dep_num':
					$this->setDepNum($valeur);
					break;

				case 'div_num':
					$this->setDivNum($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setPerNum($valeur){
		$this->PerNum = $valeur ;
	}

	public function setDepNum($valeur){
		$this->DepNum = $valeur ;
	}

	public function setDivNum($valeur){
		$this->DivNum = $valeur ;
	}

	public function getPerNum(){
		return $this->PerNum ;
	}

	public function getDepNum(){
		return $this->DepNum ;
	}

	public function getDivNum(){
		return $this->DivNum ;
	}
}