<?php include("../assets/noSessionRedirect.php"); ?>
<?php include("./fetch-data/verfyRoleRedirect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Owner Dashboard - EduCore</title>
    <link rel="icon" type="image/x-icon" href="../images/1.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/oranbyte-google-translator.css">

</head>
<?php
include("../assets/config.php");
session_start();

$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : "light";
?>

<body class='<?php echo $theme; ?>'>

    <div class='toast-container position-fixed text-success bottom-0 end-0 p-3' style="z-index: 9000;">
        <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style="color:black;">
            <div class='d-flex'>
                <div class='toast-body' id="toast-alert-message">

                </div>
                <button type='button' class='btn-close me-2 m-auto text-danger' data-bs-dismiss='toast'
                    aria-label='Close'></button>
            </div>
        </div>
    </div>
