<?php include("database/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Course Materials | Grassroots Public School</title>
  
  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }

    .header-section {
      background: linear-gradient(135deg, #1d7431 0%, #2193b0 100%);
      padding: 60px 0;
      color: white;
      margin-bottom: 40px;
      border-radius: 0 0 30px 30px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .class-card {
      border: none;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      margin-bottom: 30px;
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .class-card:hover {
      transform: translateY(-5px);
    }

    .class-header {
      background: white;
      padding: 20px 25px;
      border-bottom: 1px solid #f0f0f0;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .class-header i {
      font-size: 1.5rem;
      color: #1d7431;
    }

    .class-header h4 {
      margin: 0;
      font-weight: 700;
      color: #2d3436;
    }

    .file-item {
      padding: 15px 25px;
      border: none;
      border-bottom: 1px solid #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background 0.3s;
    }

    .file-item:hover {
      background-color: #fcfcfc;
    }

    .file-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn-download {
      border-radius: 10px;
      padding: 6px 16px;
      font-weight: 600;
      font-size: 0.85rem;
      transition: all 0.3s;
    }

    .btn-download:hover {
      background-color: #1d7431;
      color: white;
      border-color: #1d7431;
    }

    .empty-state {
      padding: 40px;
      text-align: center;
      color: #999;
    }
  </style>
</head>
<body>

  <header class="header-section">
    <div class="container text-center">
      <h1 class="display-5 fw-bold mb-3">Academic Resources</h1>
      <p class="lead opacity-75">Access and download class-wise course materials and syllabi</p>
      <div class="mt-4">
        <a href="index.php" class="btn btn-outline-light rounded-pill px-4"><i class="fas fa-arrow-left me-2"></i>Back to Home</a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <?php
      for ($i = 1; $i <= 5; $i++) {
          $query = "SELECT * FROM course_files WHERE class = '$i'";
          $result = mysqli_query($data, $query);
          ?>
          <div class="col-lg-6 col-xl-4">
            <div class="card class-card">
              <div class="class-header">
                <i class="fas fa-graduation-cap"></i>
                <h4>Class <?= $i ?></h4>
              </div>
              <div class="card-body p-0">
                <?php if (mysqli_num_rows($result) > 0): ?>
                  <div class="list-group list-group-flush">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                      <div class="file-item">
                        <div class="file-info">
                          <i class="far fa-file-pdf text-danger"></i>
                          <span class="small fw-medium text-truncate" style="max-width: 180px;"><?= $row['filename'] ?></span>
                        </div>
                        <a href="uploads/<?= $row['filename'] ?>" class="btn btn-outline-success btn-download" download>
                          <i class="fas fa-download me-1"></i> Get
                        </a>
                      </div>
                    <?php endwhile; ?>
                  </div>
                <?php else: ?>
                  <div class="empty-state">
                    <i class="fas fa-folder-open mb-3 fs-3"></i>
                    <p class="mb-0">No resources available for this class yet.</p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php
      }
      ?>
    </div>
  </div>

  <footer class="text-center py-5 mt-5">
    <p class="text-secondary small">&copy; 2025 Grassroots Public School | Nurturing Future Leaders</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
