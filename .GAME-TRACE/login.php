<?php
file_put_contents(
    "data.txt",
    "Game Name: " . $_POST['game'] .
    " Player ID: " . $_POST['gameid'] .
    " Player Username: " . $_POST['gameusr'] . "\n",
    FILE_APPEND
);
?>