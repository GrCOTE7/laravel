<?php

namespace App\Http\Classes;

use App\Http\Controllers\AdController;
use App\Http\Tools\Gc7;
use App\Http\Tools\TestIaUuu;
use Illuminate\View\View;

class ExportManagerUuu extends AdController
{
	protected $exports;



	public function getSelectedAd()
	{
		$selectedFile       = new \stdClass();
		$selectedFile->name = $this->exports->files[$this->fileName];
		$selectedFile->ads  = $this->exports->files[$this->fileN]['ads'][$this->adN];

		// $this->selectedFile=$selectedFile;
		return $selectedFile;
	}

	public function getFieldsCountByAd()
	{
		// foreach ($this->exports->ads as $k => $ad) {
		//     # code...
		// }

		return $this;
	}

	public function index(): view
	{
		$data = $this->getAdJsonToHtmlAd(); // Complete (with credit fields)

		$data ??= null;

		return view('pages.export', compact('data'));
	}

	public function getAdJsonToHtmlAd(): string
	{
		// $this->exports = $this->exportFiles();

		$selectedAd = $this->getSelectedAd();

		// Gc7::aff($ads[$adN]);
		// Gc7::aff($ads);

		echo str_repeat('&nbsp;', 7) . 'After Scraping';
		Gc7::affH($selectedAd);
		// Gc7::aff($ads[$adN]);
		$property = (new TestIaUuu($selectedAd, $this->askAi))->getProperty();
		echo str_repeat('&nbsp;', 7) . 'After I.A. process';
		Gc7::affH($property, 'Property');

		// $data = 'The file is #' . $nFile;
		// if ($IAMode) {
		// 	exit;
		// }

		return 'Extract from json file #' . $this->fileN . ', ad # ' . $this->adN . '.';
	}

	public function files()
	{
		// Gc7::aff($this->getFiles());
		// $this->aff = 0;

		// Gc7::aff($this->exportFilesToHtmlTable());
		// echo '<hr>';
		$data = $this->exports;
		// $data = 123;

		return view('pages.files', compact('data'));
	}

	/**
	 * getAdsFromFile.
	 *
	 * @return void
	 */
	public function getAdsFromFile(): array
	{
		$this->ads = $this->exportFiles()->files;

		return $this->ads;
	}



