<?php

namespace App\Http\Controllers;

use App\Http\classes\AdImport;

class AdController extends Controller
{
	public $ad;

	protected $aff;

	protected $nFile=1; //@i Choix numéro de fichier

	protected $file;

	protected $ads;

	protected $error;

	protected $_adJson;

	public function __construct()
	{
		ini_set('max_execution_time', '0');
	}

	public function index()
	{
        // echo $this->nFile;
		return (new AdImport())->index();
	}
}
