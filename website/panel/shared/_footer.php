<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 footer-brand">
        <div class="logo">
          <h3>SCHOOL MANAGEMENT</h3>
        </div>
        <p class="footer-desc">Streamlining education with a modern, efficient management system. Empowering teachers,
          students, and administrators.</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about-us.php">About Us</a></li>
          <li><a href="../auth/login.php">Login</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-contact">
        <h4>Contact Us</h4>
        <address>
          <p><i class="fas fa-map-marker-alt"></i> Q9P3+75H, My Town, My city, My Country</p>
          <p><i class="fas fa-envelope"></i> info@schoolmgmt.com</p>
          <p><i class="fas fa-phone"></i> +1 234 567 890</p>
        </address>
      </div>

      <div class="col-lg-3 col-md-6 footer-info">
        <h4>Current Time</h4>
        <div class="time-box">
          <?php
          date_default_timezone_set('Asia/Kolkata');
          echo "<p class='time-display'>" . date('D, M d, Y') . "</p>";
          echo "<p class='hour-display'>" . date('H:i:s') . " (IST)</p>";
          ?>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> <span class="brand-name">School Management</span>. Built by <a
          href="https://www.github.com/ProjectsAndPrograms" target="_blank">Shoaib</a>.</p>
    </div>
  </div>
</footer>



<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="./shared/app.js"></script>
</body>

</html>