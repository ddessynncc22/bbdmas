<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Fetch contact info (assumes one row)
$sql   = "SELECT * FROM tblcontactusinfo LIMIT 1";
$query = $dbh->prepare($sql);
$query->execute();
$info  = $query->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBDMS | Blood Bank & Donor Management System</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fontawesome-all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; }

    /* Top bar */
    .top-bar { background-color: #dc3545; color: #fff; padding: .5rem 0; }
    .top-bar a { color: #fff; text-decoration: none; }
    .contact-item { margin-right: 1.5rem; font-size: .9rem; }
    .contact-item i { margin-right: .5rem; }
    .social-icons .fa { font-size: 1rem; }
    .social-icons li + li { margin-left: 1rem; }

    /* Main navbar */
    .navbar-custom {
      background-color: #dc3545 !important;
      padding-top: 1rem;
      padding-bottom: 1rem;
    }
    .navbar-custom .nav-link {
      color: #fff; font-weight: 500; margin-right: 1rem;
    }
    .navbar-custom .nav-link:hover { color: #f8f9fa; }

    /* Login button */
    .btn-login {
      background-color: #fff;
      color: #dc3545;
      border-radius: 50px;
      padding: .4rem 1.2rem;
      font-weight: 600;
      border: 1px solid #dc3545;
      transition: all .3s;
    }
    .btn-login:hover { color: #c82333; text-decoration: none; }

    /* Logo size */
    .navbar-brand img {
      height: 100px !important;
      width: auto;
    }
  </style>
</head>
<body>
  <header>
    <!-- Top Bar -->
    <div class="top-bar">
      <div class="container d-flex justify-content-between align-items-center">
        <div class="d-none d-md-flex">
          <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i><?= htmlentities($info->Address) ?>
          </div>
          <div class="contact-item">
            <i class="far fa-envelope-open"></i>
            <a href="mailto:<?= htmlentities($info->EmailId) ?>"><?= htmlentities($info->EmailId) ?></a>
          </div>
          <div class="contact-item">
            <i class="fas fa-phone"></i>+<?= htmlentities($info->ContactNo) ?>
          </div>
        </div>
        <ul class="list-unstyled d-flex mb-0 social-icons">
          <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="fab fa-instagram"></i></a></li>
          <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="images/logo.png" alt="BBDMS Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Added justify-content-end here -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="donor-list.php">Donor List</a></li>
            <li class="nav-item"><a class="nav-link" href="search-donor.php">Search Donor</a></li>

            <?php if (isset($_SESSION['bbdmsdid']) && $_SESSION['bbdmsdid'] != ''): ?>
              <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user-circle me-1"></i>My Profile</a></li>
              <li class="nav-item"><a class="nav-link" href="change-password.php"><i class="fas fa-key me-1"></i>Change Password</a></li>
              <li class="nav-item"><a class="nav-link" href="request-received.php"><i class="fas fa-inbox me-1"></i>Requests</a></li>
              <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="admin/index.php">Admin</a></li>
              <li class="nav-item"><a href="login.php" class="btn-login">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- rest of your page content -->

  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
