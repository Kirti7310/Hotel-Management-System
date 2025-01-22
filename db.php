<?php
$username = "root";
$password = "";
$hostname = "localhost";
$db_name = "hotel_managementt"; 
try {
    $conn = new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>