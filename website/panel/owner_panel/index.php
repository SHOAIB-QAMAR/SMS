<?php
include("../assets/noSessionRedirect.php");
include('./fetch-data/verfyRoleRedirect.php');
include("../assets/config.php");

error_reporting(0);
?>
<?php
session_start();
$uid = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>

<head>
  <?php include('includes/header.php'); ?>
  <title>Owner Dashboard - EduCore</title>
</head>

<body>
  <?php include('includes/navbar.php'); ?>

  <style>
    .dashboard-stats {
      padding: 40px 0;
      background: #f8fafc;
    }

    .stat-card {
      background: #fff;
      border-radius: 15px;
      padding: 25px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      display: flex;
      align-items: center;
      gap: 20px;
      transition: all 0.3s ease;
      border: 1px solid #f1f5f9;
      height: 100%;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(29, 116, 49, 0.15);
      border-color: #1d7431;
    }

    .stat-img-wrapper {
      background: #f1f5f9;
      padding: 12px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .stat-img {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }

    .stat-info h6 {
      margin: 0;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #64748b;
      font-weight: 600;
    }

    .stat-info h3 {
      margin: 5px 0;
      font-size: 2rem;
      font-weight: 800;
      color: #1e293b;
    }

    .stat-link {
      font-size: 0.85rem;
      text-decoration: none;
      color: #1d7431;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .stat-link:hover {
      color: #0a2e13;
    }
  </style>

  <div class="dashboard-stats pb-0">
    <div class="container">
      <div class="row g-4">
        <!-- Teachers Stat Card -->
        <div class="col-md-6">
          <?php
          $sql = "SELECT COUNT(*) as total_rows FROM teachers";
          $result = mysqli_query($conn, $sql);
          if ($row = mysqli_fetch_assoc($result)):
            ?>
            <div class="stat-card">
              <div class="stat-img-wrapper">
                <img src="img/teacher.png" class="stat-img" alt="Teachers">
              </div>
              <div class="stat-info">
                <h6>Total Teachers</h6>
                <h3><?php echo $row['total_rows']; ?></h3>
                <a href="teacher-list.php" class="stat-link">
                  See Teachers List <i class="bx bx-right-arrow-alt"></i>
                </a>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Students Stat Card -->
        <div class="col-md-6">
          <?php
          $sql_1 = "SELECT COUNT(*) as total_row FROM students";
          $result1 = mysqli_query($conn, $sql_1);
          if ($rows = mysqli_fetch_assoc($result1)):
            ?>
            <div class="stat-card">
              <div class="stat-img-wrapper">
                <img src="img/student.png" class="stat-img" alt="Students">
              </div>
              <div class="stat-info">
                <h6>Total Students</h6>
                <h3><?php echo $rows['total_row']; ?></h3>
                <a href="student-list.php" class="stat-link">
                  See Students List <i class="bx bx-right-arrow-alt"></i>
                </a>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>


  <!-- Search Results Section -->
  <div class="container mt-5" id="searchResultsSection" style="display: none;">
    <hr>
    <h3 class="mb-4">Search Results</h3>
    <div class="table-responsive">
      <table class="table table-hover table-bordered shadow-sm">
        <thead class="table-light">
          <tr>
            <th>SR_NO</th>
            <th>NAME</th>
            <th>DETAILS / TYPE</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody id="searchResultsBody">
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // Search Handler
      $("#searchForm").on("submit", function (e) {
        e.preventDefault();
        var searchVal = $("#main-search").val();

        if (searchVal.trim() === "") {
          $("#searchResultsSection").hide();
          return;
        }

        // Search in students
        $.ajax({
          url: "fetch-data/search-student.php",
          type: "POST",
          data: { search: searchVal },
          success: function (studentData) {
            $("#searchResultsSection").show();
            $("#searchResultsBody").html(studentData);

            // Also search in teachers and append
            $.ajax({
              url: "fetch-data/search-teacher.php",
              type: "POST",
              data: { search: searchVal },
              success: function (teacherData) {
                if (teacherData.trim() !== "" && teacherData.indexOf("No_Record") === -1) {
                  $("#searchResultsBody").append(teacherData);
                }
              }
            });
          }
        });
      });
    });
  </script>
</body>

</html>