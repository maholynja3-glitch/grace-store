<?php
// Configuration ny database
$host = "localhost";
$user = "root"; 
$pass = ""; 
$dbname = "grace_store";

// Mamorona fifandraisana (Connection)
$conn = new mysqli($host, $user, $pass, $dbname);

// Hamarina raha mandeha ny fifandraisana
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mba tsy hisy olana ny lofony sy ny marika manokana
$conn->set_charset("utf8mb4");
?>