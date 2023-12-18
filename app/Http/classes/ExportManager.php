<?php

namespace App\Http\classes;

use App\Http\Controllers\AdController;
use App\Http\Tools\Gc7;
use App\Http\Tools\TestIaUuu;
use Illuminate\View\View;

class ExportManager extends AdController
{
	public $exports;

	public $folder;

	public function __construct()
	{
		$this->exports = $this->exportFiles();
		$this->folder  = $this->exports->folder;

		// Gc7::aff($this);
		// Gc7::aff($this->getFieldsCountByAd(), 'FieldsCountByAd()');
	}

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
	 * get ads and cleaned json.
	 *
	 * @param null|mixed $file
	 */
	public function getAdsFromJson($file = null): array
	{
		$file ??= $this->file;
		$jsonData = file_get_contents($file);
		// echo $jsonData;
		$jsonData = preg_replace('/ /', '&nbsp;', $jsonData);
		$ads      = json_decode($jsonData, true);

		if (null === $ads) {
			exit('Erreur lors de la conversion JSON');
		}

		// Gc7::aff($ads);

		return $ads;
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

	protected function getFiles(): object
	{
		// Chemin du répertoire à lister
		$repertoire = './../storage/app/exports/';
		$filesArr   = [];

		// Ouvre le répertoire
		if ($gestionnaire = opendir($repertoire)) {
			// Parcours chaque fichier du répertoire
			while (false !== ($fichier = readdir($gestionnaire))) {
				// Exclut les entrées "." et ".."
				if ('.' != $fichier && '..' != $fichier) {
					// Affiche le nom du fichier
					if ('json' === pathinfo($fichier, PATHINFO_EXTENSION)) {
						// Affiche le nom du fichier
						$filesArr[] = $fichier;
					}
				}
			}
			// Ferme le gestionnaire de fichier
			closedir($gestionnaire);
		} else {
			// En cas d'erreur d'ouverture du répertoire
			$filesArr = null;
		}

		$exports         = new \stdClass();
		$exports->folder = $repertoire;
		$exports->files  = $filesArr;

		// Gc7::aff($imports);

		return $exports;
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

		Gc7::aff($this->getAdWithoutFinancial($ad));

		$vCount = count($this->fieldsNotEmptyCount($ads[0]));
		// Gc7::aff($vCount);

		// $fields = count($ads);

		$details->adIdTopFieldsCount = $vCount;

		return $details;
	}

	protected function fieldsNotEmptyCount($ad)
	{
		return array_filter($ad, function ($value) {
			// La fonction de rappel retourne true pour les valeurs non vides
			return null !== $value && '' !== $value && false !== $value;
		});
	}

	protected function getAdWithoutFinancial($ad)
	{
		// Gc7::affH($ads[0]);
		$adsNum = array_values($ad);

		// Gc7::affH($ad);

		// Gc7::aff(count($adsNum));
		return array_slice($ad, 0, array_search('Calculer mes mensualités', $adsNum));
		// Gc7::aff($adsNum);
	}

	/**
	 * exportFiles.
	 */
	protected function exportFiles(): object
	{
		// Gc7::aff($this);
		$imports = $this->getFiles();
		// Gc7::aff($imports, 'imports');

		$folder = $imports->folder;
		$files  = $imports->files;
		// Gc7::aff($folder, 'folder');
		// Gc7::aff($files, 'files');

		// Gc7::aff($this, '$this');

		$exports             = new \stdClass();
		$exports->filesCount = count($files);
		$exports->folder     = $folder;
		// Gc7::aff($exports, '$exports');
		// $exports->selected = $this->adN;

		$exports->selectedFile = new \stdClass();

		foreach ($files as $k => $v) {
			$this->file       = $imports->folder . $v;
			$ads              = $this->getAdsFromJson();
			$exports->files[] = [
				'name'      => $v,
				'adsCount'  => count($ads),
				'createdAt' => filectime($imports->folder . $v),
				'bgColor'   => 'none',
			];
			if ($this->fileN == $k) {
				$exports->files[$k]['bgColor'] = 'yellow';
				$exports->selectedFile->name   = $v;
				$exports->selectedFile->ads    = $ads;
			}

			// Gc7::aff($v);
		}

		// Gc7::aff($exports, '$exports');

		// if ($this->nFile >= $nbFiles) {
		// 	$this->error = 1;
		// }

		// Gc7::aff($data);

		return $exports;
	}
}
