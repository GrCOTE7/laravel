<?php

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use Carbon\Carbon;

class importManagerController extends Controller
{
	protected $dDate; // Current date

	protected $dN; // Current day position in the week

	protected $days; // Days's table

	public function initDateProcess()
	{
		$this->initDate();

		// $published_dates = [
		// 	'20/10/2023 à 17:51',
		// 	'hier à 12:43',
		// 	'mardi dernier à 13:59',
		// 	'lundi dernier à 07:59',
		// 	'vendredi dernier à 09:43',
		// ];

		// foreach ($published_dates as $published_date) {
		// 	// echo $published_date . ' = ' . $this->dateConversion($published_date) . '<br>';
		// }
		return 1;
		// $myVar = 'oki';

		// return view('pages.test', compact('myVar'));
	}

	public function dateConversion($published_date)
	{
		try {
			$dateCarbon = Carbon::createFromFormat('d/m/Y \à H:i', $published_date);

			return $dateCarbon->format('Y-m-d H:i:s');
		} catch (\Throwable $th) {
			$d = $this->dateComplexConversion($published_date);
			$m = 0;

			return $this->dateComplexConversion($published_date);
			// return '' == $m ? 'o' : 'n';
		}
	}

	public function initTestOwners()
	{
		$owners = $this->getData();

		$ch = '';
		// echo $owner . ' = ' . $this->dateConversion($published_date) . '<br>';
		// $words        = explode(' ', $owner);
		// // $regex = '/^([^\d-s]+)/i';
		// $regex = '/^([^\d\s]+(?:\s+[^\d\s]+)*)\s+Membre/';
		// if (preg_match($regex, $firstLetters, $matches)) {
		// 	$newOwner = $matches[1];
		// }
		// $nomsProprietaires = [];

		foreach ($owners as $owner) {
			$ch .= $owner . '<br>→ ' . $this->getNewOwner($owner) . '<hr>';
		}

		// $newOwner = preg_replace('/Membre/', '', $newOwner);

		$myVar = $ch;

		return view('pages.test', compact('myVar'));
	}

	public function getNewOwner($owner)
	{
		$regex = '/^([^\d\s]+(?:\s+[^\d\s]+)*)(?:.*?Membre|$)/';
		if (preg_match($regex, $owner, $matches)) {
			return $matches[1];
		}
	}

	public function getDateOfFile($file)
	{
		// phpinfo();
		// echo date_default_timezone_get().'<hr>'; // Remplacez 'Europe/Paris' par votre fuseau horaire
		// echo phpversion().'<hr>'; // Remplacez 'Europe/Paris' par votre fuseau horaire
		date_default_timezone_set('Europe/Paris'); // Remplacez 'Europe/Paris' par votre fuseau horaire
		// echo date_default_timezone_get().'<hr>'; // Remplacez 'Europe/Paris' par votre fuseau horaire

		// Vérifier si le fichier existe
		if (file_exists($file)) {
			// Obtenir la date de création du fichier
			$dateModification = date('Y-m-d H:i:s', filectime($file));

			// Afficher la date de modification
			// echo "La date de modification du fichier {$file} est : {$dateModification}";
		} else {
			$dateModification = "Le fichier {$file} n'existe pas.";
		}

		return $dateModification;
	}

	private function initDate()
	{
		$timezone    = 'Europe/Paris';
		$this->dDate = Carbon::now($timezone);
		$this->dN    = $this->dDate->format('N');

		$days    = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
		$days    = array_merge($days, $days);
		$days[0] = 'hier';

		// Gc7::aff($days);

		$this->days = array_reverse(array_slice($days, $this->dN, 7));

		return true;
	}

	private function dateComplexConversion($published_date)
	{
		// hier
		$words = explode(' ', $published_date);
		$d     = $words[0];
		// echo '<hr><h2>' . $d . '</h2>';
		$days = $this->days;
		// 2ar À simplifier sous contrôle
		$decal = ('hier' == $d) ? 1 : array_search($d, $days);

		return $this->setHourAndMinute($decal, $published_date);
	}

	private function setHourAndMinute(int $decal, string $date): Carbon
	{
		$timezone = 'Europe/Paris';
		$dateJ    = Carbon::now($timezone);

		$hour   = substr($date, -5, 2);
		$minute = substr($date, -2, 2);
		// echo '<h1>' . $decal . ' - ' . $hour . ':' . $minute . '</h1>';

		return $dateJ->subDay($decal)->setHour($hour)->setMinute($minute)->setSecond(0);
	}

	private function getFakeOwnerFields()
	{
		return [
			'christine colinMembre depuis août 2019Signaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraPeintre 39290Lot maisons à vendreAnnonces Google',
			'Coco16 annoncesMembre depuis décembre 2015Dernière réponse en moins de 6 heuresSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraChaussin 39120Maison type F5Annonces Google',
			'philippeMembre depuis juillet 2015Dernière réponse en moins de 10 minutesSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraTavaux 39500Maison Tavaux villageAnnonces Google',
			'Laurent23 annoncesPièce d’identité vérifiéeMembre depuis novembre 2015Répond généralement dans les 6 heuresSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraDole 39100Maison 5 chambres 200m2Annonces Google',
			"benjamin112 annoncesPièce d’identité vérifiéeMembre depuis octobre 2015Répond généralement dans les 3 heuresSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresBourgogneCôte-d'OrNeuilly-Crimolois 21800Maison 90 m2 Neuilly CrimoloisAnnonces Google",
			"MD21Membre depuis janvier 2015Signaler l’annonceVos droits et obligationsAccueilVentes immobilièresBourgogneCôte-d'OrSeurre 21250Maison 5 pièces 106 m²Annonces Google",
		];
	}
}
