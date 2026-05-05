<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Grassroots Public School</title>
  
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
      background: linear-gradient(135deg, #1d7431 0%, #2193b0 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .brand-logo {
      width: 80px;
      height: 80px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      border: 1px solid #eee;
      margin-bottom: 20px;
    }

    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(29, 116, 49, 0.1);
      border-color: #1d7431;
    }

    .btn-login {
      background: #1d7431;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 10px;
      font-weight: 600;
      width: 100%;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background: #145a24;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(29, 116, 49, 0.3);
      color: white;
    }

    .back-home {
      text-align: center;
      margin-top: 25px;
    }

    .back-home a {
      color: #666;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s;
    }

    .back-home a:hover {
      color: #1d7431;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div class="brand-logo">
      <img src="assets/images/school1 (1).jpeg" alt="Logo" width="60" class="rounded-circle">
    </div>
    
    <h3 class="text-center fw-bold mb-2">Welcome Back</h3>
    <p class="text-center text-secondary small mb-4">Please enter your credentials to login</p>

    <form action="logincheck.php" method="post">
      <div class="mb-3">
        <label class="form-label small fw-bold">Username</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-secondary"></i></span>
          <input type="text" name="username" class="form-control border-start-0" placeholder="Username" required>
        </div>
      </div>

      <div class="mb-4">
        <label class="form-label small fw-bold">Password</label>
        <div class="input-group">
          <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-secondary"></i></span>
          <input type="password" name="password" class="form-control border-start-0" placeholder="Password" required>
        </div>
      </div>

      <button type="submit" class="btn btn-login">Login to Dashboard</button>
    </form>

    <div class="text-center mt-4">
      <p class="small text-secondary mb-0">Don't have an account? <a href="signup.php" class="text-success fw-bold text-decoration-none">Sign up</a></p>
    </div>

    <div class="back-home">
      <a href="index.php"><i class="fas fa-arrow-left me-2"></i>Back to Website</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
