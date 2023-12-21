<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL            => 'https://api.fluximmo.io/v2/protected/experimental/estimate',
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING       => '',
	CURLOPT_MAXREDIRS      => 10,
	CURLOPT_TIMEOUT        => 30,
	CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST  => 'POST',
	CURLOPT_POSTFIELDS     => "{\n  \"property\": {\n    \"bedroomsCount\": 2,\n    \"isRecent\": true,\n    \"landSurfaceArea\": 123,\n    \"lat\": 12,\n    \"lon\": 12,\n    \"newProperty\": true,\n    \"pool\": false,\n    \"propertyType\": \"HOUSE\",\n    \"roomsCount\": 4,\n    \"surfaceArea\": 123,\n    \"workToDo\": true\n  }\n}",
	CURLOPT_HTTPHEADER     => [
		'Content-Type: application/json',
		'x-api-key: FLUXIMMO_KEY',
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
