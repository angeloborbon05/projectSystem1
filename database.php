<?php
$servername = "localhost";
$username = "root"; // Change this if necessary
$password = ""; // Change this if necessary
$database = "auth";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
