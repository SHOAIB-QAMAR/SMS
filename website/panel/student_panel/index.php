<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_header.php") ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_sidebar.php") ?>
<input type="hidden" value="1" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a>Student Overview</a></li>
                </ul>
            </div>
        </div>

        <!-- Insights / Profile Summary -->
        <ul class="insights">
            <li>
                <i class='bx bxs-user-circle'></i>
                <span class="info">
                    <?php
                    $id = $_SESSION['uid'];
                    $query = "SELECT * FROM students WHERE id='$id'";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        echo "<h3>" . $row['fname'] . "</h3>";
                        echo "<p>Class: " . $row['class'] . " | Section: " . $row['section'] . "</p>";
                    }
                    ?>
                </span>
            </li>
            <li>
                <i class='bx bxs-calendar-check'></i>
                <span class="info">
                    <h3 id="attendance_percentage">--%</h3>
                    <p>Attendance</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-book-content'></i>
                <span class="info">
                    <h3 id="syllabus_count">0</h3>
                    <p>Syllabus Files</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <!-- Attendance Chart -->
            <div class="orders">
                <div class="header">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <h3>Attendance Analytics</h3>
                </div>
                <div id="piechart" style="width: 100%; height: 350px;"></div>
            </div>

            <!-- Notices -->
            <div class="reminders">
                <div class="header">
                    <i class='bx bxs-bell'></i>
                    <h3>Latest Notices</h3>
                </div>
                <ul class="task-list">
                    <?php
                    $id = $_SESSION['uid'];
                    $query_student = "SELECT class FROM students WHERE id='$id'";
                    $res_student = mysqli_query($conn, $query_student);
                    $student_row = mysqli_fetch_assoc($res_student);
                    $class = $student_row['class'] ?? '';

                    $sql_notice = "SELECT * FROM notice WHERE (role = 'student' AND class='$class') OR (role = 'all' OR role='') ORDER BY s_no DESC LIMIT 5";
                    $result_notice = mysqli_query($conn, $sql_notice);
                    if (mysqli_num_rows($result_notice) > 0) {
                        while ($row_n = mysqli_fetch_assoc($result_notice)) {
                            echo "<li>";
                            echo "<div class='task-title'>";
                            echo "<i class='bx bx-info-circle'></i>";
                            echo "<p><strong>" . $row_n['title'] . "</strong><br>" . $row_n['body'] . "</p>";
                            echo "</div>";
                            if ($row_n['file']) {
                                echo "<a href='../noticeUploads/" . $row_n['file'] . "' class='ms-2'><i class='bx bx-file'></i></a>";
                            }
                            echo "</li>";
                        }
                    } else {
                        echo "<li><p>No new notices.</p></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="bottom-data mt-4">
            <!-- Syllabus List -->
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-file-pdf'></i>
                    <h3>Syllabus</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_syllabus = "SELECT * FROM syllabus WHERE class='$class'";
                        $result_syllabus = mysqli_query($conn, $sql_syllabus);
                        $count_syl = 0;
                        if (mysqli_num_rows($result_syllabus) > 0) {
                            while ($row_s = mysqli_fetch_assoc($result_syllabus)) {
                                $count_syl++;
                                echo "<tr>";
                                echo "<td>" . $row_s['subject'] . "</td>";
                                echo "<td><a href='../syllabusUploads/" . $row_s['file'] . "' class='btn btn-sm btn-primary'><i class='bx bxs-download'></i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No syllabus found for your class.</td></tr>";
                        }
                        echo "<script>document.getElementById('syllabus_count').innerText = '$count_syl';</script>";
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Feedbacks -->
            <div class="reminders">
                <div class="header">
                    <i class='bx bxs-chat'></i>
                    <h3>Recent Feedbacks</h3>
                </div>
                <ul class="task-list">
                    <?php
                    $sql_fb = "SELECT * FROM `feedback` WHERE `receiver_id`='$id' ORDER BY timestamp DESC LIMIT 5";
                    $result_fb = mysqli_query($conn, $sql_fb);
                    if (mysqli_num_rows($result_fb) > 0) {
                        while ($row_fb = mysqli_fetch_assoc($result_fb)) {
                            $senderId = $row_fb['sender_id'];
                            $tableName = ($senderId >= 1000) ? 'admins' : 'teachers';
                            $sql_sender = "SELECT `fname`, `lname` FROM `$tableName` WHERE id = '$senderId' LIMIT 1";
                            $res_sender = mysqli_query($conn, $sql_sender);
                            $sender_name = "System";
                            if ($row_snd = mysqli_fetch_assoc($res_sender)) {
                                $sender_name = $row_snd['fname'] . " " . $row_snd['lname'];
                            }
                            echo "<li>";
                            echo "<div class='task-title'>";
                            echo "<i class='bx bxs-quote-left text-primary'></i>";
                            echo "<p>" . $row_fb['msg'] . "</p>";
                            echo "</div>";
                            echo "<small class='text-muted'>" . $sender_name . "</small>";
                            echo "</li>";
                        }
                    } else {
                        echo "<li><p>No feedbacks yet.</p></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    let presentPer = 0;
    let absentPer = 0;

    document.addEventListener("DOMContentLoaded", function () {
        fetch("fetchAttendencePercentage.php", {
            method: "POST",
        })
        .then(response => response.json())
        .then(data => {
            if (data['status'] === "success") {
                presentPer = parseFloat(data['present']);
                absentPer = parseFloat(data['absent']);
                document.getElementById('attendance_percentage').innerText = presentPer + "%";

                google.charts.load("current", { packages: ["corechart"] });
                google.charts.setOnLoadCallback(drawChart);
            }
        })
        .catch(error => console.error("Error fetching attendance:", error));
    });

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Attendance', 'Percentage'],
            ['Present', presentPer],
            ['Absent', absentPer],
        ]);

        var options = {
            pieHole: 0.4,
            colors: ['#1d7431', '#D32F2F'],
            legend: { position: 'bottom' },
            chartArea: { width: '90%', height: '80%' }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_footer.php"); ?>