<?php
class Fonction{
	private $FonNum ;
	private $FonLib ;

	public function __construct($valeurs = array()){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($donnees){
		foreach ($donnees as $attribut => $valeur) {
			switch ($attribut) {
				case 'fon_num':
					$this->setFonNum($valeur);
					break;
				
				case 'fon_libelle':
					$this->setFonLib($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setFonNum($valeur){
		$this->FonNum = $valeur ;
	}

	public function setFonLib($valeur){
		$this->FonLib = $valeur ;
	}

	public function getFonNum(){
		return $this->FonNum ;
	}

	public function getFonLib(){
		return $this->FonLib ;
	}
}