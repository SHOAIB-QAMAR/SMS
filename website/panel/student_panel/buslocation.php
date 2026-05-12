<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_header.php") ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_sidebar.php") ?>
<input type="hidden" value="5" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Bus Route</h1>
                <ul class="breadcrumb">
                    <li><a>Transportation & Stops</a></li>
                </ul>
            </div>
            <a href="buspanel.php" class="btn btn-primary shadow-sm">
                <i class='bx bx-left-arrow-alt'></i> Back to Buses
            </a>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-map-pin'></i>
                    <h3>Route Schedule</h3>
                </div>
                <div class="p-4">
                    <?php
                    $bus_id = mysqli_real_escape_string($conn, $_GET['bus_id']);
                    $sql = "SELECT * FROM bus_root WHERE bus_id='$bus_id' ORDER BY arrival_time ASC";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0) {
                        echo '<div class="timeline p-3">';
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='d-flex mb-4 align-items-center'>
                                    <div class='time fw-bold text-primary me-4' style='min-width: 100px;'>{$row['arrival_time']}</div>
                                    <div class='icon-wrapper bg-light rounded-circle p-2 border me-3'>
                                        <i class='bx bxs-bus text-success fs-4'></i>
                                    </div>
                                    <div class='location-info'>
                                        <h6 class='mb-0'>{$row['location']}</h6>
                                        <small class='text-muted'>Scheduled Stop</small>
                                    </div>
                                  </div>";
                        }
                        echo '</div>';
                    } else {
                        echo "<div class='text-center p-5 text-muted'>There is no route defined for this bus yet.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_footer.php"); ?>