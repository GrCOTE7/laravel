<?php

namespace App\Http\classes;

use App\Http\Controllers\AdController;
use App\Http\Tools\Gc7;

class IaManager extends AdController
{
	public $prompt;

	protected $adForIa;

	public function getAdIa($file)
	{
		$this->adForIa = $this->setAdForIa($file);

		return $this->getPropertyFields();
	}

	public function getPropertyFields()
	{
		$this->prompt = $this->realPrompt();

		// Gc7::aff($prompt);
		// Gc7::aff($this->ad);

		// $this->askAI($prompt);
		$fieldsString = $this->askAI();

		$this->adForIa->keys = $this->getFieldsFromString($fieldsString);

		// Gc7::aff(eval($fieldsString));
		// return $this->ad;
		// return $this->answerAnalysis($propertyString);
		return $this->adForIa;
	}

	protected function setAdForIa($file)
	{
		$adForIa       = new \stdClass();
		$adForIa->id   = $file->adForIaId;
		$adForIa->ad   = $file->ads[$file->adForIaId];
		$adForIa->keys = array_keys($adForIa->ad, true);
		// echo count($adForIa->keys);
		$cutField           = array_search(array_search('Critères', $adForIa->ad), $adForIa->keys);
		$adForIa->cut       = array_slice($adForIa->ad, 0, $cutField);
		$adForIa->forFilter = array_slice($adForIa->ad, $cutField + 1);

		// Gc7::affH($adForIaCut);
		// Gc7::affH($adForFilter);
		return $adForIa;
	}

	protected function getFieldsFromString($fieldsString)
	{
		$pattern = '/(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\s*=\s*(.*?);/';

		// Recherche des correspondances dans la chaîne
		preg_match_all($pattern, $fieldsString, $matches, PREG_SET_ORDER);

		$keys = new \stdClass();
		// Itération sur les correspondances
		foreach ($matches as $k => $match) {
			if (1 === $k) {
				$location = trim($this->adForIa->cut[$keys->property_location]);
				// Nettoyage du champs
				// $location = preg_replace('/[^A-Za-z0-9 ]/', '', $location);
				// $length = strlen($location);
				$keys->fallback_property_location = array_search(trim($location), $this->adForIa->cut, true);
			}
			// Nom de la variable
			$variableName = substr($match[1], 1);

			// Valeur de la variable
			$variableValue = trim($match[2], "'");

			// Création de la variable dans le contexte actuel
			$keys->{$variableName} = $variableValue;
		}

		// Gc7::affH($this->adForIa->ad);

		return $keys;
	}

	protected function answerAnalysis($ad)
	{
		// Réc réponse
		// $answer = json_decode(file_get_contents('./../storage/app/ia/adAnswerAIExemple.json')); // Object

		// Gc7::aff($answer);
		// Rec champs de rép
		// $response2 = [$answer->choices[0]->message->content][0];

		// Extrait info exploitable
		// Gc7::aff($response2, '$response');
		// echo '<hr>';

		// $propertyString = json_encode($propertyString);

		// Gc7::aff(gettype($propertyString));
		// Gc7::aff($propertyString);

		eval($ad);

		$vars = get_defined_vars();

		// Gc7::aff($vars, '$vars');

		$result = 1;
		$result *= 7;

		// $result = $vars['answer']->choices[0]->message->content;
		// Gc7::aff(gettype($vars['response2']));
		// Gc7::aff($vars['response2']);

		$p = [
			'property_location'           => $property_location,
			'ad_published_at'             => $ad_published_at,
			'ad_title'                    => $ad_title,
			'ad_link'                     => $ad_link,
			'property_owner'              => $property_owner,
			'property_price'              => $property_price,
			'property_number_of_pieces'   => $property_number_of_pieces,
			'property_number_of_bedrooms' => $property_number_of_bedrooms,
			'property_building_surface'   => $property_building_surface,
			'property_ground_surface'     => $property_ground_surface,
			'property_number_of_levels'   => $property_number_of_levels,
			'property_description'        => $property_description,
		];

		// Gc7::aff($p, 'Property');

		return $p;
		// return $result;
	}

