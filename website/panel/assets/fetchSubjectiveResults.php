<?php
session_start();
include('config.php');
$response = array();
if (isset($_POST['exam_id'])) {
    $examId = $_POST['exam_id'];
    $studentId = $_SESSION['uid'];


    $tableHeader = '';

    // Prepare and execute the first SQL query
    $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $examId, $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Prepare and execute the second SQL query
    $sql2 = "SELECT * FROM `exams` WHERE `exam_id` = ? LIMIT 1";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "s", $examId);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);


    $body = "";
    
    if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) > 0) {
        $examRow = mysqli_fetch_assoc($result2);
        $dateDB = $examRow['timestamp'];
        $formattedDate = date("d-m-Y", strtotime($dateDB));

        $tableHeader = '
            <div class="p-3">
                <h5 class="fw-bold mb-3 text-primary"><i class="bx bx-receipt me-2"></i>'. $examRow['exam_title'] . '</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Subject</th>
                                <th class="text-center">Obtained</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>';

        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $mark = $row['marks'];
            $statusBadge = ((int)$mark >= (int)$examRow['passing_marks']) ? 
                '<span class="badge bg-success-subtle text-success border border-success-subtle px-3">Pass</span>' : 
                '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Fail</span>';

            $body .= "<tr>
                <td class='text-center fw-bold'>".$counter."</td>
                <td>" . $row["subject"] . "</td>
                <td class='text-center fw-bold'>" . $mark . "</td>
                <td class='text-center text-secondary'>" . $examRow["total_marks"] . "</td>
                <td class='text-center'>" . $statusBadge . "</td>
            </tr>";
            $counter++;
        }

        $tableFooter = "</tbody></table></div></div>";
        $response['data'] = $tableHeader . $body . $tableFooter;

        $response['status'] = "success";
    } else {
        $response['data'] = "";
        $response['status'] = "error";
        $response['message'] = "Something went wrong!!";
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response['status'] = "error";
    $response['message'] = "exam_id not set!";
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
