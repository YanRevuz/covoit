<?php
class Salarie{
	private $PerNum ;
	private $SalTel ;
	private $FonNum ;

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
				
				case 'sal_telprof':
					$this->setSalTel($valeur);
					break;

				case 'fon_num':
					$this->setFonNum($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setPerNum($valeur){
		$this->PerNum = $valeur ;
	}

	public function setSalTel($valeur){
		$this->SalTel = $valeur ;
	}

	public function setFonNum($valeur){
		$this->FonNum = $valeur ;
	}

	public function getPerNum(){
		return $this->PerNum;
	}

	public function getSalTel(){
		return $this->SalTel;
	}

	public function getFonNum(){
		return $this->FonNum;
	}
}