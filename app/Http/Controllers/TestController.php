<?php

namespace App\Http\Controllers;

use App\Http\Tools\Ads;
use App\Http\Tools\Gc7;
use App\Http\Tools\TestIA;
use App\Http\Tutos\TutoController;

class TestController extends Controller
{


	public function index()
	{
		$data = (new AdController())->index();
		// echo '<h1>Add: '.Gc7::affR($ad).'</h1>';
		// (new TutoController)->index();

		$data = Gc7::affData($data ?? null);

		return view('pages.test', compact('data'));
	}

	public function first_try_to_ask_in_loop()
	{
		ini_set('max_execution_time', '0');
		// phpinfo();
		// 2ar CHOIX du Fichier - 1 #0 pour fake ad
		$nFile = 2;
		// 2ar IA Mode reel ?
		$IAMode = 0;
		// 2ar # ad in jsonFile
		$adN = 5;
		// 2ar Affichage Debug
		$aff = 1;

		$ads = (new ImportController())->getParamsFromTest($nFile, $IAMode, $adN, $aff);

		// 2ar
		$debArr = 6;
		$n      = 7; // Nbr ads

		$ads = array_slice($ads, $debArr, $n);
		$req = 0;

		foreach ($ads as $k => $v) {
			$adId = $k + $debArr;
			// echo '<hr>' . str_repeat('&nbsp;', 7) . 'Ad #' . $adId . ' after scraping';
			// Gc7::affH($v);

			$essai = 0;

			while ($essai < 3) {
				++$essai;

				try {
					++$req;
					$property = (new TestIA($v, $IAMode))->getProperty();
					echo str_repeat('&nbsp;', 7) . 'Ok for ad # ' . $adId . ' (' . $essai . '): ' . $property['ad_title'] . str_repeat('&nbsp;', 7) . 'After I.A. process (' . $essai . ')<br>';
					Gc7::affH($property);
					// flush();
					// if ($IAMode) {
					// 	sleep(21);
					// }

					break;
				} catch (\Throwable $th) {
					echo str_repeat('&nbsp;', 7) . '<h1>Error / ad # ' . $adId . ' (' . $essai . ')</h1>';
					// flush();
				}
			}
		}

		$data = 'Extract from json file #' . $nFile . ', ad from # ' . $debArr . ' to # ' . ($debArr + $n - 1) . '. → ' . $req . ' requêtes';

		return view('pages.test', compact('data'));
	}
}
