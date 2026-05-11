<?php
include("config.php");
session_start();
$response = array();

error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $uid = $_SESSION['uid'];

    if(isset($uid)){
        
        $query = "SELECT `email`, `role` FROM `users` WHERE `id`=?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $email = $row['email'];
            $role = $row['role'];

            $query2 = "";
            if($role == "admin"){
                $query2 = "SELECT * FROM `admins` WHERE `id`=?";
            }
            else if($role == "teacher"){
                $query2 = "SELECT * FROM `teachers` WHERE `id`=?";
            }

            $stmt2 = mysqli_prepare($conn, $query2);
            mysqli_stmt_bind_param($stmt2, "s", $uid);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);

            if($result2 && $row2 = mysqli_fetch_assoc($result2)){
             

                $response['status'] = "success";
                $response['id'] = $uid;
                $response['role'] = $role;
                
                $imageDir = ($role == "admin") ? "adminUploads" : "teacherUploads";
                $imagePath = ".." . DIRECTORY_SEPARATOR . $imageDir . DIRECTORY_SEPARATOR . $row2['image'];

                $response['image'] = (!empty($row2['image']) && file_exists($imagePath) && !is_dir($imagePath)) ? $imagePath : "../images/user.png";

                $response['fname'] = ucfirst(strtolower($row2['fname'] ?? ''));
                $response['lname'] = ucfirst(strtolower($row2['lname'] ?? ''));
                $response['dob'] = $row2['dob'] ?? 'N/A';
                $response['email'] = $email;
                $response['phone'] =  $row2['phone'] ?? 'N/A';
                $response['class'] = $row2['class'] ?? 'N/A';
                $response['section'] = $row2['section'] ?? 'N/A';
                $response['gender'] =  $row2['gender'] ?? 'N/A';
                $response['address'] =  $row2['address'] ?? 'N/A';

               
            }else{
                $response['status'] = "Error";
                $response['message'] = "Something went wrong!";
            }


        }else{
            $response['status'] = "Error";
            $response['message'] = "Something went wrong!";
        }
    }else{
        $response['status'] = "Error";
        $response['message'] = "Something went wrong!";
    }
    
    
}else{
    $response['status'] = "Error";
    $response['message'] = "Something went wrong!";

}
echo json_encode($response);
?>
