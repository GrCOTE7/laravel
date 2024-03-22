<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Php;

class Person
{
	// Constantes
	public const NUMBER_OF_ARMS  = 2;
	public const NUMBER_OF_LEGS  = 2;
	public const NUMBER_OF_EYES  = 2;
	public const NUMBER_OF_FEET  = 2;
	public const NUMBER_OF_HANDS = 2;

	// Attributs
	public $name;

	public $lastname;

	public $dateOfBirth;

	public $height;

	public $sex;

	public $infos;

	// Méthodes
	public function __construct()
	{
	}

	public function __toString()
	{
		return "Nom : {$this->name}<br>
        Prénom : {$this->lastname}<br>
        Date de naissance : {$this->dateOfBirth}<br>
        Taille : {$this->height} - Sexe : {$this->sex}<br>
        Infos :<ul><li>" . join('<li>', $this->infos) . '</li></ul>';
	}

	public function drink(): string
	{
		return 'La personne boit.';
	}

	public function eat(): string
	{
		return 'La personne mange.';
	}
}
