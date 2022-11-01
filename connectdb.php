<?php

$host = '127.0.0.1';
$dbname   = 'test';
$username = 'root';
$password = '';

try {
    # PDO(PHP Data Objects) is used to connect to the database
    #PDO library has methods that helps in interacting with the database
	$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $ex) {
    #If there's error when connecting to the database, catch the error and display relevant message
    echo ("Failed to connect to the database.<br>");
    echo ($ex->getMessage());
    exit; # stop executing script
}
