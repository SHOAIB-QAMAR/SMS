<?php
include("../assets/noSessionRedirect.php");
include('./fetch-data/verfyRoleRedirect.php');

$id = $_SESSION['uid'];

error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
  <?php include('includes/header.php'); ?>
  <title>Change Password - EduCore</title>
  <style>
    body {
      background-color: #f8fafc;
    }

    .change-password-section {
      padding: 60px 0;
    }

    .card {
      border: none;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      border-radius: 15px;
    }

    .btn-reset {
      background: #64BCF4;
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 8px;
      width: 100%;
    }

    .btn-reset:hover {
      background: #4da6e0;
      color: white;
    }
  </style>

  <section class="change-password-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body p-4">
              <h4 class="text-center mb-4">Reset Password</h4>

              <form action="#" method="post">
                <div class="mb-3">
                  <label class="form-label" for="cpassword">Current Password</label>
                  <input type="password" id="cpassword" name="current" class="form-control" required />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="newpassword">New Password</label>
                  <input type="password" id="newpassword" name="new" class="form-control" required />
                </div>

                <div class="mb-4">
                  <label class="form-label" for="retypepassword">Repeat New Password</label>
                  <input type="password" id="retypepassword" name="repeat" class="form-control" required />
                </div>

                <div class="text-center">
                  <input type="submit" class="btn btn-reset" name="submit" value="Update Password">
                </div>
              </form>

              <?php
              include('config.php');

              if (isset($_POST['submit'])) {
                $password = $_POST['current'];
                $newpassword = $_POST['new'];
                $confirmnewpassword = $_POST['repeat'];

                $result = mysqli_query($conn, "SELECT password_hash FROM users WHERE id='$id'");
                if ($result && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $pass = $row['password_hash'];

                  if (password_verify($password, $pass)) {
                    if ($newpassword == $confirmnewpassword) {
                      $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT);
                      if (mysqli_query($conn, "UPDATE users SET password_hash='$newpasswordhash' WHERE id='$id'")) {
                        echo "<div class='alert alert-success mt-3 small'>Password Updated successfully! Redirecting...</div>";
                        echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
                      } else {
                        echo "<div class='alert alert-danger mt-3 small'>Unable to update password.</div>";
                      }
                    } else {
                      echo "<div class='alert alert-warning mt-3 small'>New passwords do not match.</div>";
                    }
                  } else {
                    echo "<div class='alert alert-danger mt-3 small'>Current password is incorrect.</div>";
                  }
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </body>

</html>