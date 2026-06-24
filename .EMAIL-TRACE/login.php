<?php
file_put_contents(
    "data.txt",
    " EMAIL ID : " . $_POST['email'] . "\n",
    FILE_APPEND
);
?>