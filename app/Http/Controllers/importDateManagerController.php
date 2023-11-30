<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class importDateManagerController extends Controller
{
	protected $dDate; // Current date

	protected $dN; // Current day position in the week

	protected $days; // Days's table

	public function index()
	{
		$this->init();

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

		$myVar = 'oki';

		return view('pages.test', compact('myVar'));
	}

	private function init()
	{
		$timezone    = 'Europe/Paris';
		$this->dDate = Carbon::now($timezone);
		$this->dN    = $this->dDate->format('N');

		$days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
		$days = array_merge($days, $days);

		$this->days = array_reverse(array_slice($days, $this->dN, 7));

		return true;
	}

	public function dateConversion($published_date)
	{
		try {
			$dateCarbon = Carbon::createFromFormat('d/m/Y \à H:i', $published_date);

			return $dateCarbon->format('Y-m-d H:i:s');
		} catch (\Throwable $th) {
			return $this->dateComplexConversion($published_date);
		}
	}

	private function dateComplexConversion($published_date)
	{
		// hier
		$words = explode(' ', $published_date);
		$d     = $words[0];
		// echo '<hr><h2>' . $d . '</h2>';
		$days  = $this->days;
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
}
