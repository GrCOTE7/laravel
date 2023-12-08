<?php

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use App\Http\Tools\TestIA;

class TestController extends Controller
{
	private $aff;

	private $nFile;

	private $file;

	private $ads;

	private $error;

	public function index()
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

		foreach ($ads as $k => $v) {
			$adId = $k + $debArr;
			// echo '<hr>' . str_repeat('&nbsp;', 7) . 'Ad #' . $adId . ' after scraping';
			// Gc7::affH($v);

			try {
				$property = (new TestIA($v, $IAMode))->getProperty();
				echo 'Ok for ad # ' . $adId . ': ' . $property['ad_title'] . str_repeat('&nbsp;', 7) . 'After I.A. process';
				Gc7::affH($property, 'Property');
			} catch (\Throwable $th) {
				echo '<h1>Error / ad # ' . $adId . '</h1>';
				sleep(12);
			}
			if ($IAMode) {
				sleep(21);
			}
		}

		$data = 'Ok';

		return view('pages.test', compact('data'));
	}
}
