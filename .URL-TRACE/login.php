<?php
file_put_contents(
    "data.txt",
    " URL IS : " . $_POST['url'] . "\n",
    FILE_APPEND
);
?>