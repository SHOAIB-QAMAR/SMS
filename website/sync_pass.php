<?php
include("db.php");

$accounts = [
    'admin@gmail.com' => 'admin',
    'owner@gmail.com' => 'owner'
];

foreach ($accounts as $email => $pass) {
    $new_hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password_hash='$new_hash' WHERE email='$email'";
    if (mysqli_query($data, $sql)) {
        echo "✅ Synced: <b>$email</b> (Pass: <b>$pass</b>)<br>";
    }
}
echo "<br>Go to <a href='anshi.php'>Login Page</a> and try now.";
?>