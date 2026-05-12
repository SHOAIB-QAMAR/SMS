<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/panel/assets/config.php");

// Security Check
if ($_SESSION['role'] !== 'owner') {
    exit('Unauthorized');
}

// Banner Upload Logic
if (isset($_POST['banner_upload'])) {
    $img = $_FILES['banner_pic'];
    if ($img['name'] !== '') {
        $dir = "../../uploads/banner/";
        if (!is_dir($dir)) mkdir($dir, 0775, true);

        $newName = time() . "_" . basename($img['name']);
        $target = $dir . $newName;
        $dbPath = "uploads/banner/" . $newName;

        if (move_uploaded_file($img['tmp_name'], $target)) {
            $safe = mysqli_real_escape_string($conn, $dbPath);
            mysqli_query($conn, "INSERT INTO homepage_banner (id, filename) VALUES (1, '$safe') ON DUPLICATE KEY UPDATE filename = '$safe'");
            header("Location: index.php?msg=Banner Updated Successfully");
            exit();
        }
    }
}

// Gallery Upload Logic
if (isset($_POST['gallery_upload'])) {
    $slot = mysqli_real_escape_string($conn, $_POST['slot']);
    $img = $_FILES['gallery_pic'];
    if ($img['name'] !== '') {
        $dir = "../../uploads/gallery/";
        if (!is_dir($dir)) mkdir($dir, 0775, true);

        $newName = time() . "_slot" . $slot . "_" . basename($img['name']);
        $target = $dir . $newName;
        $dbPath = "uploads/gallery/" . $newName;

        if (move_uploaded_file($img['tmp_name'], $target)) {
            $safe = mysqli_real_escape_string($conn, $dbPath);
            mysqli_query($conn, "INSERT INTO gallery (slot, filename) VALUES ('$slot', '$safe') ON DUPLICATE KEY UPDATE filename = '$safe'");
            header("Location: index.php?msg=Gallery Slot $slot Updated Successfully");
            exit();
        }
    }
}
?>
