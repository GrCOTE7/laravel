<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IaController extends Controller
{
	protected $apiKey;

	protected $ad;

	protected $realAskAi;

	protected $aff;

	public function __construct(array $ad, ?int $realAskAi = 0, ?int $aff = 0)
	{
		$this->ad        = $ad;
		$this->realAskAi = $realAskAi;
		$this->aff       = $aff;
	}

	public function index()
	{
		// return $this->realPrompt();
		// return $this->whatIsCompletion();
		// return $this->getProperty();
		return $this->answerAnalysis();
	}

	public function getProperty()
	{
		$prompt = $this->realPrompt($this->ad);

		// Gc7::aff($prompt);
		// Gc7::aff($this->ad);

		// $this->askAI($prompt);
		$propertyString = $this->askAI($prompt);

		// Gc7::aff($propertyString);
		// return $this->ad;
		return $this->answerAnalysis($propertyString);
	}

	protected function answerAnalysis($propertyString)
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

		eval($propertyString);

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

	protected function whatIsCompletion()
	{
		$prompt = $this->prompt("Qu'est-ce que la completion?");

		// die($answer);
		return $this->askAI($prompt);
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

	protected function whatIsEncens()
	{
		// 2ar ApiKey
		$apiKey = $this->getApiKey();
		$data   = [
			'model'    => 'gpt-3.5-turbo',
			'messages' => [[
				'role'    => 'user',
				'content' => "Qu'est-ce que l'encens?",
			]],
		];
		$data_string = json_encode($data);

		// echo $data_string . '<hr>';

		// { "id": "chatcmpl-8STJBJJymIxqEMWKS9wItrOSf0GvW", "object": "chat.completion", "created": 1701796537, "model": "gpt-3.5-turbo-0613", "choices": [ { "index": 0, "message": { "role": "assistant", "content": "L'encens est une substance aromatique obtenue à partir de plantes, de résines ou d'huiles essentielles, utilisée depuis des milliers d'années pour ses propriétés parfumantes et thérapeutiques. Il est souvent brûlé lors de rituels religieux et spirituels, pour purifier l'air, favoriser la méditation, créer une atmosphère harmonieuse ou simplement diffuser un agréable parfum. L'encens se présente sous différentes formes, telles que des bâtonnets, des cônes, des grains ou des résines, et il existe de nombreuses variétés avec des senteurs diverses, comme la lavande, le jasmin, le santal ou la sauge." }, "finish_reason": "stop" } ], "usage": { "prompt_tokens": 16, "completion_tokens": 172, "total_tokens": 188 }, "system_fingerprint": null }

		if (!$this->test) {
			$ch = curl_init('https://api.openai.com/v1/chat/completions');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_string),
				'Authorization: Bearer ' . $apiKey,
			]);

			return curl_exec($ch); // Complete Json Response
			// { "id": "chatcmpl-8STJBJJymIxqEMWKS9wItrOSf0GvW", "object": "chat.completion", "created": 1701796537, "model": "gpt-3.5-turbo-0613", "choices": [ { "index": 0, "message": { "role": "assistant", "content": "L'encens est une substance aromatique obtenue à partir de plantes, de résines ou d'huiles essentielles, utilisée depuis des milliers d'années pour ses propriétés parfumantes et thérapeutiques. Il est souvent brûlé lors de rituels religieux et spirituels, pour purifier l'air, favoriser la méditation, créer une atmosphère harmonieuse ou simplement diffuser un agréable parfum. L'encens se présente sous différentes formes, telles que des bâtonnets, des cônes, des grains ou des résines, et il existe de nombreuses variétés avec des senteurs diverses, comme la lavande, le jasmin, le santal ou la sauge." }, "finish_reason": "stop" } ], "usage": { "prompt_tokens": 16, "completion_tokens": 172, "total_tokens": 188 }, "system_fingerprint": null }
		}

		$resultJson = file_get_contents('./../storage/app/ia/encens.json');
		// die( $resultJson);
		// echo $result;

		$result = json_decode($resultJson, true);

		// print_r($result);
		return $result['choices'][0]['message']['content'];
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

	protected function askAI(string $prompt): string
	{
		if ($this->realAskAI) {
			// Gc7::aff($prompt);
			// exit;
			$ch = curl_init('https://api.openai.com/v1/chat/completions');
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $prompt);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Content-Length: ' . strlen($prompt),
				'Authorization: Bearer ' . $this->getApiKey(),
			]);

			// Gc7::aff($ch, 'ch');
			$fullAnswer = curl_exec($ch); // Complete Json Response

		// Gc7::aff($fullAnswer);
		// exit;
		} else {
			$fullAnswer = $this->fakeAnswerAI();
		}

		// return $fullAnswer;
		$answer = json_decode($fullAnswer, true);
		// Gc7::aff($fullAnswer, 'Answer');

		// exit;
		return $answer['choices'][0]['message']['content'];
	}

	protected function fakeAnswerAI()
	{
		return file_get_contents('./../storage/app/ia/adAnswerAiExemple.json');
	}

	protected function realPrompt($ad = null)
	{
		$ad ??= ['Description: Petite maison de 50m² sur 2 étages avec 5 chambres avec un terrain de 500m²'];

		// Gc7::aff($ad);
		// $ad = implode(' ',$ad);
		$ad = json_encode($ad);
		// Gc7::aff($ad);

		$prompt = <<<'EOD'
			<br>
			Remplace dans le code suivant, les  'xxx' par la valeur appropriée.<br>
			Attention: Si tu ne trouves pas de valeur, laisse le champs à null, et si c'est explicitement indiqué qu'il n'y en as pas, affecte 0.<br>
			Pour le champ property_description, recopie intégralement la valeur.
			$property_location           = 'xxx';<br>
			$ad_published_at             = 'xxx'; // Génère ici le jour et l'heure selon le format 'Y-m-d H:i'
			$ad_title                    = 'xxx';<br>
			$ad_link                     = 'xxx';<br>
			$property_owner              = 'xxx';<br>
			$property_price              = 'xxx';<br>
			$property_number_of_pieces   = 'xxx';<br> // Supérieur ou égal au nombre de chambres
			$property_number_of_bedrooms = 'xxx'; // Ici, tu peux déduire l'information aussi avec la description fournie<br>
			$property_building_surface   = 'xxx';<br>
			$property_ground_surface     = 'xxx';<br>
			$property_number_of_levels   = 'xxx';<br>
			$property_description        = 'xxx';<br>
			N'explique pas du tout ta réponse, juste renvoie le code que tu obtiens!
			EOD;
		$p = $ad . json_encode($prompt);

		// die($p);
		return $this->prompt($ad . $prompt);
	}
}
