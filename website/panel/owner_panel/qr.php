<?php
include("../assets/noSessionRedirect.php");
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(0);
?>
<?php
include("../assets/config.php");
?>
<!DOCTYPE html>
<html>

<head>
  <?php include('includes/header.php'); ?>
  <title>Payment QR - EduCore</title>
  <style>
    body {
      background-color: #f8fafc;
    }

    .qr-section {
      padding: 60px 0;
    }

    .qr-card {
      border: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      border-radius: 20px;
      background: #fff;
    }

    .qr-image {
      width: 100%;
      max-width: 300px;
      border-radius: 15px;
      border: 5px solid #f1f5f9;
      margin: 20px auto;
      display: block;
    }

    .no-qr-box {
      padding: 40px;
      text-align: center;
      background: #fff1f2;
      color: #e11d48;
      border-radius: 15px;
      border: 1px dashed #fda4af;
    }
  </style>
</head>

<body>
  <?php include('includes/navbar.php'); ?>

  <section class="qr-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="qr-card p-4">
            <h4 class="text-center mb-4">Payment QR Code</h4>

            <div class="payment-content">
              <?php
              $teacher_id = $_POST['teacher_id'];

              if ($teacher_id == 'T1703597586') {
                echo "<img src='img/arzoo.jpg' class='qr-image' alt='Payment QR'>";
                echo "<p class='text-center text-muted small mt-3'>Scan to pay Arzoo</p>";
              } else if ($teacher_id == 'T1703574415') {
                echo "<img src='img/qr2.jpg' class='qr-image' alt='Payment QR'>";
                echo "<p class='text-center text-muted small mt-3'>Scan to pay Teacher 2</p>";
              } else {
                echo "<div class='no-qr-box'>
                               <i class='bx bx-error-circle' style='font-size: 3rem;'></i>
                               <h5 class='mt-3'>Payment Info : No Qr Found</h5>
                               <p class='small mb-0'>Please contact the administrator to upload a QR for this staff.</p>
                             </div>";
              }
              ?>
            </div>

            <div class="text-center mt-4">
              <a href="make-payment.php" class="btn btn-outline-secondary btn-sm">
                <i class='bx bx-left-arrow-alt'></i> Back to Selection
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>