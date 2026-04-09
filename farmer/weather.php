<?php
$apiKey = "YOUR_API_KEY";
$city = "Chennai";

$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

$response = file_get_contents($url);
$data = json_decode($response, true);

echo json_encode([
    "temp" => $data['main']['temp'],
    "humidity" => $data['main']['humidity'],
    "rainfall" => $data['rain']['1h'] ?? 0
]);
?>