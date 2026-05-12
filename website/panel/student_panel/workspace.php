<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_header.php") ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_sidebar.php") ?>
<input type="hidden" value="4" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Workspace</h1>
                <ul class="breadcrumb">
                    <li><a>Learning Resources & Notes</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-folder-open'></i>
                    <h3>Study Materials</h3>
                </div>
                <div class="d-flex mb-3">
                    <input id="myInput" class="form-control" type="text" onkeyup="myFunction()" placeholder="Search for Subject..." style="max-width: 400px;">
                </div>
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $_SESSION['uid'];
                        $sql_student = "SELECT class FROM students WHERE id='$id'";
                        $res_student = mysqli_query($conn, $sql_student);
                        $student_data = mysqli_fetch_assoc($res_student);
                        $class = $student_data['class'] ?? '';

                        $query_notes = "SELECT * FROM notes WHERE class='$class' ORDER BY s_no DESC";
                        $result_notes = mysqli_query($conn, $query_notes);
                        if (mysqli_num_rows($result_notes) > 0) {
                            while ($rows = mysqli_fetch_assoc($result_notes)) {
                                $formattedDate = date("d-m-Y", strtotime($rows['timestamp']));
                                echo "<tr>";
                                echo "<td>" . $rows['subject'] . "</td>";
                                echo "<td>" . $rows['title'] . "</td>";
                                echo "<td>" . $formattedDate . "</td>";
                                echo "<td><a href='../notesUploads/" . $rows['file'] . "' class='btn btn-sm btn-primary' download><i class='bx bxs-download'></i></a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No notes uploaded yet.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Search by subject
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/student_panel/partials/_footer.php"); ?>