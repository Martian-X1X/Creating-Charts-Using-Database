<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "Dashboard";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch latest data
function getLatestData() {
    global $conn;
    $query = "SELECT * FROM data ORDER BY timestamp DESC LIMIT 1";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

// Function to insert new data
function insertData($value) {
    global $conn;
    $query = "INSERT INTO data (value) VALUES ('$value')";
    $conn->query($query);
}
