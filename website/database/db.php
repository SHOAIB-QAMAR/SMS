<?php
// ==========================================
// CENTRAL DATABASE CONFIGURATION
// ==========================================
// For InfinityFree, update these values from your Control Panel
$host = "localhost";
$user = "root";
$password = "yourpassword"; 
$db = "sms";

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

// Map $conn to $data for compatibility with Panel files
$conn = $data;
?>