<?php

// 2fix Dès que clé API - NB: Remplir Postfields
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL            => 'https://api.fluximmo.io/v2/protected/experimental/estimate',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING       => '',
	CURLOPT_MAXREDIRS      => 10,
	CURLOPT_TIMEOUT        => 30,
	CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST  => 'POST',
	CURLOPT_POSTFIELDS     => "{\n  \"property\": {\n    \"bedroomsCount\": 123,\n    \"isRecent\": true,\n    \"landSurfaceArea\": 123,\n    \"lat\": 123,\n    \"lon\": 123,\n    \"newProperty\": true,\n    \"pool\": true,\n    \"propertyType\": \"HOUSE\",\n    \"roomsCount\": 123,\n    \"surfaceArea\": 123,\n    \"workToDo\": true\n  }\n}",
	CURLOPT_HTTPHEADER     => [
		'Content-Type: application/json',
		'x-api-key: <x-api-key>',
	],
]);

$response = curl_exec($curl);
$err      = curl_error($curl);

curl_close($curl);

if ($err) {
	echo 'cURL Error #:' . $err;
} else {
	echo $response;
}
