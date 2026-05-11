<?php include('partials/_header.php'); ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php'); ?>
<input type="hidden" value="2" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Notices</h1>
                <ul class="breadcrumb">
                    <li><a>Manage Announcements</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-primary shadow-sm d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class='bx bx-plus'></i>
                <span>Send Notice</span>
            </button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Notice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Recipient</label>
                            <select class="form-select w-100" id="select" required>
                                <option value="none" selected>Select Role</option>
                                <option value="student">Students</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="mb-3" id="classDiv" style="display: none;">
                            <label class="form-label">Class</label>
                            <select class="form-select w-100" id="class">
                                <option value="" selected>----SELECT CLASS----</option>
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
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="send">Send Notice</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-data mt-4">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-history'></i>
                    <h3>Past Notices</h3>
                </div>
                <div class="p-4">
                    <?php 
                    $sql_query = "SELECT * FROM notice ORDER BY s_no DESC";
                    $result = mysqli_query($conn, $sql_query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $title = htmlspecialchars($row['title']);
                            $body = htmlspecialchars($row['body']);
                            $role = htmlspecialchars($row['role']);
                            $class = htmlspecialchars($row['class']);
                            $formattedRole = ($role == '' || $role == 'all') ? 'All' : ucfirst($role);
                            
                            echo "<div class='card mb-3 border-0 shadow-sm bg-light'>
                                    <div class='card-body'>
                                        <div class='d-flex justify-content-between align-items-start'>
                                            <div>
                                                <h5 class='card-title fw-bold mb-1'>$title</h5>
                                                <p class='text-muted small mb-3'><i class='bx bx-send'></i> To: $formattedRole" . ($role == 'student' ? " (Class $class)" : "s") . "</p>
                                            </div>
                                            <button class='btn btn-outline-danger btn-sm delete' data-id='".$row['s_no']."'>
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </div>
                                        <p class='card-text'>$body</p>";
                            
                            if ($row['file'] != "") {
                                $file_path = '../noticeUploads/' . $row['file'];
                                if (file_exists($file_path)) {
                                    echo "<a href='$file_path' download class='btn btn-sm btn-primary mt-2'><i class='bx bx-download'></i> Download File</a>";
                                }
                            }
                            echo "      <div class='mt-3 pt-2 border-top text-muted small'>
                                            <i class='bx bx-time-five'></i> ".$row['timestamp']."
                                        </div>
                                    </div>
                                  </div>";                               
                        }
                    } else {
                        echo "<div class='text-center py-5'>
                                <i class='bx bx-info-circle fs-1 text-muted'></i>
                                <p class='text-muted mt-2'>No notices found.</p>
                              </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Delete Notice
    document.querySelectorAll('.delete').forEach(function(button) {
        button.addEventListener('click', function() {
            if (confirm("Are you sure you want to delete this notice?")) {
                var noticeId = this.getAttribute('data-id');
                fetch('fetch-data/notice-delete.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'noticeId=' + encodeURIComponent(noticeId)
                })
                .then(response => response.text())
                .then(data => {
                    location.reload();
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });

    // Recipient Change Toggle
    var selectElement = document.getElementById('select');
    var classDiv = document.getElementById('classDiv');
    if (selectElement) {
        selectElement.addEventListener('change', function() {
            classDiv.style.display = (this.value === 'student') ? 'block' : 'none';
        });
    }

    // Send Notice
    document.getElementById('send').addEventListener('click', function() {
        var panel = document.getElementById('select').value;
        var cla = document.getElementById('class').value;
        var title = document.getElementById('title').value;
        var message = document.getElementById('message').value;

        fetch('fetch-data/send-notice.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'panel=' + encodeURIComponent(panel) +
                '&cla=' + encodeURIComponent(cla) +
                '&title=' + encodeURIComponent(title) +
                '&message=' + encodeURIComponent(message),
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes('successfully')) {
                location.reload();
            } else {
                alert('Submission failed: ' + data);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>

<?php include("partials/_footer.php"); ?>