<?php

namespace App\Http\Controllers;

use App\Http\classes\ExportManager;
use App\Http\classes\IaManager;
use App\Http\Tools\Gc7;

class AdController extends Controller
{
	protected $aff = 1;

	// protected $exports;

	protected $fileN = 0; // @i Choix numéro de fichier

	protected $adN = 2; // @i Choix numéro de l'annonce dans la liste

	protected $file;

	protected $askAi = 0; // @i Choix mode IA - 0 simu - 1 réel

	protected $error;

	public function __construct()
	{
		ini_set('max_execution_time', '0');
		date_default_timezone_set('Europe/Paris');
		// $this->ads = (new ExportManager())->getAds();
		$this->file = (new ExportManager())->exports;
		Gc7::affH($this->file->ads[$this->adN]); // The selected Ad
		// Gc7::aff($this->file->ads); // The ads
	}

	// @i Called by /test
	public function index()
	{
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
		return 'Fichier #' . $this->fileN;
	}
}
