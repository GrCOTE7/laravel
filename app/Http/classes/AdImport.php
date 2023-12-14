<?php

namespace App\Http\classes;

use App\Http\Controllers\AdController;

class AdImport extends AdController
{
	public function index()
	{
		$this->ad = $this->getFiles();

		return $this->ad;
	}

	public function getFiles()
	{
		// Chemin du répertoire à lister
		$repertoire = './../storage/app/exports';
		$files      = [];

		// Ouvre le répertoire
		if ($gestionnaire = opendir($repertoire)) {
			// Parcours chaque fichier du répertoire
			while (false !== ($fichier = readdir($gestionnaire))) {
				// Exclut les entrées "." et ".."
				if ('.' != $fichier && '..' != $fichier) {
					// Affiche le nom du fichier
					if ('json' === pathinfo($fichier, PATHINFO_EXTENSION)) {
						// Affiche le nom du fichier
						$files[] = $fichier;
					}
				}
			}
			// Ferme le gestionnaire de fichier
			closedir($gestionnaire);
		} else {
			// En cas d'erreur d'ouverture du répertoire
			$files = null;
		}

		return $files;
	}
}
