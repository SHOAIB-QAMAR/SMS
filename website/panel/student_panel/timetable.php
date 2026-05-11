<?php include('partials/_header.php') ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="2" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Time Table</h1>
                <ul class="breadcrumb">
                    <li><a>Weekly Schedule</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-calendar-event'></i>
                    <h3 id="current_day_display">Today's Schedule</h3>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-light" id="prevDay"><i class='bx bx-chevron-left'></i></button>
                        <button class="btn btn-sm btn-light" id="nextDay"><i class='bx bx-chevron-right'></i></button>
                    </div>
                </div>
                <table id="timetable_table">
                    <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Populated by timeTable.js -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php include('partials/_footer.php'); ?>
<script src="timeTable.js"></script>
<script src="app.js"></script>