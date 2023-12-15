<?php

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use App\Http\Tools\TestIA;

class ImportController extends Controller
{
	private $aff = 1;

	private $nFile = 1;

	private $file;

	private $ads;

	private $error;

	public function index()
	{
		// 2ar CHOIX du Fichier - 1 #0 pour fake ad
		$nFile = 1;
		// 2ar IA Mode reel ?
		$IAMode = 0;
		// 2ar # ad in jsonFile
		$adN = 0;
		// 2ar Affichage Debug
		$aff = 10;

		$this->nFile = $nFile;
		$this->aff   = $aff;

		$ads = $this->getAdsFromFile();

		// Gc7::aff($ads[$adN]);
		// Gc7::aff($ads);

		echo str_repeat('&nbsp;', 7) . 'After Scraping';
		Gc7::affH($ads[$adN]);

		// Gc7::aff($ads[$adN]);
		$property = (new TestIA($ads[$adN], $IAMode))->getProperty();
		echo str_repeat('&nbsp;', 7) . 'After I.A. process';
		Gc7::affH($property, 'Property');

		// $data = 'The file is #' . $nFile;
		// if ($IAMode) {
		// 	exit;
		// }

		$data = 'Extract from json file #' . $nFile . ', ad # ' . $adN . '.';

		return view('pages.import', compact('data'));
	}

	public function files()
	{
		// Gc7::aff($this->getFiles());
		$this->aff = 0;

		// 2ar
		Gc7::aff($this->exportFilesHtmlTable());
		echo '<hr>';

		$data = $this->exportFiles();

		// $data = 123;

		return view('pages.files', compact('data'));
	}

	public function getParamsFromTest($nFile, $IAMode, $adN, $aff)
	{
		$this->nFile  = $nFile;
		$this->iaMode = $IAMode;
		$this->adN    = $adN;
		$this->aff    = $aff;

		return $this->getAdsFromFile();
	}

	/**
	 * getAdsFromFile.
	 *
	 * @return void
	 */
	public function getAdsFromFile(): array
	{
		$this->exportFileTable();

		return $this->ads;
	}

	public function getAdsFromJson(): array
	{
		$jsonData = file_get_contents($this->file);
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

		$imports         = new \stdClass();
		$imports->folder = $repertoire;
		$imports->files  = $filesArr;

		// Gc7::aff($imports);

		return $imports;
	}

	private function exportFilesHtmlTable(): string
	{
		$imports = $this->getFiles();
		$files   = $imports->files;

		// $files = [
		// 	'./../storage/app/exports/231204-17_sjdl20.json',
		// 	'./../storage/app/exports/231201_sjdl20.json',
		// 	'./../storage/app/exports/sjdl20s.json',
		// ];

		$nbFiles = count($files);

		$data = '<div class="container"><h3>' . $imports->folder . ' Fichiers de 0 à ' . $nbFiles - 1 . '</h3><table class="table table-sm table-bordered table-rounded m-auto" style="width: 97%">';
		foreach ($files as $k => $v) {
			$bgcolor    = ($this->nFile == $k) ? 'yellow' : 'none';
			$this->file = $imports->folder . $v;
			// $this->file = $v;
			// Gc7::aff($v);
			// Gc7::aff($this->file);
			$ads = $this->getAdsFromJson();
			// Gc7::aff($ads);
			if ($this->nFile == $k) {
				$this->ads = $ads;
			}
			$data .= '<tr><td style="text-align: right;background-color:' . $bgcolor . ';">' . $k . '</td><td style="background-color:' . $bgcolor . '">' . $v . '</td><td style="text-align: right;background-color:' . $bgcolor . '">' . count($ads) . '</td><td style="text-align: center;background-color:' . $bgcolor . '">' . date('d/m/Y à H:i:s', filectime($imports->folder . $v)) . '</td></tr>';
		}
		$data .= '</table></div>';
		if ($this->aff) {
			echo '<h3>' . $imports->folder . ' /Fichiers de 0 à ' . $nbFiles - 1 . '</h3>';
			echo $data . '<hr>';
		}

		// if ($this->nFile >= $nbFiles) {
		// 	$this->error = 1;
		// }

		return $data;
	}

	private function exportFiles(): object
	{
		$imports = $this->getFiles();
		$folder  = $imports->folder;
		$files   = $imports->files;

		// Gc7::aff($folder);

		// $files = [
		// 	'./../storage/app/exports/231204-17_sjdl20.json',
		// 	'./../storage/app/exports/231201_sjdl20.json',
		// 	'./../storage/app/exports/sjdl20s.json',
		// ];

		$nbFiles = count($files);

		$data          = new \stdClass();
		$data->nbFiles = $nbFiles;
		$data->folder  = $folder;

		foreach ($files as $k => $v) {
			$this->file    = $imports->folder . $v;
			$ads           = $this->getAdsFromJson();
			$data->files[] = [
				'name'      => $v,
				'adsCount'  => count($ads),
				'createdAt' => date('d/m/Y à H:i:s', filectime($imports->folder . $v)),
				'bgColor'   => 'none',
			];
			if ($this->nFile == $k) {
				$data->files[$k]['ads']     = $ads;
				$data->files[$k]['bgColor'] = 'yellow';
			}

			// Gc7::aff($v);
		}

		// if ($this->nFile >= $nbFiles) {
		// 	$this->error = 1;
		// }

		// Gc7::aff($data);

		return $data;
	}
}
