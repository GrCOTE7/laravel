<?php

namespace App\Http\Tutos;

class Personne
{
	// Constantes
	public const NOMBRE_DE_BRAS   = 2;
	public const NOMBRE_DE_JAMBES = 2;
	public const NOMBRE_DE_YEUX   = 2;
	public const NOMBRE_DE_PIEDS  = 2;
	public const NOMBRE_DE_MAINS  = 2;

	// Attributs
	public $nom;

	public $prenom;

	public $dateDeNaissance;

	public $taille;

	public $sexe;

	// Méthodes
	public function __construct()
	{
	}

	public function boire()
	{
		echo 'La personne boit<br/>';
	}

	public function manger()
	{
		echo 'La personne mange<br/>';
	}
}
