<?php

namespace App\Http\classes;

use Carbon\Carbon;

class ToolsManager
{
	protected $dDate; // Current date

	protected $dN; // Current day position in the week

	protected $days; // Days's table

	public function dateConversion(string $published_date, int $dRef): string
	{
		try {
			$dateCarbon = Carbon::createFromFormat('d/m/Y \à H:i', $published_date);
		} catch (\Throwable $th) {
			$dateCarbon = $this->dateComplexConversion($published_date, $dRef);
		}

		return $dateCarbon->format('Y-m-d H:i:s');
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

	protected function dateComplexConversion(string $published_date, int $dRef): Carbon
	{
		$daysFrEn = [
			'lundi'    => 'monday',
			'mardi'    => 'tuesday',
			'mercredi' => 'wednesday',
			'jeudi'    => 'thursday',
			'vendredi' => 'friday',
			'samedi'   => 'saturday',
			'dimanche' => 'sunday',
		];
		setlocale(LC_TIME, 'fr_FR');
		$timezone = 'Europe/Paris';
		$dateJ    = Carbon::now($timezone);

		$words = explode(' ', $published_date);
		$d     = $words[0];

		// $d        = 'jeudi';

		$dRef = Carbon::createFromTimestamp($dRef);
		// $date = ('hier' == $d) ? $dRef->subDay() : $dRef->previous(Carbon::$d);
		$date = ("aujourd'hui" == $d) ? $dRef : (('hier' === $d) ? $dRef->subDay() : $dRef->previous($daysFrEn[$d]));

		return $this->setHourAndMinute($date, $published_date);
	}

	protected function setHourAndMinute(Carbon $date, string $published_date): Carbon
	{
		// $timezone = 'Europe/Paris';
		// $dateJ    = Carbon::now($timezone);

		$hour   = substr($published_date, -5, 2);
		$minute = substr($published_date, -2, 2);
		// echo '<h1>' . $decal . ' - ' . $hour . ':' . $minute . '</h1>';

		return $date->setHour($hour)->setMinute($minute)->setSecond(0);
	}
}
