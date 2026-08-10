<?php
$servername = "localhost";
$username = "root";        // your database username
$password = "eno#098";            // your database password
$dbname = "bnk_db"; // database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>