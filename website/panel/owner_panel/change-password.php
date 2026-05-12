<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_header.php"); ?>

<!-- Sidebar -->
<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_sidebar.php"); ?>
<input type="hidden" value="5" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Settings</h1>
                <ul class="breadcrumb">
                    <li><a>Security & Password</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-lock-open-alt'></i>
                    <h3>Change Password</h3>
                </div>
                
                <div class="p-4">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="#" method="post" class="bg-light p-4 rounded shadow-sm">
                                <div class="mb-3">
                                    <label class="form-label fw-bold small" for="cpassword">Current Password</label>
                                    <input type="password" id="cpassword" name="current" class="form-control" placeholder="Enter current password" required />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small" for="newpassword">New Password</label>
                                    <input type="password" id="newpassword" name="new" class="form-control" placeholder="Enter new password" required />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold small" for="retypepassword">Confirm New Password</label>
                                    <input type="password" id="retypepassword" name="repeat" class="form-control" placeholder="Repeat new password" required />
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary w-100 fw-bold">Update Password</button>
                            </form>

                            <?php
                            if (isset($_POST['submit'])) {
                                $password = $_POST['current'];
                                $newpassword = $_POST['new'];
                                $confirmnewpassword = $_POST['repeat'];
                                $id = $_SESSION['uid'];

                                $result = mysqli_query($conn, "SELECT password_hash FROM users WHERE id='$id'");
                                if ($result && $result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $pass = $row['password_hash'];

                                    if (password_verify($password, $pass)) {
                                        if ($newpassword == $confirmnewpassword) {
                                            $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT);
                                            if (mysqli_query($conn, "UPDATE users SET password_hash='$newpasswordhash' WHERE id='$id'")) {
                                                echo "<div class='alert alert-success mt-3 text-center small'>Password updated successfully!</div>";
                                                echo "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";
                                            } else {
                                                echo "<div class='alert alert-danger mt-3 text-center small'>Update failed. Please try again.</div>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-warning mt-3 text-center small'>New passwords do not match.</div>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger mt-3 text-center small'>Current password is incorrect.</div>";
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/panel/owner_panel/partials/_footer.php"); ?>