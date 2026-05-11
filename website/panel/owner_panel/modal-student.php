<?php include('partials/_header.php'); ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php'); ?>
<input type="hidden" value="3" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Student Profile</h1>
                <ul class="breadcrumb">
                    <li><a href="student-list.php">Students</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a>View Profile</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-user-detail'></i>
                    <h3>Personal Information</h3>
                </div>

                <?php
                $sql = "SELECT * FROM students WHERE id = '{$_GET['id']}'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4 text-primary"><?php echo $row['fname'] . " " . $row['lname']; ?></h4>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Email Address</p>
                                        <p class="fw-bold"><?php echo $row['email']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Father's Name</p>
                                        <p class="fw-bold"><?php echo $row['father']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Class & Section</p>
                                        <p class="fw-bold"><?php echo $row['class'] . " " . $row['section']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Gender</p>
                                        <p class="fw-bold"><?php echo $row['gender']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Phone Number</p>
                                        <p class="fw-bold"><?php echo $row['phone']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Date of Birth</p>
                                        <p class="fw-bold"><?php echo $row['dob']; ?></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="mb-1 text-muted small">Full Address</p>
                                        <p class="fw-bold">
                                            <?php echo $row['address'] . ", " . $row['city'] . ", " . $row['state']; ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <a href="student-attendence.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-dark d-inline-flex align-items-center">
                                        <i class='bx bx-calendar-check me-1'></i> Attendance
                                    </a>
                                    <a href="student-list.php"
                                        class="btn btn-outline-secondary d-inline-flex align-items-center">
                                        <i class='bx bx-arrow-back me-1'></i> Back to List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>

<?php include("partials/_footer.php"); ?>