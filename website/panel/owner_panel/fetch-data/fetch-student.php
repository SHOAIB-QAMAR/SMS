<?php
include("../../assets/config.php");
$sql = "select * from students";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <th scope='row'>" . $row['s_no'] . "</th>
                <td>" . $row['fname'] . "  " . $row['lname'] . "</td>
                <td>" . $row['class'] . " " . $row['section'] . "</td>
                <td class='text-center align-middle'>
    <a href='modal-student.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary d-inline-flex align-items-center'>
        <i class='bx bx-show me-1'></i> View More
    </a>
</td>
              </tr>";
    }
}
?>