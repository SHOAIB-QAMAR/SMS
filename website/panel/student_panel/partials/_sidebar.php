<div class="sidebar">
    <div class="logo-container py-3 px-3">
        <div class="SidebarOpener d-flex align-items-center justify-content-center rounded shadow-sm text-primary flex-shrink-0"
            style="width: 35px; height: 35px; background-color: var(--light-primary); cursor: pointer; transition: all 0.2s ease;">
            <i class='bx bx-menu fs-4'></i>
        </div>
    </div>

    <ul class="side-menu main-side-board">
        <li class="side-item-1"><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li class="side-item-2"><a href="timetable.php"><i class='bx bx-table'></i>Time Table</a></li>
        <li class="side-item-3"><a href="exam.php"><i class='bx bx-grid-alt'></i>Examination</a></li>
        <li class="side-item-4"><a href="workspace.php"><i class='bx bx-file'></i>Workspace</a></li>
        <li class="side-item-5"><a href="buspanel.php"><i class='bx bxs-bus'></i>Bus Panel</a></li>
        <li class="side-item-6"><a href="password.php"><i class='bx bxs-key'></i>Settings</a></li>
    </ul>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const checkFileName = document.getElementById('checkFileName')?.value;
            if (checkFileName) {
                const activeItem = document.querySelector(`.side-item-${checkFileName}`);
                if (activeItem) {
                    activeItem.classList.add('active');
                }
            }
        });
    </script>

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
