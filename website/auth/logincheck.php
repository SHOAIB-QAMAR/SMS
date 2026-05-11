<?php
session_start();
include("../database/db.php"); // This now points to 'sms' database

// Using 'username' from login.php form as 'email' for the Dashboard table
$email = mysqli_real_escape_string($data, $_POST['username']);
$password = $_POST['password'];

// Secure Query using the Dashboard's user table
$sql = "SELECT id, role, password_hash FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($data, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Check if it's a secure hash OR a simple plain-text match (for older data)
    if (password_verify($password, $row['password_hash']) || $password === $row['password_hash']) {
        $_SESSION['uid'] = $row['id'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $email;
        $_SESSION['role'] = $row['role'];

        // Role-Based Redirection to the new 'panel' folder
        if ($row['role'] == 'owner') {
            header("Location: ../panel/owner_panel/index.php");
        } else if ($row['role'] == 'admin') {
            header("Location: ../panel/admin_panel/dashboard.php");
        } else if ($row['role'] == 'teacher') {
            header("Location: ../panel/teacher_panel/dashboard.php");
        } else if ($row['role'] == 'student') {
            header("Location: ../panel/student_panel/index.php");
        }
        exit();
    } else {
        echo "Invalid Password. <a href='login.php'>Try again</a>";
    }
} else {
    echo "User not found. <a href='login.php'>Try again</a>";
}
?>