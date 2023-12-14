<?php

namespace App\Http\Tutos;

class Vehicule
{
	// Attributs
	protected $_marque;

	protected $_estRepare;

	private $_volumeCarburant = 40;

	// Méthodes
	public function __construct($marque)
	{
		$this->_marque = $marque;
		// $this->_volumeCarburant = 40;
		$this->_estRepare = false;
	}

	// Met le véhicule en maintenance
	public function reparer()
	{
		$this->_estRepare = true;
		echo 'Le véhicule est en réparation<br>';
	}

	public function demarrer()
	{
		if ($this->_controlerVolumeCarburant()) {
			echo 'Le véhicule démarre<br>';

			return true;
		}

		echo 'Le réservoir est vide...';

		return false;
	}

	// Vérifie s'il y'a du carburant dans le réservoir
	private function _controlerVolumeCarburant()
	{
		return $this->_volumeCarburant > 0; // renvoi true ou false
	}
}
