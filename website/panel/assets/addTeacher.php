<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $json_data = file_get_contents("php://input");
    $dataObject = json_decode($json_data, true);

    $uniqueId = "T" . time(); 

    $fname = $dataObject["fname"];
    $lname = $dataObject["lname"];
    $_class = $dataObject["class"];
    $_section = $dataObject["section"];
    $subject = $dataObject["subject"];
    $gender = $dataObject["gender"];

    $dobString = $dataObject["dob"];
    $timestamp = strtotime($dobString);
    $dob = date('d-m-Y', $timestamp);

    $phone = $dataObject["phone"];
    $email = $dataObject["email"];
    $address = $dataObject["address"];
    $city = $dataObject["city"];
    $zip = $dataObject["zip"];
    $state = $dataObject["state"];
    $guardian = $dataObject["guardian"];
    $gphone = $dataObject["gphone"];
    $gaddress = $dataObject["gaddress"];
    $gcity = $dataObject["gcity"];
    $gzip = $dataObject["gzip"];
    $relation = $dataObject["relation"];

    // Use prepared statement to check if the email already exists
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo 'Email already exists!';
    } else {

        // Use prepared statements for inserting teacher details
        $addTeacherDetailQuery = "INSERT INTO `teachers` (`s_no`, `id`, `fname`, `lname`, `father`, `class`,`section`, `subject`, `gender`, `dob`, `phone`, `email`, `address`, `city`, `zip`, `state`) VALUES (NULL, ?, ?, ?, '', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt1 = mysqli_prepare($conn, $addTeacherDetailQuery);
        mysqli_stmt_bind_param($stmt1, "ssssssssssssss", $uniqueId, $fname, $lname, $_class , $_section, $subject, $gender, $dob, $phone, $email, $address, $city, $zip, $state);
        $teacherSuccess = mysqli_stmt_execute($stmt1);

        // Use prepared statements for inserting guardian details
        $addGuardianDetailQuery = "INSERT INTO `teacher_guardian` (`s_no`, `id`, `gname`, `gphone`, `gaddress`, `gcity`, `gzip`, `relation`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $addGuardianDetailQuery);
        mysqli_stmt_bind_param($stmt2, "sssssss", $uniqueId, $guardian, $gphone, $gaddress, $gcity, $gzip, $relation);
        $guardianSuccess = mysqli_stmt_execute($stmt2);

        // Use prepared statements for inserting user details
        $password = str_replace("-", "", $dob); 
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $addUserDetailQuery = "INSERT INTO `users` (`s_no`, `id`, `email`, `password_hash`, `role`, `theme`) VALUES (NULL, ?, ?, ?, 'teacher', 'light')";
        $stmt3 = mysqli_prepare($conn, $addUserDetailQuery);
        mysqli_stmt_bind_param($stmt3, "sss", $uniqueId, $email, $passwordHash);
        $userSuccess = mysqli_stmt_execute($stmt3);

        if ($teacherSuccess && $guardianSuccess && $userSuccess) {
            echo 'success';
        } else {
            echo 'Error - Unable to complete teacher registration';
        }
    }

} else {
    echo "Invalid request!";
}
?>
