<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auth";

// Create connection
try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Check connection
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>