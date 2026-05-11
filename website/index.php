<?php include("database/db.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grassroots Public School | Nurturing Future Leaders</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="assets/images/school1 (1).jpeg">

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FontAwesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom Styles -->
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="assets/images/school1 (1).jpeg" alt="GPS Logo" width="50" height="50" class="rounded-circle">
        <span>Grassroots&nbsp; Public &nbsp;School</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item ms-lg-3"><a href="view_course.php" class="nav-link">Courses</a></li>
          <li class="nav-item ms-lg-2"><a href="auth/login.php" class="btn btn-outline-success px-4 rounded-pill">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <?php
  $bannerRow = mysqli_query($data, "SELECT filename FROM homepage_banner WHERE id=1");
  $bannerSrc = "assets/images/image1.jpeg";  // default if none set
  if ($row = mysqli_fetch_assoc($bannerRow)) {
    if (is_file($row['filename']))
      $bannerSrc = $row['filename'];
  }
  ?>
  <section class="hero-section">
    <img src="<?= htmlspecialchars($bannerSrc) ?>" class="hero-img" alt="Main Banner">
  </section>

  <!-- Welcome / About Section -->
  <section id="about" class="section-padding">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5 mb-4 mb-lg-0">
          <div class="position-relative">
            <img class="welcome-img" src="assets/images/school1 (2).jpeg" alt="School Campus">
            <div
              class="position-absolute bottom-0 end-0 bg-success p-3 rounded-start text-white shadow-lg d-none d-md-block"
              style="transform: translate(20px, 20px);">
              <h3 class="mb-0 fw-bold">15+</h3>
              <p class="mb-0 small">Years of Excellence</p>
            </div>
          </div>
        </div>
        <div class="col-lg-7 ps-lg-5">
          <div class="section-title text-start">
            <h2 class="display-5">Welcome to <span class="text-success">Grassroots</span> Public School</h2>
          </div>
          <p class="lead mb-4">
            Grassroots Public School is a nurturing and inclusive learning community committed to building strong
            educational foundations.
          </p>
          <p class="text-secondary mb-4">
            With a focus on holistic development, the school blends academic excellence with moral values, creativity,
            and life skills. Our dedicated teachers and student-friendly environment ensure that every child is
            encouraged to grow, explore, and reach their full potential.
          </p>
          <div class="row g-4">
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-3">
                <i class="fas fa-check-circle text-success fs-4"></i>
                <span class="fw-bold">UP Board Affiliated</span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="d-flex align-items-center gap-3">
                <i class="fas fa-check-circle text-success fs-4"></i>
                <span class="fw-bold">Holistic Development</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <?php
  $gallery_result = mysqli_query($data, "SELECT * FROM gallery ORDER BY slot ASC");
  $images = array_fill(1, 6, "assets/images/image1.jpeg"); // default
  while ($row = mysqli_fetch_assoc($gallery_result)) {
    if (!empty($row['filename']) && is_file($row['filename'])) {
      $images[$row['slot']] = $row['filename'];
    }
  }
  ?>
  <section id="gallery" class="section-padding bg-white">
    <div class="container">
      <div class="section-title">
        <h2>Our Campus Gallery</h2>
        <p class="text-secondary">Glimpses of our vibrant learning environment and activities</p>
      </div>
      <div class="row g-4">
        <?php for ($i = 1; $i <= 6; $i++): ?>
          <div class="col-lg-4 col-md-6">
            <div class="gallery-item shadow-sm">
              <img src="<?= $images[$i] ?>" alt="Gallery Image <?= $i ?>">
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="section-title">
        <h2>Get In Touch</h2>
        <p class="text-secondary">We are here to answer your questions and welcome you to our school</p>
      </div>
      <div class="row g-5">
        <div class="col-lg-5">
          <div class="contact-info-card">
            <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <h5 class="fw-bold">Address</h5>
              <p class="mb-0 text-secondary">Opposite LemonTree Hotel, Marris Road, Aligarh-202001</p>
            </div>
          </div>
          <div class="contact-info-card">
            <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
            <div>
              <h5 class="fw-bold">Phone</h5>
              <p class="mb-0 text-secondary">+91 7906396818</p>
            </div>
          </div>
          <div class="contact-info-card">
            <div class="icon-box"><i class="fas fa-envelope"></i></div>
            <div>
              <h5 class="fw-bold">Email</h5>
              <p class="mb-0 text-secondary">grassroots.public.school@gmail.com</p>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="rounded-4 overflow-hidden shadow-lg border">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3525.9875044391915!2d78.08627257549557!3d27.902356776071297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3974a4c1efa68623%3A0x26ba2e7fa6256009!2sGrassroots%20public%20School!5e0!3m2!1sen!2sin!4v1751303889368!5m2!1sen!2sin"
              width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer-section">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-7 col-md-6">
          <div class="footer-brand mb-4">
            <img src="assets/images/school1 (1).jpeg" alt="Logo" width="50"
              class="rounded-circle me-2 border border-2 border-white">
            <span class="fw-bold text-white fs-4">Grassroots Public School</span>
          </div>
          <p class="text-white-50 mb-4 pe-lg-5">
            Nurturing young minds through holistic education, academic excellence, and strong moral values. We are
            dedicated to building the future leaders of tomorrow.
          </p>
          <div class="social-links">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <div class="col-lg-5 col-md-6">
          <h5 class="footer-heading">Opening Hours</h5>
          <div class="hours-box p-4 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 shadow-sm">
            <div class="d-flex justify-content-between mb-3">
              <span class="text-white-50">Monday - Friday:</span>
              <span class="text-white fw-medium">8:00 AM - 4:00 PM</span>
            </div>
            <div class="d-flex justify-content-between">
              <span class="text-white-50">Saturday:</span>
              <span class="text-white fw-medium">8:00 AM - 1:00 PM</span>
            </div>
          </div>
        </div>
      </div>

      <hr class="footer-divider my-5">

      <div class="footer-bottom d-md-flex justify-content-between align-items-center text-center text-md-start">
        <p class="mb-0 text-white-50">&copy; 2025 Grassroots Public School. All Rights Reserved.</p>
        <p class="mb-0 text-white-50 mt-2 mt-md-0">Developed with ❤️ by <span class="text-white fw-medium">Anshika
            Porwal</span></p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5.3 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>