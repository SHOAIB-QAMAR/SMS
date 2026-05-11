<nav>
  <div class="d-flex align-items-center">
  </div>
  <div class="ms-auto d-flex align-items-center gap-3">
    <div id="oranbyte-google-translator" data-default-lang="en" data-lang-root-style="code-flag"
      data-lang-list-style="code-flag"></div>


    <input type="checkbox" id="theme-toggle" hidden>
    <label for="theme-toggle" class="theme-toggle" onload="checkAndChangeTheme()"></label>


    <div class="dropdown dropdown-center">
      <a class=" menu" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <i class='bx bx-dots-vertical-rounded icon-hover-circle'></i>
      </a>

      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout-modal">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
// session_start();
$theme = "";

if (isset($_SESSION['theme'])) {
  $theme = $_SESSION['theme'];
} else {
  $theme = 'light';
}

?>