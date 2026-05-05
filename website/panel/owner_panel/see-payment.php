<?php
include("../assets/noSessionRedirect.php"); 
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
    <?php include('includes/header.php'); ?>
    <title>View Payments - EduCore</title>
    <style type="text/css">
      .see-payment{
  height: auto;
  width: 80%;
  display: flex;
  position: absolute;
  border: .2px solid lightgray;
  flex-direction: column;
  margin-left: 10%;
  margin-top: 3%;
  border-radius: 5px;
  padding: 10px;
  background-color: ghostwhite;

}
#paid{
   height: 50px;
   width: 150px;
   background-color: lightgreen;
   color: black;
   border: none;
   border-radius: 5px;
}
    </style>
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    <div class="see-payment">
      <div class="notice-body">
        <h2>Title:  </h2>
        <h5>Teacher's Name : Akash</h5>
        <h5>Amount: 6000</h5>
        <p>Date of Payment: 22/oct/2012</p>
        <button id="paid">Paid Successfully</button>
      </div>
    </div>
  </body>
  </html>