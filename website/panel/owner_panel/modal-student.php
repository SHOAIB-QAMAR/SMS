<?php
include("../assets/noSessionRedirect.php");
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
  <?php include('includes/header.php'); ?>
  <title>Student Profile - EduCore</title>
  <style type="text/css">
    body {
      background-color: #f8fafc;
    }

    .profile-section {
      padding: 40px 0;
    }

    .profile-card {
      border: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      border-radius: 20px;
      overflow: hidden;
      background: #fff;
    }

    .profile-img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }

    .list-group-item {
      border-left: none;
      border-right: none;
      padding: 12px 20px;
      font-size: 0.95rem;
    }

    .list-group-item strong {
      color: #64BCF4;
      width: 120px;
      display: inline-block;
    }
  </style>
</head>

<body>
  <?php include('includes/navbar.php'); ?>
  <?php include("../assets/config.php"); ?>

  <section class="profile-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">
          <?php
          $sql = "SELECT * FROM students WHERE id = '{$_GET['id']}'";
          $result = mysqli_query($conn, $sql);
          if ($row = mysqli_fetch_assoc($result)):
            ?>
            <div class="profile-card">
              <img src="../studentUploads/<?php echo $row['image']; ?>" class="profile-img"
                alt="profile image of student">
              <div class="card-body p-4">
                <h4 class="card-title mb-4"><?php echo $row['fname'] . " " . $row['lname']; ?></h4>

                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Email:</strong> <?php echo $row['email']; ?></li>
                  <li class="list-group-item"><strong>Father's Name:</strong> <?php echo $row['father']; ?></li>
                  <li class="list-group-item"><strong>Class:</strong> <?php echo $row['class'] . " " . $row['section']; ?>
                  </li>
                  <li class="list-group-item"><strong>Gender:</strong> <?php echo $row['gender']; ?></li>
                  <li class="list-group-item"><strong>Phone:</strong> <?php echo $row['phone']; ?></li>
                  <li class="list-group-item"><strong>D-O-B:</strong> <?php echo $row['dob']; ?></li>
                  <li class="list-group-item"><strong>Address:</strong>
                    <?php echo $row['address'] . ", " . $row['city'] . ", " . $row['state']; ?></li>
                </ul>

                <div class="d-flex gap-2 mt-4">
                  <a href="student-attendence.php?id=<?php echo $row['id']; ?>" class="btn btn-success flex-grow-1">Fee
                    Status</a>
                  <a href="student-attendence.php?id=<?php echo $row['id']; ?>"
                    class="btn btn-dark flex-grow-1">Attendance</a>
                </div>
                <div class="text-center mt-3">
                  <a href="student-list.php" class="text-muted small text-decoration-none">
                    <i class='bx bx-arrow-back'></i> Back to List
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
<br><br>
</body>

</html>