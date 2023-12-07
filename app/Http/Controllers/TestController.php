<?php

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use App\Http\Tools\TestIA;
use index;

class TestController extends Controller
{
	/**
	 * index.
	 */
	public function index()
	{
		// 2see CHOIX du Fichier & reel IA
		$nFile  = 2;
		$IAMode = 1;

		$ads    = ( new importController($nFile, 1))->getAdsFromFile();

		// Gc7::aff($ads[0]);
		$property = (new TestIA($ads[2], $IAMode))->getProperty();
		Gc7::aff($property, 'Property');

		$data = 'The file #' . $nFile . ' has ' . count($ads) . ' ads.';

		return view('pages.test', compact('data'));
	}

	public function fields()
	{
		// $newDates = new importDateManagerController;
		// $newDates->index();
		// $newOwner = new importOwnerManagerController;
		// $myVar = $newOwner->index();

		// $import = (new importController)->import();

		// // Gc7::aff($import);
		// // exit();
		// $data=$import;

		// $jsonData = file_get_contents('./../storage/app/exports/fullleboncoin.fr.json');
		// $jsonData = file_get_contents('./../storage/app/exports/231204-17_sjdl20.json');
		$jsonData = file_get_contents('./../storage/app/exports/sjdl20s.json');
		$jsonData = preg_replace('/ /', '&nbsp;', $jsonData);
		$ads      = json_decode($jsonData, true);

		if (null === $ads) {
			exit('Erreur lors de la conversion JSON');
		}

		$adsNb = count($ads);
		// Gc7::aff($datas[3]);
		// $data = $datas;

		$line     = '';
		$maxAddId = 0;
		$addIds   = [];

		$manager = new importManagerController();
		$manager->initDateProcess();

		$keys = [];
		$i    = 0;
		$data = '<table class="table table-sm table-bordered table-rounded">';
		foreach ($ads[1] as $k => $v) {
			$data .= '<tr><td style="text-align: right;">' . $i++ . '</td><td>' . $k . '</td><td>' . $v . '</td></tr>';
		}
		$data .= '</table>';

		// Gc7::aff($datas[3]);
		/*
		foreach ($datas as $k => $data) {
			$addKey = array_keys($data);

			$data = array_values($data);

			$addId = substr($data[1], 46, 9); // 'Lien_du_titre'

			// if (!in_array($addId, $addIds)) {
			$addIds[]        = $add[$k]['addId'] = $addId;
			$add[$k]['date'] = $manager->dateConversion($data[6]); // 'Date de publication'
			$add[$k]['link'] = $data[1]; // 'Lien_du_titre'
			$add[$k]['id']   = $k;

			$add[$k]['title']   = $data[7]; // Titre
			$add[$k]['pieces']  = $data[11];
			$add[$k]['surface'] = $data[12]; // champ2
			$add[$k]['price']   = $data[14]; // champ4

			// $add[$k]['ownerOri'] = $data[8]; // champ4
			$add[$k]['owner'] = $newOwner->getNewOwner($data[8]); // champ4
			$maxAddId         = max($maxAddId, $add[$k]['addId']);
			// }
		}

		// Gc7::aff($datas[3]);

		$i = 0;
		foreach ($datas[3] as $k => $a) {
			echo $i++ . ' : ' . $k . ' → ' . $a . '<br>';
		}
		 */
		return $data;
	}
}
