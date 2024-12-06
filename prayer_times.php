<?php 

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim(end($ipList));
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


$city = "Casablanca";
$country = "Morocco"; 

$clientIP = getUserIP();

if($clientIP!='127.0.0.1'){
	
	$apiKey = "c8f42921c9d53376ea5552e74178e47f"; 
	$apiUrl = "http://api.ipstack.com/$clientIP?access_key=$apiKey";

	// Fetch location data from the API
	$response = file_get_contents($apiUrl);
	$locationData = json_decode($response, true);

	//Get City and Country name
	if (!empty($locationData) && isset($locationData['city']) && isset($locationData['country_name'])) {
		$city = $locationData['city'];
		$country = $locationData['country_name'];
	} 
}


$date = 'today';

// Base URL
$baseUrl = "https://api.aladhan.com/v1/timingsByCity/today";

// Query parameters
$queryParams = [
    'city' => $city,
    'country' => $country
];

// Build the full URL
$encodedQuery = http_build_query($queryParams);
$apiUrl = $baseUrl . '?' . $encodedQuery;

// Get the content
$response = file_get_contents($apiUrl);

$data = json_decode($response, false);

$fajr = $data->data->timings->Fajr;
$dhuhr = $data->data->timings->Dhuhr;
$asr = $data->data->timings->Asr;
$maghrib = $data->data->timings->Maghrib;
$isha = $data->data->timings->Isha;


echo json_encode([
    'fajr' => $fajr,
    'dhuhr' => $dhuhr,
    'asr' => $asr,
    'maghrib' => $maghrib,
    'isha' => $isha,
]);

?>