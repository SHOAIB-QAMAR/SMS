<?php include('partials/_header.php') ?>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="1" id="checkFileName">
<!-- End of Sidebar -->

<div class="modal fade" id="reminder-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Reminder</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <div class="modal-body">

                <div class="container mr-3 ml-3">
                    <div class="alert alert-warning reminder-error" role="alert"
                        style="min-height: 50px;display: none;">
                        Message can't be empty!
                    </div>
                    <div class="mb-3">
                        <!-- <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label> -->
                        <textarea class="form-control" id="reminder-msg" rows="3"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary text-center _flex-container" onclick="addReminder()"> <i
                        class='bx bx-plus'></i>&nbsp;<strong>ADD</strong></button>
            </div>
        </div>
    </div>
</div>


<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a>
                            Analytics
                        </a></li>

                </ul>
            </div>
            <!-- <a href="#" class="report">
                <i class='bx bxs-file-pdf'></i>
                <span>Worksheet PDF</span>
            </a> -->
        </div>

        <!-- Insights -->
        <ul class="insights">
            <!-- ... existing insights ... -->
            <li onclick="showTeacherList()">
                <i class='bx bxs-user'></i>
                <span class="info">
                    <h3 class="text-center" id="teacherCount">_ _ _</h3>
                    <p>Teachers</p>
                </span>
            </li>
            <li onclick="showStudentList()">
                <i class='bx bxs-group'></i>
                <span class="info">
                    <h3 class="text-center" id="studentCount">_ _ _</h3>
                    <p>Students</p>
                </span>
            </li>
            <li onclick="showNotesList()">
                <i class='bx bx-book'></i>
                <span class="info">
                    <h3 class="text-center" id="classCount">_ _ _</h3>
                    <p>Notes</p>
                </span>
            </li>
            <li onclick="showNoticeList()">
                <i class='bx bxs-bookmark'></i>
                <span class="info">
                    <h3 class="text-center" id="noticeCount">_ _ _</h3>
                    <p>Notices</p>
                </span>
            </li>
        </ul>

        <!-- Website Management Section -->
        <div class="bottom-data mt-4">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-world'></i>
                    <h3>Website Management</h3>
                </div>
                <div class="row p-3">
                    <!-- Banner Upload -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 shadow-sm border-0 bg-light">
                            <h6 class="fw-bold mb-3"><i class='bx bx-image-add me-2 text-primary'></i>Update Homepage Banner</h6>
                            <form action="website_action.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="file" name="banner_pic" class="form-control form-control-sm" accept="image/*" required>
                                </div>
                                <button type="submit" name="banner_upload" class="btn btn-primary btn-sm w-100">Upload Banner</button>
                            </form>
                        </div>
                    </div>
                    <!-- Gallery Upload -->
                    <div class="col-md-6 mb-3">
                        <div class="card p-3 shadow-sm border-0 bg-light">
                            <h6 class="fw-bold mb-3"><i class='bx bx-images me-2 text-success'></i>Update Gallery Slots</h6>
                            <form action="website_action.php" method="POST" enctype="multipart/form-data">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <select name="slot" class="form-select form-select-sm" required>
                                            <option value="">Slot</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input type="file" name="gallery_pic" class="form-control form-control-sm" accept="image/*" required>
                                    </div>
                                </div>
                                <button type="submit" name="gallery_upload" class="btn btn-success btn-sm w-100 mt-3">Upload to Gallery</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Insights -->

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-receipt'></i>
                    <h3 id="text-heading">Latest Notices</h3>
                    <i class='bx bx-filter'></i>
                    <a href="noticeboard.php"> <i class='bx bx-plus icon-hover-circle' id="plusIconNotification"
                            style="font-size: 30px;"></i></a>
                </div>



                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Sender</th>
                        </tr>
                    </thead>
                    <tbody id="noticeTableBody">

                    </tbody>
                </table>
            </div>

            <!-- Reminders -->
            <div class="reminders">
                <div class="header">
                    <i class='bx bx-note'></i>
                    <h3>Remiders</h3>
                    <!-- <i class='bx bx-filter'></i> -->
                    <a data-bs-toggle="modal" data-bs-target="#reminder-modal"> <i style="font-size: 30px;"
                            class='bx bx-plus icon-hover-circle'></i></a>
                </div>
                <ul class="task-list" id="all-reminders">

                </ul>
            </div>


            <!-- End of Reminders-->


        </div>
        <br>
    </main>
</div>

<script src="../assets/js/dashboard.js"></script>
<?php include("partials/_footer.php");