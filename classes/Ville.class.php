<?php
class Ville{
	private $VilleNum;
	private $VilleNom;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'vil_num':
					$this->setVilleNum($valeur);
					break;
				
				case 'vil_nom':
					$this->setVilleNom($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setVilleNum($VilleNum){
		$this->VilleNum = $VilleNum;
	}

	public function setVilleNom($VilleNom){
		$this->VilleNom = $VilleNom;
	}

	public function getVilleNum(){
		return $this->VilleNum;
	}

	public function getVilleNom(){
		return $this->VilleNom;
	}		
}
?>