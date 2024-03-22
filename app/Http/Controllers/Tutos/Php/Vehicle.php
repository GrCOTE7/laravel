<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Php;

class Vehicle
{
	// Attributs
	protected $_brand;

	protected $_isRepaired;

	private $_fuelVolume = 40;

	// Méthodes
	public function __construct($brand)
	{
		$this->_brand = $brand;
		// $this->_volumeCarburant = 40;
		$this->_isRepaired = false;
	}

	// Met le véhicule en maintenance
	public function repair()
	{
		$this->_isRepaired = true;

		return 'Le véhicule est en réparation<br>';
	}

	public function start()
	{
		if ($this->_controlFuelVolume()) {
			return 'Le véhicule ' . $this->_brand . ' démarre<br>';
		}

		return 'Le réservoir est vide...<br>';
	}

	// Vérifie s'il y'a du carburant dans le réservoir
	private function _controlFuelVolume()
	{
		return $this->_fuelVolume > 0; // renvoi true ou false
	}
}
