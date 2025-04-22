<?php
session_start();
include('includes/config.php');
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT Email FROM tbladmin WHERE Email=:email AND MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    if($query->rowCount() > 0) {
        $con = "UPDATE tbladmin SET Password=:newpassword 
                WHERE Email=:email AND MobileNumber=:mobile";
        $chng = $dbh->prepare($con);
        $chng->bindParam(':email', $email, PDO::PARAM_STR);
        $chng->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chng->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chng->execute();
        echo "<script>alert('Your password was successfully changed.');</script>";
    } else {
        echo "<script>alert('Email or mobile number is invalid.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBDMS | Forgot Password</title>

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
      align-items: center;
      justify-content: center;
      background: var(--bg-gradient);
      padding: 1rem;
    }

    .forgot-container {
      position: relative;
      background: #fff;
      border-radius: var(--radius);
      box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
      max-width: 480px;
      width: 100%;
      overflow: hidden;
    }

    /* top accent bar */
    .forgot-container::before {
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
      padding: 0.75rem 1rem;
      border: none;
      border-bottom: 2px solid var(--grey-light);
      border-radius: 0;
      transition: border-color 0.2s ease;
      font-size: 0.95rem;
    }

    .form-control:focus {
      outline: none;
      border-bottom-color: var(--secondary);
      box-shadow: 0 2px 8px rgba(52,152,219,0.1);
    }

    .btn-reset {
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
    }
    .btn-reset:hover {
      transform: translateY(-2px);
      box-shadow: 0 0.75rem 1.5rem rgba(52,152,219,0.3);
    }

    .back-link {
      display: inline-block;
      margin-top: 1rem;
      font-size: 0.95rem;
      color: #6c757d;
      text-decoration: none;
      transition: color 0.2s ease;
    }
    .back-link + .back-link {
      margin-left: 1rem;
    }
    .back-link:hover {
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

  <script>
    function valid() {
      const p = document.chngpwd.newpassword.value;
      const c = document.chngpwd.confirmpassword.value;
      if (p !== c) {
        alert("New Password and Confirm Password do not match!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <div class="forgot-container">
    <div class="inner">
      <h1 class="page-title">Forgot Password</h1>
      <form method="post" name="chngpwd" onsubmit="return valid();">
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input id="email" type="email" name="email" class="form-control"
                 placeholder="you@example.com" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="mobile">Mobile Number</label>
          <input id="mobile" type="text" name="mobile" class="form-control"
                 placeholder="10‑digit mobile" maxlength="10" pattern="\d+"
                 required>
        </div>

        <div class="form-group">
          <label class="form-label" for="newpassword">New Password</label>
          <input id="newpassword" type="password" name="newpassword" class="form-control"
                 placeholder="New Password" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="confirmpassword">Confirm Password</label>
          <input id="confirmpassword" type="password" name="confirmpassword"
                 class="form-control" placeholder="Confirm Password" required>
        </div>

        <button type="submit" name="submit" class="btn-reset">Reset Password</button>

        <div style="text-align:center; margin-top:1.5rem;">
          <a href="index.php" class="back-link">Back to Sign In</a>
          <a href="../index.php" class="back-link">Back to Home</a>
        </div>
      </form>
    </div>
  </div>

  <script src="js/bootstrap.js"></script>
</body>
</html>
