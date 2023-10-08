<?php

// Database configuration --
$host = 'example';
$db = 'example';
$user = 'example';
$password = 'example';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // Creating connection with database using PDO --
    $pdo = new PDO($dsn, $user, $password);
    echo "Connection working!";
} catch (PDOException $err) {  // Catches the error or the exception --
    // Shows the error message --
    echo "Error while trying to connect to DB <hr>";
    echo $err;
}
