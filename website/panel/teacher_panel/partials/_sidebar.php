<div class="sidebar">
    <div class="logo-container py-3 px-3">
        <div class="SidebarOpener d-flex align-items-center justify-content-center rounded shadow-sm text-primary flex-shrink-0"
            style="width: 35px; height: 35px; background-color: var(--light-primary); cursor: pointer; transition: all 0.2s ease;">
            <i class='bx bx-menu fs-4'></i>
        </div>
    </div>

    <ul class="side-menu main-side-board">
        <li><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="student.php"><i class='bx bxs-user-detail'></i>Student</a></li>
        <li><a href="subjects.php"><i class='bx bx-book-bookmark'></i>Subjects</a></li>
        <li><a href="attendence.php"><i class='bx bx-list-check'></i>Attendence</a></li>
        <li><a href="noticeboard.php"><i class='bx bxs-bookmark'></i>Notice Board</a></li>
        <li><a href="timetable.php"><i class='bx bx-table'></i>Time Table</a></li>
        <li><a href="syllabus.php"><i class='bx bxs-file-blank'></i>Syllabus</a></li>
        <li><a href="notes.php"><i class='bx bx-note'></i>Notes</a></li>
        <li><a href="marks.php"><i class='bx bx-paste'></i>Marks</a></li>
        <li><a href="leaves.php"><i class='bx bxs-hourglass-top'></i>Leaves</a></li>
    </ul>

</div>

<div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to logout?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
</div>