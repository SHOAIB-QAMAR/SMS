<?php
include($_SERVER['DOCUMENT_ROOT'] . "/panel/assets/config.php");
$response = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $jsonData = file_get_contents('php://input');
    $decodedData = json_decode($jsonData, true);


    $query = "INSERT INTO `attendence` (`student_id`, `attendence`, `class`, `section`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    $all_success = true;
    $error_msg = "";

    foreach ($decodedData as $key => $value) {
        $student_id = $key;
        $class = $value['class'];
        $section = $value['section'];
        $attendence = $value['attendence'];

        mysqli_stmt_bind_param($stmt, "ssss", $student_id, $attendence, $class, $section);

        if(!mysqli_stmt_execute($stmt)){
            $all_success = false;
            $error_msg = mysqli_error($conn);
            break; // Stop on first error
        }
    }

    mysqli_stmt_close($stmt);

    if ($all_success) {
        $response = "success";
    } else {
        $response = "Database Error: " . $error_msg;
    }


} else {
    $response = "Something went wrong!";
}
echo $response;
?>