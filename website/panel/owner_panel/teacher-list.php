<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_header.php"); ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_sidebar.php"); ?>
<input type="hidden" value="4" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Teacher List</h1>
                <ul class="breadcrumb">
                    <li><a>Directory of all faculty members</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-user-detail'></i>
                    <h3>Teachers</h3>
                </div>
                
                <div class="table-responsive p-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sr_NO</th>
                                <th>NAME</th>
                                <th>Gender</th>
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
            url: "fetch-data/fetch-teachers.php",
            method: "POST",
            success: function(data){
                $("#tb").html(data);
            }
        });
    }
    load_table();
});
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_footer.php"); ?>