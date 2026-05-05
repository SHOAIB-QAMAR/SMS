
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
    <title>Student List - EduCore</title>
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    <div class="select">
      <select class="form-select" aria-label="Default select example" id="form-select">
  <option value="" selected>Select Class</option>
  <option value="12m">12 (Math)</option>
<option value="12b">12 (Bio)</option>
<option value="12c">12 (Commerce)</option>
<option value="11m">11 (Math)</option>
<option value="11b">11 (Bio)</option>
<option value="11c">11 (Commerce)</option>
<option value="10">10</option>
<option value="9">9</option>
<option value="8">8</option>
<option value="7">7</option>
<option value="6">6</option>
<option value="5">5</option>
<option value="4">4</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
<option value="pg">pg</option>
<option value="lkg">lkg</option>
<option value="ukg">ukg</option>

</select>
    </div>
    <div class="teacher-list">
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Sr_NO</th>
      <th scope="col">NAME</th>
      <th scope="col">Class & Section</th>
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
          url: "fetch-data/fetch-student.php",
          method: "POST",
          success: function(data){
             $("#tb").html(data);
          }
        });
      }
      load_table();

        $("#form-select").change(function(){
          var select=$(this).val();
          $.ajax({
              url: "fetch-data/select-students.php",
              type: "POST",
              data: {select: select},
              success: function(data){
                  $("#tb").html(data);
              }
        });
        });

        $("#main-search").on("keyup",function(){
          var search=$(this).val();
          $.ajax({
              url: "fetch-data/search-student.php",
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