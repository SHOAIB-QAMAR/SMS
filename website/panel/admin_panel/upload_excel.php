<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/admin_panel/partials/_header.php") ?>
<?php
// PHP Excel Import Logic
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['upload'])) {
    $fileName = $_FILES['excel_file']['name'];
    $fileTmp = $_FILES['excel_file']['tmp_name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    if ($fileExt == 'xlsx' || $fileExt == 'xls') {
        try {
            $spreadsheet = IOFactory::load($fileTmp);
            $excelData = $spreadsheet->getActiveSheet()->toArray();
            $count = 0;

            for ($i = 1; $i < count($excelData); $i++) {
                $row = $excelData[$i];
                if (empty($row[1])) continue; // Skip empty names

                $sr_no = mysqli_real_escape_string($conn, $row[0]);
                $name = mysqli_real_escape_string($conn, $row[1]);
                $father_name = mysqli_real_escape_string($conn, $row[2]);
                $mother_name = mysqli_real_escape_string($conn, $row[3]);
                $class = mysqli_real_escape_string($conn, $row[4]);
                $dob = mysqli_real_escape_string($conn, $row[5]);
                $address = mysqli_real_escape_string($conn, $row[6]);
                $phone = mysqli_real_escape_string($conn, $row[7]);
                $aadhar_no = mysqli_real_escape_string($conn, $row[8]);
                $pan_no = mysqli_real_escape_string($conn, $row[9]);
                $aapar_id = mysqli_real_escape_string($conn, $row[10]);
                $marks = mysqli_real_escape_string($conn, $row[11]);
                $fees_status = mysqli_real_escape_string($conn, $row[12]);

                $insert = "INSERT INTO students 
                    (sr_no, name, father_name, mother_name, class, dob, address, phone, aadhar_no, pan_no, aapar_id, marks, fees_status) 
                    VALUES 
                    ('$sr_no', '$name', '$father_name', '$mother_name', '$class', '$dob', '$address', '$phone', '$aadhar_no', '$pan_no', '$aapar_id', '$marks', '$fees_status')";

                if (mysqli_query($conn, $insert)) {
                    $count++;
                }
            }
            $msg = "Success! $count students were imported.";
            $msgClass = "alert-success";
        } catch (Exception $e) {
            $msg = "Error reading Excel file: " . $e->getMessage();
            $msgClass = "alert-danger";
        }
    } else {
        $msg = "Invalid file type. Only .xlsx or .xls allowed.";
        $msgClass = "alert-warning";
    }
}
?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/admin_panel/partials/_sidebar.php") ?>
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/admin_panel/partials/_navbar.php"); ?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Bulk Registration</h1>
                <ul class="breadcrumb">
                    <li><a>Excel Import</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-file-import'></i>
                    <h3>Import Students via Spreadsheet</h3>
                </div>

                <div class="container p-4">
                    <?php if (isset($msg)): ?>
                        <div class="alert <?= $msgClass ?> alert-dismissible fade show" role="alert">
                            <?= $msg ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-info border-0 shadow-sm rounded-4 mb-4">
                        <h6 class="fw-bold mb-2"><i class='bx bx-info-circle me-2'></i>Excel Instructions:</h6>
                        <p class="small mb-0">The Excel file should have headers in the first row. The columns should be: <b>SR No, Name, Father, Mother, Class, DOB, Address, Phone, Aadhar, PAN, Aapar ID, Marks, Fees Status</b>.</p>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="row g-4">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Select Spreadsheet (.xlsx or .xls)</label>
                            <input type="file" name="excel_file" class="form-control" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" name="upload" class="btn btn-success px-5 rounded-pill shadow-sm">
                                <i class='bx bx-upload me-2'></i>Import Students
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/admin_panel/partials/_footer.php"); ?>
