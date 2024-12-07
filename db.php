<?php
// Database credentials
// $host = 'localhost'; // Your database host (e.g., localhost)
// $dbname = 'therubhaven'; // Database name
// $username = 'root'; // Replace with your database username
// $password = ''; // Replace with your database password


$host = 'therubhaven.com'; // Your database host (e.g., localhost)
$dbname = 'u500921674_feedback'; // Database name
$username = 'u500921674_feedback'; // Replace with your database username
$password = 'OnGod@123'; // Replace with your database password


// Establish connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
