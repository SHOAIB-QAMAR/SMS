<?php include('partials/_header.php') ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
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
                <h1>Progress Report</h1>
                <ul class="breadcrumb">
                    <li><a>Performance Analytics</a></li>
                </ul>
            </div>
            <a href="exam.php" class="btn btn-primary shadow-sm">
                <i class='bx bx-left-arrow-alt'></i> Back to Exams
            </a>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-bar-chart-alt-2'></i>
                    <h3>Performance Chart</h3>
                </div>
                <div class="p-4">
                    <div id="columnchart_material" style="width: 100%; min-height: 500px;"></div>
                </div>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var studentId = '<?php echo $_SESSION['uid']; ?>';
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(fetchDataAndDrawChart);

    function fetchDataAndDrawChart() {
        fetch("fetch-data/progress-data.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id: studentId })
        })
        .then(response => response.json())
        .then(data => {
            var chartData = [['Exam', 'Marks Percentage (%)']];
            if(data && data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    chartData.push([data[i]['exam_name'], parseFloat(data[i]['marks'])]);
                }
            } else {
                chartData.push(['No Data', 0]);
            }
            drawChart(chartData);
        })
        .catch(error => console.error('Error:', error));
    }

    function drawChart(chartData) {
        var data = google.visualization.arrayToDataTable(chartData);
        var options = {
            chart: {
                title: 'Exam Progress (%)',
                subtitle: 'Performance across different examinations',
            },
            colors: ['#388E3C']
        };
        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

<?php include('partials/_footer.php'); ?>