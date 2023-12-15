<?php

namespace App\Http\classes;

use App\Http\Controllers\AdController;

class AdImport extends AdController
{
	public function index()
	{
		$this->ad = $this->getFiles();
		// echo $this->nFile;

		return $this->ad[$this->nFile];
	}

	
}
