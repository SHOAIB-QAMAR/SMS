<?php
include("../../assets/config.php");
$search = $_POST['search'];
$sql = "select * from students where fname like '%$search%' or lname like '%$search%' or id like '%$search%'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <th scope='row'>" . $row['s_no'] . "</th>
                <td>" . $row['fname'] . "  " . $row['lname'] . "</td>
                <td>" . $row['class'] . " " . $row['section'] . " (Student)</td>
                <td class='text-center'>
                    <a href='modal-student.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>
                        <i class='bx bx-show me-1'></i> View More
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>No Records Found</td></tr>";
}
?>
