<?php
// owner_panel/includes/navbar.php
?>
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(135deg, #0a2e13 0%, #1d7431 100%);">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold text-white" href="index.php">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3 px-3">
            <li class="nav-item">
              <a class="nav-link text-white opacity-75" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white opacity-75" href="notices.php">Notice</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-white opacity-75" href="change-password.php">Change-Password</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger fw-bold" href="logout.php">Logout</a>
            </li>
          </ul>
          <form class="d-flex align-items-center" id="searchForm">
            <div id="oranbyte-google-translator" class="me-2" data-default-lang="en" data-lang-root-style="code-flag"
              data-lang-list-style="code-flag"></div>

            <input class="form-control me-2 bg-light border-0" type="search" placeholder="Search..." aria-label="Search" id="main-search">
            <button class="btn btn-outline-light fw-bold" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </div>
