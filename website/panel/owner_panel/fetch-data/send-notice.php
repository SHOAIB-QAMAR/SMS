<?php
session_start();
include("../../assets/config.php");

// Assuming form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get sender info from session
    if (!isset($_SESSION['uid'])) {
        die("Error: Session expired or user not logged in.");
    }
    
    $sender_id = $_SESSION['uid'];
    $editor_id = $sender_id;

    // Retrieve form data 
    $panel = mysqli_real_escape_string($conn, $_POST['panel']);
    $class = mysqli_real_escape_string($conn, $_POST['cla']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into database - Providing values for all required columns
    $query = "INSERT INTO notice(sender_id, editor_id, title, body, role, class, file, importance) 
              VALUES ('$sender_id', '$editor_id', '$title', '$message', '$panel', '$class', '', '1')";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Notice saved successfully.";
    } else {
        // Handle database error
        echo "Database Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: Invalid request method.";
}
