<?php include('partials/_header.php'); ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php'); ?>
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
                <h1>Student List</h1>
                <ul class="breadcrumb">
                    <li><a>Directory of all students</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-group'></i>
                    <h3>Students</h3>
                    <div class="ms-auto" style="min-width: 200px;">
                        <select class="form-select w-100" id="form-select">
                            <option value="" selected>All Classes</option>
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
                </div>
                
                <div class="table-responsive p-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sr_NO</th>
                                <th>NAME</th>
                                <th>Class & Section</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript">
$(document).ready(function(){
    function load_table(){
        $.ajax({
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
});
</script>

<?php include("partials/_footer.php"); ?>