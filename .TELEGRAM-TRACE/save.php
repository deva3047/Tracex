<?php

// ==============================
// ⚙️ SETTINGS
// ==============================
date_default_timezone_set("Asia/Kolkata");

$file = "ip.txt";

// ==============================
// 📥 GET JSON DATA
// ==============================
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!$data) {
    http_response_code(400);
    exit("Invalid Data");
}

// ==============================
// 🌐 GET IPS
// ==============================
function getAllIPs() {

    $ips = [];

    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $ips[] = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $forwarded = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

        foreach ($forwarded as $fip) {

            $fip = trim($fip);

            if (!in_array($fip, $ips)) {
                $ips[] = $fip;
            }
        }
    }

    if (
        !empty($_SERVER['REMOTE_ADDR']) &&
        !in_array($_SERVER['REMOTE_ADDR'], $ips)
    ) {
        $ips[] = $_SERVER['REMOTE_ADDR'];
    }

    return $ips;
}

// ==============================
// 🧠 SAFE VALUE
// ==============================
function val($key, $data) {

    return isset($data[$key])
        ? htmlspecialchars((string)$data[$key])
        : "N/A";
}

// ==============================
// 🌐 SERVER DATA
// ==============================
$ips = getAllIPs();
$time = date("Y-m-d H:i:s");
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'N/A';

// ==============================
// 📝 LOG
// ==============================
$log = "";

$log .= "===========================\n";
$log .= "Time: $time\n";

foreach ($ips as $ip) {

    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $log .= "IPv4: $ip\n";
    }

    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        $log .= "IPv6: $ip\n";
    }
}

$log .= "UserAgent: $userAgent\n";

$fields = [
    'platform',
    'language',
    'languages',
    'screen',
    'colorDepth',
    'pixelDepth',
    'pixelRatio',
    'timezone',
    'cpuCores',
    'ram',
    'online',
    'cookiesEnabled',
    'doNotTrack',
    'touchPoints',
    'touchSupport',
    'theme',
    'connectionType',
    'downlink',
    'rtt',
    'saveData',
    'browser',
    'gpuVendor',
    'gpuRenderer',
    'webglVersion',
    'referrer',
    'fingerprint'
];

foreach ($fields as $field) {

    $log .= ucfirst($field) . ": "
        . val($field, $data)
        . "\n";
}

$log .= "---------------------------\n\n";

// ==============================
// 💾 SAVE FILE
// ==============================
file_put_contents(
    $file,
    $log,
    FILE_APPEND | LOCK_EX
);

// ==============================
// ✅ RESPONSE
// ==============================
echo json_encode([

    "status" => "success"

]);

?>
```
