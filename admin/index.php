<?php
session_start();
include('includes/config.php');
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM tbladmin 
            WHERE UserName=:username AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    if($query->rowCount() > 0) {
        $_SESSION['alogin'] = $username;
        echo "<script>document.location = 'dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBDMS | Admin Login</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/fontawesome-all.css" rel="stylesheet">

  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #2c3e50;
      --secondary: #3498db;
      --accent: #e74c3c;
      --bg-gradient: linear-gradient(135deg, var(--primary), var(--secondary));
      --radius: 10px;
      --text: #2c3e50;
      --grey-light: #ced4da;
    }
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: var(--bg-gradient);
      padding: 1rem;
    }

    .login-container {
      position: relative;
      background: #fff;
      border-radius: var(--radius);
      box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
      max-width: 400px;
      width: 100%;
      overflow: hidden;
    }
    .login-container::before {
      content: '';
      display: block;
      height: 6px;
      background: var(--accent);
    }

    .inner {
      padding: 2.5rem 2rem;
    }

    .page-title {
      margin: 0 0 2rem;
      text-align: center;
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--text);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 600;
      color: var(--text);
    }

    .form-control {
      width: 100%;
      padding: 0.65rem 0;
      border: none;
      border-bottom: 2px solid var(--grey-light);
      border-radius: 0;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
      font-size: 0.95rem;
      background: transparent;
    }

    .form-control:focus {
      outline: none;
      border-bottom-color: var(--secondary);
      box-shadow: 0 2px 8px rgba(52,152,219,0.1);
    }

    .btn-login {
      display: block;
      width: 100%;
      padding: 0.85rem;
      font-size: 1rem;
      font-weight: 600;
      text-transform: uppercase;
      border: none;
      border-radius: var(--radius);
      background: var(--bg-gradient);
      color: #fff;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      margin-top: 1rem;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 0.75rem 1.5rem rgba(52,152,219,0.3);
    }

    .link-group {
      text-align: center;
      margin-top: 1.5rem;
    }
    .link-group a {
      font-size: 0.95rem;
      color: #6c757d;
      text-decoration: none;
      margin: 0 0.5rem;
      transition: color 0.2s ease;
    }
    .link-group a:hover {
      color: var(--text);
    }

    @media (max-width: 480px) {
      .inner {
        padding: 2rem 1.5rem;
      }
      .page-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="inner">
      <h1 class="page-title">Admin Login</h1>
      <form method="post">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input id="username" type="text" name="username" class="form-control"
                 placeholder="Your username" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input id="password" type="password" name="password" class="form-control"
                 placeholder="Your password" required>
        </div>

        <button type="submit" name="login" class="btn-login">Sign In</button>
      </form>

      <div class="link-group">
        <a href="forgot-password.php">Forgot Password?</a>
        <a href="../index.php">Back to Home</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="js/bootstrap.js"></script>
</body>
</html>
