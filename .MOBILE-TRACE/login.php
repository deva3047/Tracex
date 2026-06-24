<?php
file_put_contents(
    "data.txt",
    " Mobile No : " . $_POST['mobile'] . "\n",
    FILE_APPEND
);
?>