<?php

$server = 'localhost';
$username = 'pharmave_notas';
$password = 'DS2020.PP2';
$database = 'pharmave_notas';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
