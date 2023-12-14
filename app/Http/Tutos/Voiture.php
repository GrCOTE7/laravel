<?php

namespace App\Http\Tutos;

class Voiture extends Vehicule
{
	// Attributs
	private $_volumeCarburant;

	// Constructeur
	public function __construct($marque)
	{
		// Appel du constructeur de la classe parente
		parent::__construct($marque);
		$this->_volumeCarburant = 40;
	}

	// Démarre la voiture si le réservoir
	// n'est pas vide
	public function demarrer()
	{
		if ($this->_controlerVolumeCarburant()) {
			echo 'Le véhicule ' . $this->_marque . ' démarre<br>';

			return true;
		}

		echo 'Le réservoir est vide...<br>';

		return false;
	}

	// Vérifie qu'il y'a du carburant dans le réservoir
	private function _controlerVolumeCarburant()
	{
		return $this->_volumeCarburant > 0;
	}
}