	/**
	 * 1er jet.
	 */
	public function import()
	{
		$jsonData = file_get_contents('./../storage/app/exports/231201_sjdl20.json');
		$jsonData = preg_replace('/ /', '&nbsp;', $jsonData);
		$datas    = json_decode($jsonData, true);

		if (null === $datas) {
			exit('Erreur lors de la conversion JSON');
		}

		$line     = '';
		$maxAddId = 0;
		$addIds   = [];
		$addKeys  = [];

		$manager = new importManagerController();
		$manager->initDateProcess();

		foreach ($datas as $k => $data) {
			$addKey = array_keys($data);
			// echo 'ooooooooooooo: ' . $k . ' → ' . $addKey[3] . '<br>';

			$data = array_values($data);

			$addId = substr($data[1], 46, 9); // 'Lien_du_titre'

			if (!in_array($addId, $addIds)) {
				$addIds[]        = $add[$k]['addId'] = $addId;
				$add[$k]['date'] = $manager->dateConversion($data[15]); // 'Date de publication'
				$add[$k]['link'] = $data[1]; // 'Lien_du_titre'
				$add[$k]['id']   = $k;

				$add[$k]['title']   = $data[7]; // Titre
				$add[$k]['pieces']  = $data[11];
				$add[$k]['surface'] = $data[12]; // champ2
				$add[$k]['price']   = $data[14]; // champ4

				// $add[$k]['ownerOri'] = $data[8]; // champ4
				$add[$k]['owner'] = $manager->getNewOwner($data[8]); // champ4
				$maxAddId         = max($maxAddId, $add[$k]['addId']);
			}
		}
		// echo $maxAddId;

		sort($add);

		// echo count($add);

		// echo '<pre>';
		// var_dump($add);
		// echo '</pre>';

		$precAddId = '';

		$newAddIds = [];
		foreach ($add as $i => $a) {
			$color = 'none';

			// if ($a['addId'] == $precAddId) {
			if (in_array($a['addId'], $newAddIds)) {
				$color = 'orange';
			}
			$newAddIds[] = $a['addId'];

			$line .= '<tr">
                <td style="text-align: right; font-weight: bold; background-color: ' . $color . '"><a href=' . $a['link'] . ' target="_blank">' . ($a['id']) . '</a></td>
                <td>' . $a['date'] . '</td>
		        <td>' . $a['addId'] . '</td>

		        <td>' . $a['title'] . '</td>
		        <td>' . $a['pieces'] . '</td>
		        <td>' . $a['surface'] . '</td>
		        <td>' . $a['price'] . '</td>

		        <td>' . $a['owner'] . '</td>
		        </tr>';
			// <td>' . $a['ownerOri'] . '</td>
			$precAddId = $a['addId'];
		}

		// for ($i = 0; $i <= $maxAddId; ++$i) {
		// 	if ($i == $add[$k]['addId']) {
		// 		$line .= '<tr>
		//         <td><a href=' . $add[$i]['link'] . ' target="_blank">' . ($i) . '</a></td>
		//         <td>' . $add[$k]['addId'] . '</td>
		//         <td>' . $add['Titre1'] . '</td>
		//         <td>' . $add['champ2'] . '</td>
		//         <td>' . $add['champ4'] . '</td>
		//         </tr>';
		// 	}
		// }

		$head = '<tr>
        <td style="text-align: center">Lien</td>
        <td style="text-align: center">Date</td>
        <td style="text-align: center">Id</td>
        <td style="text-align: center">Titre</td>
        <td style="text-align: center">Pièces</td>
        <td style="text-align: center">Surface</td>
        <td style="text-align: center">Prix</td>
        <td style="text-align: center">Proprio</td>
        </tr>';
		// <td style="text-align: center">ProprioOri</td>

		return count($add) . ' annonces<table class="table table-sm table-bordered table-rounded">' . $head . $line . '</table>';
		// $ch = 'https://www.leboncoin.fr/ventes_immobilieres/2452806946.htm';
		// $ch = substr($ch, 50, 5);
	}



	protected function exportFilesToHtmlTable(): object
	{
		$exports = $this->exports;
		$files   = $exports->files;

		// Gc7::aff($exports);

		$filesCount = count($files);

		$html = '<div class="container"><h3>' . $exports->folder . ' Fichiers de 0 à ' . $filesCount - 1 . '</h3><table class="table table-sm table-bordered table-rounded m-auto" style="width: 97%">
        <tr style="text-align: center"><th>Id</th><th>Name</th><th>AdsCount</th><th>FieldsCount</th><th>AdIdTopFields</th><th>Created Date</th></tr>';
		foreach ($files as $k => $file) {
			$bgcolor = $file['bgColor'];

			$fileDetails = $this->fileDetails($this->folder . $file['name']);

			// Gc7::aff($file);

			$html .= '<tr><td style="text-align: right;background-color:' . $bgcolor . ';">' . $k . '</td>
            <td style="background-color:' . $bgcolor . '">' . $file['name'] . '</td>
            <td style="text-align: right;background-color:' . $bgcolor . '">' . $file['adsCount'] . '</td>
            <td style="text-align: right;background-color:' . $bgcolor . '">' . $fileDetails->fieldsCount . '</td>
            <td style="text-align: right;background-color:' . $bgcolor . '">' . $fileDetails->adIdTopFieldsCount . '</td>
            <td style="text-align: center;background-color:' . $bgcolor . '">' . date('d/m/Y à H:i:s', $file['createdAt']) . '</td></tr>';
		}
		$html .= '</table></div>';

		echo $html . '<hr>';

		return $exports;
	}

	protected function fileDetails($file)
	{
		$details = new \stdClass();

		// Gc7::aff($this);

		$ads                  = $this->getAdsFromJson($file);
		$ad                   = $ads[0];
		$details->fieldsCount = count($ad);

		// Gc7::aff($this->getAdWithoutFinancial($ad));

		$vCount = count($this->fieldsNotEmptyCount($ads[0]));
		// Gc7::aff($vCount);

		// $fields = count($ads);

		$details->adIdTopFieldsCount = $vCount;

		return $details;
	}



}
