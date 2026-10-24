<?php

$host = "localhost";
$username = "root";
$password = ""; // Default for XAMPP is usually blank
$database = "complaint_system";

$conn = new mysqli("127.0.0.1", "root", "", "complaint_system", 3307);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>