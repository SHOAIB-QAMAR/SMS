
<?php
include("../assets/noSessionRedirect.php"); 
include('./fetch-data/verfyRoleRedirect.php');
include("../assets/config.php");

error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('includes/header.php'); ?>
    <title>Teacher List - EduCore</title>
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    <div class="teacher-list">
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Sr_NO</th>
      <th scope="col">NAME</th>
      <th scope="col">Gender</th>
      <th scope="col">MORE DETAILS</th>
    </tr>
  </thead>
  <tbody id="tb">
    
  </tbody>
</table>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        function load_table(){$.ajax({
          url: "fetch-data/fetch-teachers.php",
          method: "POST",
          success: function(data){
             $("#tb").html(data);
          }
        });
      }
      load_table();
 
        $("#main-search").on("keyup",function(){
          var search=$(this).val();
          $.ajax({
              url: "fetch-data/search-teacher.php",
              type: "POST",
              data: {search: search},
              success: function(data){
                  $("#tb").html(data);
              }
        });
        });
        
      
      });

     


    </script>
  </body>
  </html>