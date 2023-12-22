<?php

namespace App\Http\Controllers;

use App\Http\classes\ExportManager;
use App\Http\classes\IaManager;
use App\Http\classes\ToolsManager;
use App\Http\Tools\Gc7;

class AdController extends Controller
{
	protected $aff = 1;

	// protected $exports;

	protected $fileN = 0; // @i Choix numéro de fichier

	protected $adN = 1; // @i Choix numéro de l'annonce dans la liste

	protected $file;

	// protected $adForIa;

	protected $askAi = 0; // @i Choix mode IA - 0 simu - 1 réel

	protected $keys;

	protected $error;

	public function index()
	{
		ini_set('max_execution_time', '0');
		date_default_timezone_set('Europe/Paris');

		$this->file = (new ExportManager())->exports;
		// Gc7::affH($this->file->ads[$this->file->adForIaId]);
		// $str = $this->allAdsWithFields();

		// $this->adForIa = $this->setAdForIa();
		$adIa = (new IaManager())->getAdIa($this->file);

		// $cuts = $this->totalCleaning($adIa->cut);
		$newAds = $this->newAds($adIa);

		$this->newAds = $this->totalCleaning($newAds);

		// 2do // $newAds = $this->affAds($ad, 10);
		return $this->error ?? 'no';
	}

	// @i Called by /test
	public function test()
	{
		$this->keys = (new IaManager())->index();
		echo '<hr>';

		$ad = $this->file->ads[$this->adN];

		$property = new \stdClass();

		foreach ($this->keys as $k => $key) {
			$property->{$k} = $ad[$key] ?? null;
			echo $k . ': ' . $property->{$k} . '<br><br>';
		}

		Gc7::affH($this->file->ads[$this->adN]);

		// phpinfo();
		// $this->exports = (new ExportManager())->exportFilesToHtmlTable();

		// $this->exports->exportFilesToHtmlTable();

		// Gc7::aff($this->exports);
		// Gc7::aff($this->exports->selectedFile);

		// $this->ads = $ads = $this->exports->ads[$this->fileN]['ads'];
		// Gc7::aff($this->fileN);
		// Gc7::aff($this->ads->exports->files[$this->fileN]['ads'][$this->adN]);
		// Gc7::aff($this, '***');

		// $newFields = (new IaManager())->getFields($ads);

		// Gc7::aff($newFields, '$newFields');

		// return $this->ads->exports->selectedFile->name;
		// return 'Fichier #' . $this->fileN . ' (' . $this->ads->exports->selectedFile->name . ') - ' . count($this->ads->exports->selectedFile->ads) . ' ads.';
		// var_dump($this->ads->exports);

		if ($this->askAi) {
			exit(Gc7::aff($this->keys));
		}
		Gc7::aff($this->keys, '$keys From Ia');

		return 'Fichier #' . $this->fileN;
	}

	protected function totalCleaning($ads)
	{
		// Gc7::aff($ads);
		$tools = new ToolsManager();

		foreach ($ads as $k => $ad) {
			$ads[$k]['property_owner'] = $tools->getNewOwner($ad['property_owner']);
			// 2do Nett date
		}
		// Gc7::aff($ads);
return $ads;
	}

	protected function cleanDate($date)
	{
	}

	protected function cleanOwner($owner)
	{
	}

	// 2dbug Aff séparé de traitement
	protected function newAds($adIa, $aff = 1): array
	{
		// Gc7::aff($adIa);
		$ads  = $this->file->ads;
		$html = '<div class="container" style="font-family: arial;"><h3>Fichier: ' . $this->fileN . ' (' . $this->file->name . ' - ' . $this->file->adsCount . ' ads)</h3>
        <table class="table table-sm table-bordered table-rounded m-auto" style="width: 97%">
        <tr style="text-align: center">';

		$html .= '<th>Id</th>';
		$i = 0;
		foreach ($adIa->keys as $k => $field) {
			if (1 != $i++) {
				$html .= '<th>' . $k . '<br>' . $field . '</th>';
			}
		}
		// Gc7::aff($adIa->keys);
		$invKeys = $this->flip($adIa->keys);
		// Gc7::aff($invKeys);
		$newAds = [];
		foreach ($ads as $k => $ad) {
			$html .= '</tr><tr style="text-align: center"><td>' . $k . '</td>';

			$i = 0;
			foreach ($adIa->keys as $field) {
				if (0 == $i && empty($ad[$field])) {
					$field = $adIa->keys->fallback_property_location;
				}

				// if (empty($ad[$field])) {
				// 	$ad[$field] = '<h1>XXXXX</h1><hr>' . $ad['textcaption'];
				// }
				// echo $k. ' : '.$field;
				if (1 != $i++) {
					$html .= '<td>' . $ad[$field] . '</td>';
					// $newAds[$k][$i-1] = $ad[$field];
					// $newAds[$k][$field] = $ad[$field];
					$newAds[$k][$invKeys[$field]] = $ad[$field];
				}
			}
		}

		$html .= '</tr>';
		// foreach ($files as $k => $file) {
		// 	$bgcolor = $file['bgColor'];

		// 	$fileDetails = $this->fileDetails($this->folder . $file['name']);

		// 	// Gc7::aff($file);

		// 	$html .= '<tr><td style="text-align: right;background-color:' . $bgcolor . ';">' . $k . '</td>
		//     <td style="background-color:' . $bgcolor . '">' . $file['name'] . '</td>
		//     <td style="text-align: right;background-color:' . $bgcolor . '">' . $file['adsCount'] . '</td>
		//     <td style="text-align: right;background-color:' . $bgcolor . '">' . $fileDetails->fieldsCount . '</td>
		//     <td style="text-align: right;background-color:' . $bgcolor . '">' . $fileDetails->adIdTopFieldsCount . '</td>
		//     <td style="text-align: center;background-color:' . $bgcolor . '">' . date('d/m/Y à H:i:s', $file['createdAt']) . '</td></tr>';
		// }
		$html .= '</table></div>';

		if ($aff) {
			echo $html . '<hr>';
		}

		return $newAds; // array
	}

	protected function flip($o)
	{
		return array_flip(get_object_vars($o));
	}

	protected function allAdsWithFields()
	{
		$ads         = $this->file->ads;
		$adCount     = count($ads);
		$fieldsCount = count($ads[$this->file->adForIaId]);
		for ($i = 0; $i < $fieldsCount; ++$i) {
			foreach ($ads as $k => $ad) {
				$adN = array_values($ad);
				$adK = array_keys($ad);

				echo $k . ' : ' . $adK[$i] . ' : ' . $adN[$i] . '<br>';
			}
			echo '<hr>';
		}

		return $adCount . ' - ' . $fieldsCount;
	}
}
