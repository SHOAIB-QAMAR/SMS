
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
    <title>Make Payment - EduCore</title>
    <style type="text/css">
      .payment{
        margin-bottom: 10%;
      }
      @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
    </style>
</head>
<body>
    <?php include('includes/navbar.php'); ?>

    <div class="payment">
      <section class="h-100 h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Payment Info</h3>

            <form class="px-md-2" method="POST" action="qr.php">

              <div class="form-outline mb-4">
                <input type="text" id="form3Example1q" class="form-control" />
                <label class="form-label" for="form3Example1q">Payment Type(Title)</label>
              </div>

              <div class="row">
                <!-- <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input type="text" class="form-control" id="exampleDatepicker1" />
                    <label for="exampleDatepicker1" class="form-label">Select a date</label>
                  </div>

                </div> -->
                <div class="col-md-6 mb-4">
                 <?php
    $sql = "SELECT * FROM teachers";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo "<select class='select' style='width: auto; padding: 10px;' name='teacher_id'>
               <option value='0' disabled>SELECT TEACHER</option>
        ";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['id']}'>{$row['fname']} {$row['lname']}
            </option>";
        }
        echo "</select>
        ";
        echo "<input type='submit' class='btn btn-success btn-lg mb-1' value='Click to Pay' style='margin-top: 5%'>
        ";
    }
?>


<!--                   
                  <label for="exampleDatepicker1" class="form-label">Select Teacher's Name</label>

                </div>
              </div>

              <div class="mb-4">

                <select class="select">
                  <option value="1" disabled>Class</option>
                  <option value="2">Class 1</option>
                  <option value="3">Class 2</option>
                  <option value="4">Class 3</option>
                </select>

              </div>
              <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input type="text" class="form-control" id="exampleDatepicker1" value="3555985449" disabled/>
                    <label for="exampleDatepicker1" class="form-label">Account No: </label>

                    <input type="text" class="form-control" id="exampleDatepicker1" value="CBHI98562" disabled/>
                    <label for="exampleDatepicker1" class="form-label">IFSC CODE:  </label>

                    <input type="text" class="form-control" id="exampleDatepicker1" value="Teacher Name" disabled/>
                    <label for="exampleDatepicker1" class="form-label">Account Holder Name: </label>
                  </div>

                </div>

              <div class="row mb-4 pb-2 pb-md-0 mb-md-5">
                <div class="col-md-6">

                  <div class="form-outline">
                    <input type="text" id="form3Example1w" class="form-control" />
                    <label class="form-label" for="form3Example1w">Amount</label>
                  </div>

                </div>
              </div> -->

              
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>

  </body>
  </html>