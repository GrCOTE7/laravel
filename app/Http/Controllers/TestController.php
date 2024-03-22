<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Http\Tools\Ads;
use App\Http\Tools\Gc7;
use App\Http\Tools\TestIA;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
	public function index()
	{
		$data = 777;
        $css='p {color:blue; font-weight:bold}';

        Storage::disk('public')->put('recettes.txt', 'Contenu du fichier');
		return view('pages.test')
			->with('data', $data ?? null)
			->with('css', $css ?? null);
	}

	public function monospace()
	{
		$css   = '.monospace-font { color: red; font-weight: 800; font-size: 14pt; }';
		$fonts = ['Courier', 'Consolas', 'Monaco', 'Inconsolata'];
		$data  = '';
		foreach ($fonts as $font) {
			$str = '';
			for ($i = 0; $i < 17; ++$i) {
				$binary = str_pad(decbin($i), 5, '0', STR_PAD_LEFT);
				$str .= sprintf("<span class='monospace-font' style='font-family:%s;'>%s</span> ← %d<br>", $font, $binary, $i);
			}
			$data .= sprintf('%s<br>%s<hr>', $font, $str);
		}

		return view('pages.test')
			->with('data', $data ?? null)
			->with('css', $css ?? null);
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
