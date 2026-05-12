<?php
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
include($_SERVER['DOCUMENT_ROOT'] . "/database/db.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Fetch student records
$query = "SELECT * FROM students";
$result = mysqli_query($data, $query);

$html = '
    <h2 style="text-align: center;">Student Report - Grassroot Public School</h2>
    <table border="1" cellspacing="0" cellpadding="6" width="100%">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>SR No</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>Mother Name</th>
                <th>Class</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Aadhar</th>
                <th>PAN</th>
                <th>Aapar ID</th>
                <th>Marks</th>
                <th>Fees Status</th>
            </tr>
        </thead>
        <tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr>
                <td>{$row['sr_no']}</td>
                <td>{$row['name']}</td>
                <td>{$row['father_name']}</td>
                <td>{$row['mother_name']}</td>
                <td>{$row['class']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['address']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['aadhar_no']}</td>
                <td>{$row['pan_no']}</td>
                <td>{$row['aapar_id']}</td>
                <td>{$row['marks']}</td>
                <td>{$row['fees_status']}</td>
              </tr>";
}

$html .= '</tbody></table>';

// Initialize Dompdf
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("student_report.pdf", ["Attachment" => 0]);
?>
