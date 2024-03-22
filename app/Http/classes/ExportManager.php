<?php

namespace App\Http\Classes;

use App\Http\Tools\Gc7;
use App\Http\Controllers\AdController;

class ExportManager extends AdController
{
	protected $exports;

	public function __construct()
	{
		$this->exports = $this->getAdsFromExportFiles();
		// $this->folder  = $this->files->folder;

		// Gc7::aff($this);
		// Gc7::aff($this->getFieldsCountByAd(), 'FieldsCountByAd()');
	}

	/**
	 * get ads and cleaned json.
	 *
	 * @param null|mixed $file
	 */
	public function getAdsFromJson($file = null): array
	{
		// $file ??= $this->file;
		$jsonData = file_get_contents($file);

		// $encodage = mb_detect_encoding($jsonData);
		// echo $jsonData;
		$jsonData = preg_replace_callback('/[’ \xC2\xA0]/u', function ($match) {
			switch ($match[0]) {
				case '’':
					return "'";
				case ' ':
					return '';
				case "\xC2\xA0":
					return ' ';
				default:
					return $match[0];
			}
		}, $jsonData);

		$ads = json_decode($jsonData, true);

		if (null === $ads) {
			exit('Erreur lors de la conversion JSON');
		}

		// Gc7::aff($ads);

		return $ads;
	}

	/** exportFiles.
	 *
	 */
	protected function getAdsFromExportFiles(): object
	{
		$exports = $this->getFiles();
		// $exports->selectedFile = new \stdClass();

		foreach ($exports->files as $fileId => $file) {
			$fileName = $exports->path . $file->name;
			$ads      = $this->getAdsFromJson($fileName);

			$file->adsCount  = count($ads);
			$file->createdAt = filectime($fileName);
			$file->bgColor   = 'none';

			if ($this->fileN === $fileId) {
				$file->bgColor   = 'yellow';
				$cleanedAds      = [];
				$adFieldsCount   = [];
				$maxFilledFields = 0;
				foreach ($ads as $k => $ad) {
					$ad = $this->getAdWithoutFinancial($ad);

					$cleanedAds[]      = $this->cleanFieldsAd($ad);
					$filledFieldsCount = count($this->fieldsNotEmptyCount($ad));
					$adFieldsCount[]   = $filledFieldsCount;

					$maxFilledFields = max($maxFilledFields, $filledFieldsCount);
				}

				// echo $adMoreFields; // Ad More fields
				// Gc7::aff($maxFilledFields);
				// Gc7::aff($adFieldsCount);
				$file->adForIaId = array_search($maxFilledFields, $adFieldsCount);
				$file->ads       = $cleanedAds;
			}
		}

		// $this->file->
		return $exports->files[$this->fileN];
		// return new \stdClass();
	}

	protected function cleanFieldsAd($ad)
	{
		foreach ($ad as $key => $field) {
			// $ad[$key] = trim($ad[$key]);
			$ad[$key] = trim(preg_replace('/\s{2}/', ' ', $ad[$key]));
		}

		return $ad;
	}

	protected function getFiles(): object
	{
		// Chemin du répertoire à lister
		$path  = storage_path('app/exports/');
		$files = [];

		// Ouvre le répertoire
		if ($folder = opendir($path)) {
			// Parcours chaque fichier du répertoire
			while (false !== ($fichier = readdir($folder))) {
				// Exclut les entrées "." et ".."
				if ('.' != $fichier && '..' != $fichier) {
					// Affiche le nom du fichier
					if ('json' === pathinfo($fichier, PATHINFO_EXTENSION)) {
						// Affiche le nom du fichier
						$file       = new \stdClass();
						$file->name = $fichier;
						$files[]    = $file;
					}
				}
			}
			// Ferme le gestionnaire de fichier
			closedir($folder);
		} else {
			// En cas d'erreur d'ouverture du répertoire
			$files = null;
		}

		$exports        = new \stdClass();
		$exports->path  = $path;
		$exports->files = $files;

		// Gc7::aff($imports);

		return $exports;
	}

	protected function getAdWithoutFinancial($ad)
	{
		return array_slice($ad, 0, array_search('Calculer mes mensualités', array_values($ad)));
	}

	protected function fieldsNotEmptyCount($ad)
	{
		return array_filter($ad, function ($value) {
			// La fonction de rappel retourne true pour les valeurs non vides
			return null !== $value && '' !== $value && false !== $value;
		});
	}
}
