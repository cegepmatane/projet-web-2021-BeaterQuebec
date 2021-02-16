<?php

class Membre
{
	public static $filtres = 
		array(
			'id' => FILTER_VALIDATE_INT,
			'pseudonyme' => FILTER_SANITIZE_ENCODED,
			'nom' => FILTER_SANITIZE_ENCODED,
			'prenom' => FILTER_SANITIZE_ENCODED,
            'email' => FILTER_SANITIZE_STRING,
            'admin' => FILTER_VALIDATE_INT,
			'motDePasse' => FILTER_SANITIZE_ENCODED
		);
		
	protected $pseudonyme;
	protected $nom;
	protected $prenom;
    protected $email;
    protected $admin;
    protected $motDePasse;
	
	public function __construct($tableau)
	{
        if (is_array($tableau)){
		  $tableau = filter_var_array($tableau, Membre::$filtres);   
        

		$this->id = $tableau['id'];
		$this->pseudonyme = $tableau['pseudonyme'];
		$this->nom = $tableau['nom'];
		$this->prenom = $tableau['prenom'];
        $this->email = $tableau['email'];
        $this->admin = $tableau['admin'];
        $this->motDePasse = $tableau['motDePasse'];
		}
	}
	
	public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'pseudonyme':
				$this->pseudonyme = $valeur;
			break;
			case 'email':
				$this->email = $valeur;
			break;
			case 'nom':
				$this->nom = $valeur;
			break;
			case 'prenom':
				$this->prenom = $valeur;
			break;
			case 'motDePasse':
				$this->motDePasse = $valeur;
            break;
            case 'admin':
				$this->admin = $valeur;
            break;
		}
	}

	public function __get($propriete)
	{
		$self = get_object_vars($this);
		return $self[$propriete];
	}	
}
?>