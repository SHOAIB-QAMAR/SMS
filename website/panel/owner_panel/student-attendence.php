<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_header.php"); ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_sidebar.php"); ?>
<input type="hidden" value="3" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Student Attendance</h1>
                <ul class="breadcrumb">
                    <li><a href="student-list.php">Students</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a>Attendance Analysis</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <h3>Attendance Overview</h3>
                </div>
                
                <div class="p-4 d-flex justify-content-center">
                    <div id="piechart" style="width: 100%; max-width: 600px; height: 400px;"></div>
                </div>
                
                <div class="text-center pb-4">
                    <a href="modal-student.php?id=<?php echo $_GET['id']; ?>" class="btn btn-outline-secondary">
                        <i class='bx bx-arrow-back me-1'></i> Back to Profile
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<?php 
$id = $_GET['id']; 
echo "<script>var studentId = '{$id}';</script>";
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        fetch("fetch-data/fetch-attendence.php", {
            method: 'POST',
            body: JSON.stringify({id: studentId}),
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(() => drawChart(data.present, data.absent));
            }
        })
        .catch(error => console.error("Error:", error));

        function drawChart(present, absent) {
            var chartData = google.visualization.arrayToDataTable([
                ['Status', 'Days'],
                ['Present', parseInt(present)],
                ['Absent', parseInt(absent)]
            ]);

            var options = {
                title: 'Monthly Attendance Statistics',
                pieHole: 0.4,
                colors: ['#1d7431', '#D32F2F'],
                chartArea: { width: '100%', height: '80%' },
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(chartData, options);
        }
    });
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_footer.php"); ?>