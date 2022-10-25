<?php

try {
    # PDO(PHP Data Objects) is used to connect to the database
    #PDO library has methods that helps in interacting with the database


} catch (PDOException $ex) {
    #If there's error when connecting to the database, catch the error and display relevant message
    echo ("Failed to connect to the database.<br>");
    echo ($ex->getMessage());
    exit; # stop executing script
}
