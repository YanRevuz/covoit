<?php
class Division{
	private $div_num;
	private $div_nom;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'div_num':
					$this->setDivNum($valeur);
					break;
				
				case 'div_nom':
					$this->setDivNom($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setDivNum($valeur){
		$this->div_num = $valeur ;
	}

	public function setDivNom($valeur){
		$this->div_nom = $valeur ;
	}

	public function getDivNum(){
		return $this->div_num ;
	}

	public function getDivNom(){
		return $this->div_nom ;
	}
}