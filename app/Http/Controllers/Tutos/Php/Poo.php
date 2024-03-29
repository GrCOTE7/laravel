<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers\Tutos\Php;

class Poo
{
	public $actions;

	public function index()
	{
		$data = $this->person();

		$data .= str_repeat('-', 70).'<br>';

		$data .= $this->vehicle();
		$data .= $this->car(); // Héritage

		return view('pages.test', compact('data'));
	}

	private function person(): string
	{
		$p1 = new Person();

		$p1->name        = 'Hamon';
		$p1->lastname    = 'Hugo';
		$p1->dateOfBirth = '02-07-1987';
		$p1->height      = '180';
		$p1->sex         = 'M';
		$p1->infos       = ['Chaque personne a ' . Person::NUMBER_OF_EYES . ' yeux.<br>'];

		$p1->infos[] = $p1->drink();

		return (string) $p1;
	}

	private function vehicle()
	{
		// Instanciation de l'objet : appel implicite à la méthode __construct()
		$myVehicle = new Vehicle('Peugeot');

		// Mise à jour de la marque du véhicule
		// $myVehicle->brand = 'Peugeot';

		// Affichage de la marque du véhicule
		return $myVehicle->start();
	}

	private function car()
	{
		$myVehicle          = new Car('Renault');
		$myVehicle->actions = [$myVehicle->start()];
		array_push($myVehicle->actions, $myVehicle->repair()); // Non visible

		return (string) $myVehicle;
	}
}
