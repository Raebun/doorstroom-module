<?php

function connectToDatabase() {
    $serverName = 'localhost';
    $username = "root";
    $password = "";
    $db = 'cookbook';

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
