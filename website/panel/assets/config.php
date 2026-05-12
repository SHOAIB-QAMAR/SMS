<?php
// Include the central database configuration from the root directory
include($_SERVER['DOCUMENT_ROOT'] . "/database/db.php");

// If connection fails, redirected to error page (as per original logic)
if (!$conn) {
    header('Location: ../errors/error.html');
    exit();
}
?>