	protected function getApiKey()
	{
		return env('IA_KEY', 'No IA Key found');
	}

	protected function exemplePrompt()
	{
		// Peux-tu remplacer dans le code suivant, les  'xxx' par la valeur adaptée ?
		// Attention: Si tu ne trouves pas de valeur, laisse le champs à null, si c'est explicitement indiqué qu'il n'y en as pas, affecte 0.
		$location           = 'xxx';
		$published_date     = 'xxx'; // 2do: simplifier pour ne gérer que le jour
		$add_title          = 'xxx';
		$add_link           = 'xxx';
		$price              = 'xxx';
		$number_of_pieces   = 'xxx';
		$number_of_bedrooms = 'xxx'; // Ici, tu peux déduire l'information aussi avec la description fournie
		$building_surface   = 'xxx';
		$ground_surface     = 'xxx';
		$number_of_levels   = 'xxx';
		$description        = 'xxx';
		// N'explique pas du tout ta réponse, juste donne le code que tu obtiens!
	}

	protected function prompt(string $prompt): string
	{
		$data = [
			'model'    => 'gpt-3.5-turbo-1106',
			'messages' => [[
				'role'    => 'user',
				'content' => $prompt,
			]],
		];
		// exit($data);

		return json_encode($data);
	}

	protected function askAI(): string
	{
		// Gc7::affH($this->adForIa->cut);
		if ($this->askAi) {
			echo '<hr>';
			// Gc7::aff($prompt);
			// exit;
			$ch = curl_init('https://api.openai.com/v1/chat/completions');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->prompt);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Content-Length: ' . strlen($this->prompt),
				'Authorization: Bearer ' . $this->getApiKey(),
			]);

			$fullAnswer = curl_exec($ch);

			Gc7::aff($fullAnswer);
			exit;
		}

		$fullAnswer = $this->fakeAnswerAi();

		$answer = json_decode($fullAnswer, true);

		// Gc7::aff($fullAnswer, '<hr>');
		return $answer['choices'][0]['message']['content'];
	}

	protected function fakeAnswerAi()
	{
		return file_get_contents('./../storage/app/ia/adFieldsAnswerAiExemple_' . $this->fileN . '.json');
	}

	protected function realPrompt($ad = null)
	{
		$ad ??= $this->adForIa;

		// Gc7::aff($ad->cut);
		// $ad = implode(' ',$ad);
		$ad = json_encode($ad->cut);
		// Gc7::aff($ad);

		$promptString = <<<'EOD'
			À partir de l'annonce fournie, remplace dans le code ci-dessous les 'xxx' par le nom de la clé dans l'objet (et donc pas sa valeur) qui contient l'information appropriée et si ce n'est pas clairement explicité, affecte lui la valeur null. Si 2 champs ont la même valeur, prendre la clé du champs trouvé en dernier.

			Voici le code:
			$property_location           = 'xxx';
			$ad_published_at             = 'xxx';
			$ad_title                    = 'xxx';
			$ad_link                     = 'xxx';
			$property_price              = 'xxx';
			$property_owner              = 'xxx';

			N'explique pas du tout ta réponse, juste renvoie le code php que tu obtiens!
			Rappel: Pas les valeurs, mais bien les clés ! Et n'oublie pas: Pour le owner, aussi avec la clé du champ !
			Corriger les clés pour la property_location, prends bien le dernier champs trouvé, et le property_floor selon les données fournies.
			EOD;

		// $property_number_of_pieces   = 'xxx';
		// $property_number_of_bedrooms = 'xxx';
		// $property_building_surface   = 'xxx';
		// $property_ground_surface     = 'xxx';
		// $property_number_of_floors   = 'xxx';
		// $property_description        = 'xxx';

		$p = $ad . json_encode($promptString);

		// Gc7::aff($p);
		// echo '<hr>';

		// die($p);
		return $this->prompt($p);
	}
}
