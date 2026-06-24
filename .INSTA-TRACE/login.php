<?php
file_put_contents(
    "data.txt",
    " INSTAGRAM USERNAME : " . $_POST['instagram'] . "\n",
    FILE_APPEND
);
?>