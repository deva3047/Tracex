<?php
if (isset($_POST['ip'])) {

    $ip = trim($_POST['ip']);

    file_put_contents(
        "data.txt",
        "IP ADDRESS : " . $ip . PHP_EOL,
        FILE_APPEND
    );
}
?>