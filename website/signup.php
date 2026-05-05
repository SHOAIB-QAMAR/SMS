<?php
include("db.php");

$success = "";
$error = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($data, $_POST['username']);
    $password = mysqli_real_escape_string($data, $_POST['password']);
    $usertype = mysqli_real_escape_string($data, $_POST['usertype']);

    $check = mysqli_query($data, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username already exists!";
    } else {
        $query = "INSERT INTO users (username, password, usertype) VALUES ('$username', '$password', '$usertype')";
        if (mysqli_query($data, $query)) {
            $success = "Registration successful! You can now login.";
        } else {
            $error = "Error registering user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up | Grassroots Public School</title>
  
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
      background: linear-gradient(135deg, #2193b0 0%, #1d7431 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .signup-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .brand-logo {
      width: 70px;
      height: 70px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .form-control, .form-select {
      border-radius: 10px;
      padding: 12px 15px;
      border: 1px solid #eee;
      margin-bottom: 15px;
    }

    .form-control:focus, .form-select:focus {
      box-shadow: 0 0 0 3px rgba(33, 147, 176, 0.1);
      border-color: #2193b0;
    }

    .btn-signup {
      background: #2193b0;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 10px;
      font-weight: 600;
      width: 100%;
      transition: all 0.3s ease;
      margin-top: 10px;
    }

    .btn-signup:hover {
      background: #1b7a99;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(33, 147, 176, 0.3);
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
    }

    .back-home a:hover {
      color: #2193b0;
    }
  </style>
</head>
<body>

  <div class="signup-card">
    <div class="brand-logo">
      <img src="assets/images/school1 (1).jpeg" alt="Logo" width="55" class="rounded-circle">
    </div>
    
    <h3 class="text-center fw-bold mb-2">Create Account</h3>
    <p class="text-center text-secondary small mb-4">Join the Grassroots educational community</p>

    <?php if ($success): ?>
      <div class="alert alert-success border-0 small text-center mb-4"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger border-0 small text-center mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="row">
        <div class="col-12">
          <label class="form-label small fw-bold">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Choose a username" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label small fw-bold">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
      </div>

      <div class="mb-4">
        <label class="form-label small fw-bold">Join as</label>
        <select name="usertype" class="form-select" required>
          <option value="student">Student</option>
          <option value="teacher">Teacher</option>
        </select>
      </div>

      <button type="submit" name="register" class="btn btn-signup shadow-sm">Complete Registration</button>
    </form>

    <div class="text-center mt-4">
      <p class="small text-secondary mb-0">Already have an account? <a href="anshi.php" class="text-primary fw-bold text-decoration-none">Log in</a></p>
    </div>

    <div class="back-home">
      <a href="index.php"><i class="fas fa-arrow-left me-2"></i>Back to Website</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
