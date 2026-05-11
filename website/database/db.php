<?php
$host = "localhost";
$user = "root";
$password = "yourpassword"; // Assuming empty password for local, update if your Dashboard uses one
$db = "sms";    // Pointing to the consolidated database

$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}
?>