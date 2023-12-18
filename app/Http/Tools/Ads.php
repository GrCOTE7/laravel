<?php

namespace App\Http\Tools;

use App\Http\Controllers\ImportController;

class Ads
{
	protected $apiKey;

	protected $ads;

	protected $realAskAI;

	protected $aff;

	// public function __construct(array $ad, ?int $realAskAI = 0, ?int $aff = 0)
	// {
	// 	$this->ad        = $ad;
	// 	$this->realAskAI = $realAskAI;
	// 	$this->aff       = $aff;
	// }

	public function index()
	{
		// 2ar CHOIX du Fichier - 1 #0 pour fake ad
		$nFile = 0;
		// 2ar IA Mode reel ?
		$IAMode = 0;
		// 2ar # ad in jsonFile
		$adN = 5;
		// 2ar Affichage Debug
		$aff = 1;

		$this->nFile  = $nFile;
		$this->IAMode = $IAMode;
		$this->adN    = $adN;
		$this->aff    = $aff;

		return $this->getNewAdLength();
	}

	protected function getNewAdLength()
	{
		$this->apiKey = $ads = (new ImportController())->getParamsFromTest($this->nFile, $this->IAMode, $this->adN, $this->aff);
		// Gc7::affH($ads[0]);
		$adsNum = array_values($ads[$this->adN]);

		// Gc7::affH($ads[0]);

		// Gc7::aff(count($adsNum));
		$ads[$this->adN] = array_slice($ads[$this->adN], 0, array_search('Calculer mes mensualités', $adsNum));
		// Gc7::aff($adsNum);
		$newLength = count($ads[0]);
		// Gc7::aff(count($ads[0]));

		// Gc7::affH($ads[$this->adN]);

		// echo json_encode($ads[$this->adN]);

		$promptString = <<<'EOD'
			<hr>
			À partir de l'annonce qui suit, remplace dans le code ci-dessous les 'xxx' par le nom de la clé dans l'objet (et donc pas sa valeur) qui contient l'information appropriée et si ce n'est pas clairement explicité, affecte lui la valeur null.

			Voici le code:
			$property_location           = 'xxx';
			$ad_published_at             = 'xxx';
			$ad_title                    = 'xxx';
			$ad_link                     = 'xxx';
			$property_price              = 'xxx';
			$property_number_of_pieces   = 'xxx';
			$property_number_of_bedrooms = 'xxx';
			$property_building_surface   = 'xxx';
			$property_ground_surface     = 'xxx';
			$property_number_of_levels   = 'xxx';
			$property_description        = 'xxx';
			$property_owner              = 'xxx';

			N'explique pas du tout ta réponse, juste renvoie le code que tu obtiens!
			Rappel: Pas les valeurs, mais bien les clés ! Et n'oublie pas le owner !
			EOD;

		echo json_encode($promptString) . json_encode($ads[$this->adN]);

		$promptJson = <<<'EOD'
			{"prompt": "Remplace dans le code ci-dessous, les 'xxx' par le nom de la clé dans l'objet (et donc pas sa valeur) qui contient l'information appropriée. Si ce n'est pas clairement explicité, affecte lui la valeur null.\n\nVoici le code:\n$property_location = 'xxx';\n$ad_published_at = 'xxx';\n$ad_title = 'xxx';\n$ad_link = 'xxx';\n$property_price = 'xxx';\n$property_number_of_pieces = 'xxx';\n$property_number_of_bedrooms = 'xxx';\n$property_building_surface = 'xxx';\n$property_ground_surface = 'xxx';\n$property_number_of_levels = 'xxx';\n$property_description = 'xxx';\n$property_owner = 'xxx';\n\nN'explique pas du tout ta réponse, juste renvoie le code que tu obtiens!\nRappel: Pas les valeurs, mais bien les clés ! Et n'oublie pas le owner !"}
			EOD;

		// echo $promptString.json_encode($ads[$this->adN]);
		// die($promptJson);
		// bravo ! Donne moi le prompt complet qui serait nécessaire pour l'api chat-gpt
		// echo json_encode($ads[0]);
		// echo json_encode($promptString);
		// exit;

		$longs = [];
		foreach ($ads as $n => $ad) {
			$long = 0;
			// foreach ($ad as $k => $v) {
			// 	$long += strlen($v);
			// 	echo str_repeat(' ', 7) . $k . ' → ' . strlen($v) . '<br>';
			// }
			// echo str_repeat('&nbsp;', 7) . $n . ' → ' . $long . '<br>';
			// $longs[] = $long;
		}

		// Gc7::aff($longs);
		// Gc7::affH($ads[array_search(min($longs), $longs)]);
		return $newLength;
	}

	protected function cutAds()
	{
	}
}
