<?php

$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "moviesystem"; 
$PORT = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $PORT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
