<?php

namespace App\Http\Tutos;

class TutoController
{
	public function index()
	{
		// $this->personne();
		$this->vehicule();
		$this->voiture(); // Héritage
	}

	private function personne()
	{
		$p1 = new Personne();

		$p1->nom             = 'Hamon';
		$p1->prenom          = 'Hugo';
		$p1->dateDeNaissance = '02-07-1987';
		$p1->taille          = '180';
		$p1->sexe            = 'M';

		echo 'Personne 1 :<br/><br/>';
		echo 'Nom : ', $p1->nom ,'<br/>';
		echo 'Prénom : ', $p1->prenom . '<br>';
		echo 'Chaque personne a ', Personne::NOMBRE_DE_YEUX ,' yeux.<br>';

		$p1->boire();
	}

	private function vehicule()
	{
		// Instanciation de l'objet : appel implicite à la méthode __construct()
		$monVehicule = new Vehicule('Peugeot');

		// Mise à jour de la marque du véhicule
		$monVehicule->marque = 'Peugeot';

		// Affichage de la marque du véhicule
		echo $monVehicule->demarrer();
	}

	private function voiture()
	{
		$monVehicule = new Voiture('Peugeot');
		$monVehicule->demarrer();
		$monVehicule->reparer(); // Non visible
	}
}
