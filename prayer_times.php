<?php 
$city = "Casablanca";
$country = "Morocco"; 
$date = 'today';
$apiUrl = "https://api.aladhan.com/v1/timingsByCity/$date?city=$city&country=$country";

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