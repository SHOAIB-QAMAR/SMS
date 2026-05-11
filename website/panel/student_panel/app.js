
// Scope-protected dashboard logic
(function() {
    const dashboardSideBar = document.querySelector(".sidebar");
    const sideBarToggleBtn = document.querySelector(".SidebarOpener");
    const themeToggleEl = document.querySelector(".theme-toggler");

    if (sideBarToggleBtn && dashboardSideBar) {
        sideBarToggleBtn.onclick = function () {
            dashboardSideBar.classList.toggle('close');
        }
    }

    window.addEventListener('scroll', () => {
        if (dashboardSideBar) dashboardSideBar.classList.remove('active');
        if (window.scrollY > 0) { document.querySelector('header')?.classList.add('active'); }
        else { document.querySelector('header')?.classList.remove('active'); }
    });

    if (themeToggleEl) {
        themeToggleEl.onclick = function () {
            document.body.classList.toggle('dark');
            themeToggleEl.querySelector('i:nth-child(1)')?.classList.toggle('active')
            themeToggleEl.querySelector('i:nth-child(2)')?.classList.toggle('active')
            
            const isDark = document.body.classList.contains('dark');
            fetch('../assets/updateTheme.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'theme=' + (isDark ? 'dark' : 'light')
            });
        }
    }
})();

// Global functions for cross-script access
window.setData = (day) => {
    const tableBody = document.querySelector('#timetable_table tbody');
    const dayDisplay = document.getElementById('current_day_display');
    
    if (!tableBody) return;
    
    tableBody.innerHTML = ''; 
    let daylist = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
    if (dayDisplay) dayDisplay.innerHTML = daylist[day];

    let currentDayData;
    switch (day) {
        case (0): currentDayData = (typeof Sunday !== 'undefined') ? Sunday : []; break;
        case (1): currentDayData = (typeof Monday !== 'undefined') ? Monday : []; break;
        case (2): currentDayData = (typeof Tuesday !== 'undefined') ? Tuesday : []; break;
        case (3): currentDayData = (typeof Wednesday !== 'undefined') ? Wednesday : []; break;
        case (4): currentDayData = (typeof Thursday !== 'undefined') ? Thursday : []; break;
        case (5): currentDayData = (typeof Friday !== 'undefined') ? Friday : []; break;
        case (6): currentDayData = (typeof Saturday !== 'undefined') ? Saturday : []; break;
        default: currentDayData = [];
    }

    if (!currentDayData || currentDayData.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="3" class="text-center py-4">No classes scheduled</td></tr>';
        return;
    }

    var count = 1;
    currentDayData.forEach(sub => {
        const subjectName = (sub.subject && sub.subject.trim() !== "") ? sub.subject.trim() : "--";

        var tr = document.createElement('tr');
        var trContent = `
            <td>${sub.start_time || '--:--'}</td>
            <td>${sub.end_time || '--:--'}</td>
            <td>${subjectName}</td>
        `;
        tr.innerHTML = trContent;
        tableBody.appendChild(tr);

        if (count == 5) {
            var lunchTr = document.createElement('tr');
            lunchTr.innerHTML = `
                <td colspan="3" class="text-center fw-bold bg-light text-success" style="letter-spacing: 10px; font-size: 0.8rem; background-color: var(--light-primary) !important;">LUNCH BREAK</td>
            `;
            tableBody.appendChild(lunchTr);
        }
        count++;
    });
}

// Global day tracking
window.currentTimetableDay = new Date().getDay();

const nextDayBtn = document.getElementById('nextDay');
const prevDayBtn = document.getElementById('prevDay');

if (nextDayBtn) {
    nextDayBtn.onclick = function () {
        window.currentTimetableDay <= 5 ? window.currentTimetableDay++ : window.currentTimetableDay = 0;
        setData(window.currentTimetableDay);
    }
}

if (prevDayBtn) {
    prevDayBtn.onclick = function () {
        window.currentTimetableDay >= 1 ? window.currentTimetableDay-- : window.currentTimetableDay = 6;
        setData(window.currentTimetableDay);
    }
}

// Search functionality
function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    if (!input) return;
    filter = input.value.toUpperCase();
    table = document.getElementById("timetable_table");
    if (!table) return;
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2]; 
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

// Initial state
document.addEventListener('DOMContentLoaded', () => {
    const dayDisplay = document.getElementById('current_day_display');
    if (dayDisplay) {
        dayDisplay.innerHTML = "Today's Schedule";
    }

    if (typeof fetchTimetableData === 'function') {
        fetchTimetableData();
    }
});
