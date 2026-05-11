<div class="sidebar">
    <div class="logo-container py-3 px-3">
        <div class="SidebarOpener d-flex align-items-center justify-content-center rounded shadow-sm text-primary flex-shrink-0"
            style="width: 35px; height: 35px; background-color: var(--light-primary); cursor: pointer; transition: all 0.2s ease;">
            <i class='bx bx-menu fs-4'></i>
        </div>
    </div>

    <ul class="side-menu main-side-board">
        <li><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="notices.php"><i class='bx bx-message-square-detail'></i>Notices</a></li>
        <li><a href="student-list.php"><i class='bx bxs-group'></i>Students</a></li>
        <li><a href="teacher-list.php"><i class='bx bxs-user-detail'></i>Teachers</a></li>
    </ul>

</div>

<div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pb-4">
                <i class='bx bx-log-out-circle text-danger mb-3' style="font-size: 4rem;"></i>
                <h4 class="fw-bold">Ready to Leave?</h4>
                <p class="text-muted">Select "Logout" below if you are ready to end your current session.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger px-4" onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
</div>

<script>
    function logout() {
        window.location.href = 'logout.php';
    }

    window.addEventListener('DOMContentLoaded', (event) => {
        const checkFileName = document.getElementById('checkFileName')?.value;
        const sideLinks = document.querySelectorAll('.sidebar .side-menu li');
        
        if (checkFileName && sideLinks[checkFileName - 1]) {
            sideLinks[checkFileName - 1].classList.add('active');
        }

        // Sidebar toggle logic
        const menuBar = document.querySelector('.SidebarOpener');
        const sideBar = document.querySelector('.sidebar');
        if (menuBar && sideBar) {
            menuBar.addEventListener('click', () => {
                sideBar.classList.toggle('close');
            });
        }
    });
</script>