<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Php;

class Car extends Vehicle
{
	public $actions;

	// Attributs
	private $_fuelVolume;

	// Constructeur
	public function __construct($brand)
	{
		// Appel du constructeur de la classe parente
		parent::__construct($brand);
		$this->_fuelVolume = 40;
	}

	public function __toString()
	{
		$str = '';
		foreach ($this->actions as $key => $action) {
			$str .= $action;
		}

		return "{$str}";
	}

	// Démarre la voiture si le réservoir
	// n'est pas vide
	public function start()
	{
		if ($this->_controlFuelVolume()) {
			return 'Le véhicule ' . $this->_brand . ' démarre<br>';
		}

		return 'Le réservoir est vide...<br>';
	}

	// Vérifie qu'il y'a du carburant dans le réservoir
	private function _controlFuelVolume()
	{
		return $this->_fuelVolume > 0;
	}
}
