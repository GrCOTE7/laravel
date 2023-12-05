<?php

namespace App\Http\Tools;

class TestIA
{
	private $apiKey;

	private $test = 1;

	public function index()
	{
		return $this->whatIsEncens();
	}

	private function getApiKey()
	{
		return env('IA_KEY', 'No IA Key found');
	}

	private function getPrompt()
	{
		// Peux-tu remplacer dans le code suivant, les  '???' par la valeur adaptée ?
		// Attention: Si tu ne trouves pas de valeur, laisse le champs à null, si c'est explicitement indiqué qu'il n'y en as pas, affecte 0.
		$location           = '???';
		$published_date     = '???'; // Ici on veut le format Y-m-d h:i
		$add_title          = '???';
		$add_link           = '???';
		$price              = '???';
		$number_of_pieces   = '???';
		$number_of_bedrooms = '???'; // Ici, tu peux déduire l'information aussi avec la description fournie
		$building_surface   = '???';
		$ground_surface     = '???';
		$number_of_levels   = '???';
		$description        = '???';
		// N'explique pas du tout ta réponse, juste donne le code que tu obtiens!
	}

	private function whatIsEncens()
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
}
