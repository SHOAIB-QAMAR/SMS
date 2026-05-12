<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_header.php") ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_sidebar.php") ?>
<input type="hidden" value="5" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Bus Panel</h1>
                <ul class="breadcrumb">
                    <li><a>Transportation Services</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-bus'></i>
                    <h3>Bus Information</h3>
                </div>
                <div class="p-3">
                <?php
                $uid = $_SESSION['uid'];
                $query = "SELECT * FROM students WHERE id=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $uid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row2 = mysqli_fetch_assoc($result);
                    if ($row2["request"] == "") {
                        echo '<button type="button" data-uid="' . $uid . '" id="request" class="btn btn-primary">
                                <i class="bx bx-send me-2"></i> Request For Bus
                              </button>';
                    } else if ($row2["request"] == "accepted") {
                        $sql = "SELECT * FROM buses";
                        $result_bus = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result_bus) > 0) {
                            echo '<table class="table">';
                            echo '<thead><tr><th>Bus Number</th><th>Title</th><th>Action</th></tr></thead><tbody>';
                            while ($row = mysqli_fetch_assoc($result_bus)) {
                                echo "<tr>
                                        <td>{$row['bus_number']}</td>
                                        <td>{$row['bus_title']}</td>
                                        <td><a href='buslocation.php?bus_id={$row['bus_id']}' class='btn btn-sm btn-info text-white'><i class='bx bx-map-pin'></i> Track</a></td>
                                      </tr>";
                            }
                            echo '</tbody></table>';
                        } else {
                            echo "<div class='text-center p-4'>No Buses found</div>";
                        }
                    } else {
                        echo "<div class='text-center p-4'>
                                 <img src='images/pending.gif' style='max-width: 200px;'><br>
                                 <p class='text-muted mt-2'>Your request is pending approval...</p>
                              </div>";
                    }
                } else {
                    echo "Student not found";
                }
                ?>
                </div>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript">
  const requestBtn = document.getElementById("request");
  if(requestBtn) {
      requestBtn.addEventListener("click", function(event) {
        if (confirm("Do you really want to apply for bus service?")) {
            var id = this.getAttribute("data-uid");
            fetch("fetch-data/send-request.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                window.location.reload();
            })
            .catch(error => console.error("Error:", error));
        }
    });
  }
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_footer.php"); ?>
