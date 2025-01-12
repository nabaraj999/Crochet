<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crochet";
$port = 3307; // Define the port if it's different from the default

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
