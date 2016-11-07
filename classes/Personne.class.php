<?php
class Personne{
	private $PerNum ;
	private $PerNom;
	private $PerPrenom;
	private $PerTel;
	private $PerMail;
	private $PerLogin;
	private $PerPwd;

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

				case 'per_nom':
					$this->setPerNom($valeur);
					break;
				
				case 'per_prenom':
					$this->setPerPrenom($valeur);
					break;

				case 'per_tel':
					$this->setPerTel($valeur);
					break;

				case 'per_mail':
					$this->setPerMail($valeur);
					break;

				case 'per_login':
					$this->setPerLogin($valeur);
					break;

				case 'per_pwd':
					$this->setPerPwd($valeur);
					break;

				default:
					break;
			}
		}
	}

	public function setPerNum($valeur){
		$this->PerNum = $valeur ;
	}

	public function setPerNom($valeur){
		$this->PerNom = $valeur ;
	}

	public function setPerPrenom($valeur){
		$this->PerPrenom = $valeur ;
	}

	public function setPerTel($valeur){
		$this->PerTel = $valeur ;
	}

	public function setPerMail($valeur){
		$this->PerMail = $valeur ;
	}

	public function setPerLogin($valeur){
		$this->PerLogin = $valeur ;
	}

	public function setPerPwd($valeur){
		$this->PerPwd = $valeur ;
	}

	public function getPerNum(){
		return $this->PerNum;
	}

	public function getPerNom(){
		return $this->PerNom;
	}

	public function getPerPrenom(){
		return $this->PerPrenom;
	}

	public function getPerTel(){
		return $this->PerTel;
	}

	public function getPerMail(){
		return $this->PerMail;
	}

	public function getPerLogin(){
		return $this->PerLogin;
	}

	public function getPerPwd(){
		return $this->PerPwd;
	}

}