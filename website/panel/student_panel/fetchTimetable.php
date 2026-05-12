<?php
include($_SERVER['DOCUMENT_ROOT'] . "/panel/assets/config.php");
$response = array();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['uid'];
    
    // Fetch student class and section
    $sql = "SELECT `class`, `section` FROM `students` WHERE `id`='$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $class = trim($row['class']);
        $section = trim($row['section']);

        // Fetch timetable for the matched class/section
        $query = "SELECT * FROM `time_table` WHERE TRIM(`class`)='$class' AND TRIM(`section`)='$section'";
        $result2 = mysqli_query($conn, $query);

        $daysOfWeek = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat');
        $response['status'] = "success";
        $timetable = array();

        // Initialize empty arrays for each day to ensure keys exist
        foreach ($daysOfWeek as $day) {
            $timetable[$day] = array();
        }

        if ($result2 && mysqli_num_rows($result2) > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                foreach ($daysOfWeek as $day) {
                    $timetable[$day][] = array(
                        "start_time" => $row2['start_time'],
                        "end_time"   => $row2['end_time'],
                        "subject"    => isset($row2[$day]) ? $row2[$day] : ""
                    );
                }
            }
        }
        
        $response['data'] = $timetable;
        $response['debug'] = array("class" => $class, "section" => $section, "rows" => mysqli_num_rows($result2));
    } else {
        $response['status'] = "error";
        $response['message'] = "Student record not found";
    }
} else {
    $response['status'] = "error";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
