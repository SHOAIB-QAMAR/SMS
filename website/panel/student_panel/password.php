<?php include('partials/_header.php') ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="6" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Security</h1>
                <ul class="breadcrumb">
                    <li><a>Account Settings & Security</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bxs-lock-alt'></i>
                    <h3>Change Password</h3>
                </div>
                <div class="p-4" style="max-width: 500px; margin: auto;">
                    <form action="#" method="post" class="row g-3">
                        <div class="col-12">
                            <p class="text-muted small mb-4">Your new password must be different from previously used passwords for better security.</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="current" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" name="repeat" required>
                        </div>
                        <div class="col-12 mt-4 d-flex gap-2 align-items-center">
                            <button type="submit" name="submit" class="btn btn-primary shadow-sm">
                                <i class='bx bx-save me-1'></i> Update Password
                            </button>
                            <a href="index.php" class="text-muted text-decoration-none ms-2 small">Cancel</a>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        $id = $_SESSION['uid'];
                        $password = $_POST['current'];
                        $newpassword = $_POST['new'];
                        $confirmnewpassword = $_POST['repeat'];

                        $stmt = $conn->prepare("SELECT password_hash FROM users WHERE id=?");
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $pass_hash = $row['password_hash'];

                            if (password_verify($password, $pass_hash)) {
                                if ($newpassword === $confirmnewpassword) {
                                    $new_hash = password_hash($newpassword, PASSWORD_DEFAULT);
                                    $update_stmt = $conn->prepare("UPDATE users SET password_hash=? WHERE id=?");
                                    $update_stmt->bind_param("ss", $new_hash, $id);
                                    if ($update_stmt->execute()) {
                                        echo "<div class='alert alert-success mt-3 py-2 small'><i class='bx bx-check-circle'></i> Password updated successfully!</div>";
                                    } else {
                                        echo "<div class='alert alert-danger mt-3 py-2 small'><i class='bx bx-error-circle'></i> Unable to update password.</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-warning mt-3 py-2 small'><i class='bx bx-info-circle'></i> New passwords do not match.</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger mt-3 py-2 small'><i class='bx bx-x-circle'></i> Incorrect current password.</div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include('partials/_footer.php'); ?>