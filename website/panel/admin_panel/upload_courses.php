<?php include('partials/_header.php') ?>
<?php
// PHP Upload Logic
if (isset($_POST['upload'])) {
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $file = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];

    $upload_dir = "../../uploads/courses/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0775, true);
    }

    $destination = $upload_dir . basename($file);
    $dbPath = "uploads/courses/" . $file;

    if (move_uploaded_file($temp, $destination)) {
        $query = "INSERT INTO course_files (class, filename) VALUES ('$class', '$dbPath')";
        mysqli_query($conn, $query);
        $msg = "File uploaded successfully!";
        $msgClass = "alert-success";
    } else {
        $msg = "Failed to upload file.";
        $msgClass = "alert-danger";
    }
}
?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <?php include("partials/_navbar.php"); ?>

    <main>
        <div class="header">
            <div class="left">
                <h1>Course Materials</h1>
                <ul class="breadcrumb">
                    <li><a>Upload Documents</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-book-add'></i>
                    <h3>Upload New Material</h3>
                </div>

                <div class="container p-4">
                    <?php if (isset($msg)): ?>
                        <div class="alert <?= $msgClass ?> alert-dismissible fade show" role="alert">
                            <?= $msg ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" enctype="multipart/form-data" class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Target Class</label>
                            <select name="class" class="form-select" required>
                                <option value="" disabled selected>Choose class...</option>
                                <?php include('partials/select_classes.php') ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Document File (PDF/DOC)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" name="upload" class="btn btn-primary px-5 rounded-pill shadow-sm">
                                <i class='bx bx-cloud-upload me-2'></i>Upload Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include("partials/_footer.php"); ?>
