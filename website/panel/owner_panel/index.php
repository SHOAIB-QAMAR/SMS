<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_header.php"); ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_sidebar.php"); ?>
<input type="hidden" value="1" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a>Owner Analytics</a></li>
                </ul>
            </div>
        </div>

        <!-- Insights -->
        <ul class="insights">
            <li onclick="window.location.href='teacher-list.php'" style="cursor: pointer;">
                <i class='bx bxs-user'></i>
                <span class="info">
                    <?php
                    $sql = "SELECT COUNT(*) as total_rows FROM teachers";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <h3 class="text-center"><?php echo $row['total_rows'] ?? 0; ?></h3>
                    <p>Total Teachers</p>
                </span>
            </li>
            <li onclick="window.location.href='student-list.php'" style="cursor: pointer;">
                <i class='bx bxs-group'></i>
                <span class="info">
                    <?php
                    $sql_1 = "SELECT COUNT(*) as total_row FROM students";
                    $result1 = mysqli_query($conn, $sql_1);
                    $rows = mysqli_fetch_assoc($result1);
                    ?>
                    <h3 class="text-center"><?php echo $rows['total_row'] ?? 0; ?></h3>
                    <p>Total Students</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data mt-4">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-search-alt'></i>
                    <h3>Quick Search</h3>
                </div>
                <div class="p-3">
                    <form id="searchForm" class="d-flex gap-2">
                        <input class="form-control" type="search" placeholder="Search for students or teachers..." id="main-search">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>

                <div id="searchResultsSection" style="display: none;" class="p-3">
                    <h4 class="mb-3">Results</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
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
            </div>
        </div>
    </main>
</div>

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

            $.ajax({
                url: "fetch-data/search-student.php",
                type: "POST",
                data: { search: searchVal },
                success: function (studentData) {
                    $("#searchResultsSection").show();
                    $("#searchResultsBody").html(studentData);

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

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_footer.php"); ?>