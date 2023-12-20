<?php

namespace App\Http\classes;

use App\Http\Controllers\AdController;
use App\Http\Tools\Gc7;

class IaManager extends AdController
{
    public $prompt;
	public function index()
	{
         return $this->getPropertyFields();
	}

	public function getPropertyFields()
	{
		$prompt = $this->realPrompt();

		// Gc7::aff($prompt);
		// Gc7::aff($this->ad);

		// $this->askAI($prompt);
		$propertyString = $this->askAI();

		// Gc7::aff($propertyString);
		// return $this->ad;
		return $this->answerAnalysis($propertyString);
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
			'model'    => 'gpt-3.5-turbo',
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
		if ($this->askAi) {
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

			// Gc7::aff($ch, 'ch');
			$fullAnswer = curl_exec($ch); // Complete Json Response

		// Gc7::aff($fullAnswer);
		// exit;
		} else {
			$fullAnswer = $this->fakeAnswerAi();
		}

		// return $fullAnswer;
		$answer = json_decode($fullAnswer, true);
		// Gc7::aff($fullAnswer, 'Answer');

		// exit;
		return $answer['choices'][0]['message']['content'];
	}

	protected function fakeAnswerAi()
	{
		return file_get_contents('./../storage/app/ia/adAnswerAiExemple.json');
	}

	protected function realPrompt($ad = null)
	{
		$ad ??= $this->file->adForIa;

		// Gc7::aff($ad);
		// $ad = implode(' ',$ad);
		$ad = json_encode($ad);
		// Gc7::aff($ad);

		$promptString = <<<'EOD'
			<hr>
			À partir de l'annonce ci-avant, remplace dans le code ci-dessous les 'xxx' par le nom de la clé dans l'objet (et donc pas sa valeur) qui contient l'information appropriée et si ce n'est pas clairement explicité, affecte lui la valeur null.

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

		$p = $ad. json_encode($promptString);

		// die($p);
		return $this->prompt($p);
	}
}
