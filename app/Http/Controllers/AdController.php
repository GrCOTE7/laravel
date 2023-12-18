<?php

namespace App\Http\Controllers;

use App\Http\classes\ExportManager;
use App\Http\classes\IaManager;
use App\Http\Tools\Gc7;

class AdController extends Controller
{
	protected $aff = 1;

	protected $exports;

	protected $fileN = 2; // @i Choix numéro de fichier

	protected $fileName; // Complete path + Name

	protected $adN = 1; // @i Choix numéro de l'annonce dans la liste

	protected $ads;

	protected $askAi = 0; // @i Choix mode IA - 0 simu - 1 réel

	protected $error;

	public function __construct()
	{
		ini_set('max_execution_time', '0');
		date_default_timezone_set('Europe/Paris');
		$this->ads = new ExportManager();
		// $this->ads = $this->exports->files[$this->fileN]['ads'];
	}

	// @i Called by /test
	public function index()
	{
		// phpinfo();
		$this->exports = (new ExportManager())->exportFilesToHtmlTable();
		// Gc7::aff($this->exports);
		// Gc7::aff($this->exports->selectedFile);

		// $this->ads = $ads = $this->exports->ads[$this->fileN]['ads'];
		// Gc7::aff($this->fileN);
		// Gc7::aff($this->ads->exports->files[$this->fileN]['ads'][$this->adN]);
		// Gc7::aff($this, '***');

		// $newFields = (new IaManager())->getFields($ads);

		// Gc7::aff($newFields, '$newFields');

		// return $this->ads->exports->selectedFile->name;
		return 'Fichier #' . $this->fileN . ' (' . $this->ads->exports->selectedFile->name . ') - ' . count($this->ads->exports->selectedFile->ads) . ' ads.';
	}
}
