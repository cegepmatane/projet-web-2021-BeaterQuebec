<?php

class Voiture
{
	public static $filtres = 
		array(
			'id' => FILTER_VALIDATE_INT,
			'marque' => FILTER_SANITIZE_ENCODED,
			'modele' => FILTER_SANITIZE_ENCODED,
			'annee' => FILTER_SANITIZE_ENCODED,
			'description' => FILTER_SANITIZE_ENCODED,
			'prix' => FILTER_SANITIZE_ENCODED,
            'kilometrages' => FILTER_SANITIZE_ENCODED,
            'image' => FILTER_SANITIZE_ENCODED
		);
		
	protected $marque;
	protected $modele;
	protected $annee;
	protected $description;
	protected $prix;
	protected $kilometrages;
    protected $image;
	
	public function __construct($tableau)
	{
        if (is_array($tableau)){
		  $tableau = filter_var_array($tableau, Voiture::$filtres); 
        }

		$this->id = $tableau['id'];
		$this->marque = $tableau['marque'];
		$this->modele = $tableau['modele'];
		$this->annee = $tableau['annee'];
		$this->description = $tableau['description'];
		$this->prix = $tableau['prix'];
		$this->kilometrages = $tableau['kilometrages'];
        $this->image = $tableau['image'];
	}
	
	public function __set($propriete, $valeur)
	{
		switch($propriete)
		{
			case 'id':
				$this->id = $valeur;
			break;
			case 'marque':
				$this->marque = $valeur;
			break;
			case 'modele':
				$this->modele = $valeur;
			break;
			case 'annee':
				$this->annee = $valeur;
			break;
			case 'description':
				$this->description = $valeur;
			break;
			case 'prix':
				$this->prix = $valeur;
            break;
            case 'kilometrages':
				$this->kilometrages = $valeur;
			break;
            case 'image':
				$this->image = $valeur;
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